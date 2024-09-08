<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <header>
    <div>
      <nav>
        <RouterLink style="margin: 3px" to="/">Home</RouterLink>
        <RouterLink style="margin: 3px" to="/AddProduct">Add Product</RouterLink>
      </nav>
    </div>
  </header>

  <RouterView />
</template>
