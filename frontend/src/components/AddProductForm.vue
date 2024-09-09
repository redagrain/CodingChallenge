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
                <select @change="onCategoryChange" v-model="formData.category_id">
                    <option :value="null">Select a Category</option>
                    <option v-for="parentCategory in categories" :value="parentCategory.id" :key="parentCategory.id">{{ parentCategory.name }}</option>
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
    
    const categories = ref({})
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
    const fetchcategories = async () => {
        try {
            const res = await axios.get('http://127.0.0.1:8000/api/create')
            categories.value = res.data.filter((category)=> category.parent_id)
        } catch (err) {
            console.error(err)
        }
    }

    // get subcategories
    const onCategoryChange = () => {
        const subCategoriesData = computed(() => {
            const selectedParentCategory = categories.value.find((category) => {
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
        fetchcategories()
    })

</script>