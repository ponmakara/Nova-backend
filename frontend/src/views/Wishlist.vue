<template>
  <div class="wishlist container py-5">
    <h1 class="mb-4">My Wishlist</h1>
    
    <div v-if="loading" class="text-center">
      <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
    
    <div v-else-if="wishlistStore.items.length === 0" class="alert alert-info">
      Your wishlist is empty.
    </div>
    
    <div v-else class="row">
      <div v-for="item in wishlistStore.items" :key="item.id" class="col-md-3 mb-4">
        <div class="card product-card h-100">
          <img v-if="item.product.image" :src="`${ASSET_URL}/${item.product.image}`" class="card-img-top product-image" :alt="item.product.name" @click="$router.push(`/products/${item.product.id}`)">
          <div v-else class="card-img-top bg-secondary d-flex align-items-center justify-content-center product-image" @click="$router.push(`/products/${item.product.id}`)">
            <span class="text-white">No Image</span>
          </div>
          <div class="card-body">
            <h5 class="card-title">{{ item.product.name }}</h5>
            <p class="card-text text-primary fw-bold">${{ item.product.price }}</p>
            <button class="btn btn-danger btn-sm w-100" @click="removeFromWishlist(item.product.id)">
              <i class="bi bi-trash"></i> Remove
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useWishlistStore } from '../stores/wishlist'
import { ASSET_URL } from '../config/api'

const wishlistStore = useWishlistStore()
const loading = ref(false)

const removeFromWishlist = async (productId) => {
  try {
    await wishlistStore.removeFromWishlist(productId)
  } catch (error) {
    alert('Error removing from wishlist')
  }
}

onMounted(async () => {
  loading.value = true
  await wishlistStore.fetchWishlist()
  loading.value = false
})
</script>

<style scoped>
.product-image {
  width: 100%;
  height: 180px;
  object-fit: cover;
  background: #f8f9fa;
  cursor: pointer;
}
</style>
