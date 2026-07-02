<template>
  <div class="product-detail container py-5" v-if="product">
    <div class="row">
      <div class="col-md-6">
        <img v-if="product.image" :src="`${ASSET_URL}/${product.image}`" class="product-detail-image rounded" :alt="product.name">
        <div v-else class="bg-secondary d-flex align-items-center justify-content-center rounded product-detail-image">
          <span class="text-white">No Image</span>
        </div>
      </div>
      <div class="col-md-6">
        <h1>{{ product.name }}</h1>
        <p class="text-muted">{{ product.category?.name }}</p>
        <h2 class="text-primary mb-4">${{ product.price }}</h2>
        <p>{{ product.description }}</p>
        <p><strong>Stock:</strong> {{ product.stock }}</p>
        <p><strong>Views:</strong> {{ product.views }}</p>
        
        <div class="mb-3">
          <label class="form-label">Quantity</label>
          <input v-model.number="quantity" type="number" class="form-control" min="1" :max="product.stock" value="1">
        </div>
        
        <div class="d-flex gap-2 mb-4">
          <button class="btn btn-primary btn-lg" @click="addToCart" :disabled="!authStore.isAuthenticated || product.stock === 0">
            <i class="bi bi-cart"></i> Add to Cart
          </button>
          <button class="btn btn-outline-danger btn-lg" @click="addToWishlist" :disabled="!authStore.isAuthenticated || isInWishlist">
            <i class="bi bi-heart"></i> {{ isInWishlist ? 'In Wishlist' : 'Add to Wishlist' }}
          </button>
        </div>
        
        <div v-if="!authStore.isAuthenticated" class="alert alert-info">
          Please <router-link to="/login">login</router-link> to add items to cart or wishlist.
        </div>
      </div>
    </div>

    <div class="row mt-5">
      <div class="col-12">
        <h3>Reviews</h3>
        
        <div v-if="authStore.isAuthenticated" class="card mb-4">
          <div class="card-body">
            <h5>Write a Review</h5>
            <form @submit.prevent="submitReview">
              <div class="mb-3">
                <label class="form-label">Rating</label>
                <select v-model="review.rating" class="form-select" required>
                  <option value="5">5 Stars</option>
                  <option value="4">4 Stars</option>
                  <option value="3">3 Stars</option>
                  <option value="2">2 Stars</option>
                  <option value="1">1 Star</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Comment</label>
                <textarea v-model="review.comment" class="form-control" rows="3" required></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Submit Review</button>
            </form>
          </div>
        </div>

        <div v-if="reviews.length === 0" class="alert alert-info">
          No reviews yet. Be the first to review!
        </div>

        <div v-else>
          <div v-for="review in reviews" :key="review.id" class="card mb-3">
            <div class="card-body">
              <div class="d-flex justify-content-between">
                <h5>{{ review.user?.name }}</h5>
                <span class="text-warning">
                  <i v-for="i in review.rating" :key="i" class="bi bi-star-fill"></i>
                </span>
              </div>
              <p class="mb-0">{{ review.comment }}</p>
              <small class="text-muted">{{ new Date(review.created_at).toLocaleDateString() }}</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div v-else class="container py-5">
    <div class="text-center">
      <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import { useRoute } from 'vue-router'
import http from '../services/http'
import { useAuthStore } from '../stores/auth'
import { useCartStore } from '../stores/cart'
import { useWishlistStore } from '../stores/wishlist'
import { ASSET_URL } from '../config/api'

const route = useRoute()
const authStore = useAuthStore()
const cartStore = useCartStore()
const wishlistStore = useWishlistStore()

const product = ref(null)
const reviews = ref([])
const quantity = ref(1)
const review = ref({
  rating: 5,
  comment: ''
})

const isInWishlist = computed(() => {
  return wishlistStore.isInWishlist(product.value?.id)
})

const fetchProduct = async () => {
  try {
    const response = await http.get(`/products/${route.params.id}`)
    product.value = response.data
  } catch (error) {
    console.error('Error fetching product:', error)
  }
}

const fetchReviews = async () => {
  try {
    const response = await http.get(`/products/${route.params.id}/reviews`)
    reviews.value = response.data
  } catch (error) {
    console.error('Error fetching reviews:', error)
  }
}

const addToCart = async () => {
  try {
    await cartStore.addToCart(product.value.id, quantity.value)
    alert('Added to cart!')
  } catch (error) {
    alert(error.message || 'Error adding to cart')
  }
}

const addToWishlist = async () => {
  try {
    await wishlistStore.addToWishlist(product.value.id)
    alert('Added to wishlist!')
  } catch (error) {
    alert(error.message || 'Error adding to wishlist')
  }
}

const submitReview = async () => {
  try {
    await http.post('/reviews', {
      product_id: product.value.id,
      ...review.value
    })
    alert('Review submitted!')
    review.value = { rating: 5, comment: '' }
    fetchReviews()
  } catch (error) {
    alert('Error submitting review')
  }
}

onMounted(() => {
  fetchProduct()
  fetchReviews()
  if (authStore.isAuthenticated) {
    wishlistStore.fetchWishlist()
  }
})
</script>

<style scoped>
.product-detail-image {
  width: 100%;
  height: 400px;
  object-fit: cover;
  background: #f8f9fa;
}
</style>
