<template>
    <div>
        <form @submit.prevent="handleForm">
            <div class="input">
                <input @change="onFileChange" type="file">
            </div>
            <div class="input">
                <input v-model="formData.name" type="text" placeholder="name">
            </div>
            <div class="input">
                <textarea v-model="formData.description" placeholder="Description"></textarea>
            </div>
            <div class="input">
                <input type="text" v-model="formData.price" placeholder="price"/>
            </div>
            <div class="input">
                <select @change="onCategoryChange" v-model="parentCategory">
                    <option :value="null">Select a Category</option>
                    <option v-for="parentCategory in parentCategories" :value="parentCategory.id" :key="parentCategory.id">{{ parentCategory.name }}</option>
                </select>
            </div>
            <div v-if="parentCategory" class="input">
                <select v-model="formData.category_id" id="category">
                    <option :value="null">Select subcategory</option>
                    <option :key="category.id" v-for="category in subCategories" :value="category.id">{{ category.name }}</option>
                </select>
            </div>
            <button>submite</button>
        </form>
        <p v-if="successMessage">{{ successMessage }}</p>
        <p style="color: red" v-else-if="errorMessage">{{ errorMessage }}</p>
    </div>
</template>

<script setup>
    import axios from 'axios';
    import {onMounted, ref, computed} from 'vue'
    
    const parentCategories = ref({})
    const successMessage = ref('')
    const errorMessage = ref('')
    const subCategories = ref({})
    const parentCategory = ref(null)
    const formData = ref({
        name : "",
        price : null,
        description : "",
        category_id : null,
        image: null
    })

    // fetch categories
    const fetchParentCategories = async () => {
        try {
            const res = await axios.get('http://127.0.0.1:8000/api/create')
            parentCategories.value = res.data;
            console.log(parentCategories.value);
        } catch (err) {
            console.error(err)
        }
    }

    // get subcategories
    const onCategoryChange = () => {
        const subCategoriesData = computed(() => {
            const selectedParentCategory = parentCategories.value.find((category) => {
                return category.id === parentCategory.value;
            });

            return selectedParentCategory ? selectedParentCategory.categories : 'No subcategories found';
        });
        subCategories.value = subCategoriesData.value;
    }

    // get image file
    const onFileChange = (e) => {
        formData.value.image = e.target.files[0];
    }

    // submite data to backend
    const handleForm = async () => {
        try {
            const res = await axios.post('http://127.0.0.1:8000/api/store', formData.value, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                }
            })
            successMessage.value = res.data.message
        } catch (err) {
            successMessage.value = null
            errorMessage.value = err.response.data.message
        }
    }

    onMounted(()=>{
        fetchParentCategories()
    })

</script>