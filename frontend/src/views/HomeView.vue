<script setup>
  import ProductCard from '../components/ProductCard.vue'
  import axios from 'axios'
  import { onMounted, ref } from 'vue';

  const products = ref([])

  const fetchProducts = async () => {
    try {
      const res = await axios.get('http://127.0.0.1:8000/api/home')
      products.value = res.data
      console.log(res);
    } catch (err) {
      console.error(err);
    }
  }

  onMounted(() =>{
    fetchProducts()
  }
  )
</script>

<template>
  <div class="products">
    <ProductCard v-for="product in products" :product="product" :key="product.id"/>
  </div>
</template>
