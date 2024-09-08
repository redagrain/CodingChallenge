<template>
  <div style="border: 1px solid; margin: 5px" class="product">
    <img style="width:100px" v-if="product.image" :src="imageURL" :alt="product.name">
    <div class="content">
      <h2>{{ product.name }}</h2>
      <h3>${{ product.price }}</h3>
      <p>{{ product.description }}</p>
      <span>#{{ product.category }}</span>
    </div>
  </div>
</template>

<script setup>
import {computed} from 'vue'

const props = defineProps({
  product : {
    type: Object,
    required: true,
    default: () => ({
        name : "",
        price : null,
        description : "",
        category : "",
        image: ""
    })
  }
})

const imageURL = computed(() => {
  return `http://127.0.0.1:8000/storage` + props.product.image
}) 
</script>