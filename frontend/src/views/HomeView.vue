<script setup>
  import ProductCard from '../components/ProductCard.vue'
  import axios from 'axios'
  import { onMounted, ref } from 'vue';

  const products = ref([])
  const displayedProducts = ref(products)
  const sortBy = ref('asc')


  // function sorts Products
  const sortProducts = () => {
    if (sortBy.value === 'asc') {
      displayedProducts.value = products.value.sort((a,b)=> a.price - b.price)
    }else{
      displayedProducts.value.sort((a,b)=> b.price - a.price)
    }
  }

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
  <div>
    <div class="header">
      <div class="sort">
        <label for="">sort by price:</label>
        <select v-model="sortBy" @change="sortProducts">
          <option value="asc">ASC</option>
          <option value="desc">DESC</option>
        </select>
      </div>
    </div>
    <div class="products">
      <ProductCard v-for="product in displayedProducts" :product="product" :key="product.id"/>
    </div>
  </div>
</template>
