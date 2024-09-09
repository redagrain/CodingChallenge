<script setup>
  import ProductCard from '../components/ProductCard.vue'
  import axios from 'axios'
  import { onMounted, ref } from 'vue';

  const products = ref([])
  const displayedProducts = ref([])
  const categories = ref([])
  const sortBy = ref('default')
  const filterBy = ref('default')


  // function sorts Products
  const sortProducts = () => {
    if (sortBy.value !== 'default') {
      if (sortBy.value === 'asc') {
        displayedProducts.value.sort((a,b)=> a.price - b.price)
      }else{
        displayedProducts.value.sort((a,b)=> b.price - a.price)
      }
    }
  }

  // function filters Products
  const filterProducts = () => {
    if (filterBy.value !== 'default') {
      displayedProducts.value = products.value.filter((product) => product.categories[0].name === filterBy.value)
    }else{
      displayedProducts.value = products.value
    }
    sortBy.value = 'default'
  }

  const fetchProducts = async () => {
    try {
      const res = await axios.get('http://127.0.0.1:8000/api/home')
      products.value = res.data
      displayedProducts.value = res.data;
    } catch (err) {
      console.error(err);
    }
  }

  const fetchCategories = async () => {
    try {
      const res = await axios.get('http://127.0.0.1:8000/api/create')
      
      
      categories.value = res.data.filter((category)=> category.parent_id)
    } catch (err) {
      console.error(err);
    }
  }

  onMounted(() =>{
    fetchProducts()
    fetchCategories()
  }
  )
</script>

<template>
  <div>
    <div class="header">
      <div class="sort">
        <label for="">sort by price:</label>
        <select v-model="sortBy" @change="sortProducts">
          <option value="default">sort by</option>
          <option value="asc">ASC</option>
          <option value="desc">DESC</option>
        </select>
      </div>
      <div class="filter">
          <label>Filter by:</label>
          <select v-model="filterBy" @change="filterProducts">
            <option value="default">filter by</option>
            <option v-for="category in categories" :value="category.name" :key="category.id">{{ category.name }}</option>
          </select>
      </div>
    </div>
    <div class="products">
      <ProductCard v-for="product in displayedProducts" :product="product" :key="product.id"/>
    </div>
  </div>
</template>
