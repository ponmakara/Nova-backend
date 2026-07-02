<template>
  <div class="products container py-5">
    <h1 class="mb-4">Products</h1>
    
    <div class="card mb-4">
      <div class="card-body">
        <div class="row">
          <div class="col-md-3">
            <select v-model="selectedCategory" class="form-select" @change="fetchProducts">
              <option value="">All Categories</option>
              <option v-for="category in categories" :key="category.id" :value="category.id">
                {{ category.name }}
              </option>
            </select>
          </div>
          <div class="col-md-3">
            <input v-model="searchQuery" type="text" class="form-control" placeholder="Search products..." @keyup.enter="fetchProducts">
          </div>
          <div class="col-md-2">
            <input v-model="minPrice" type="number" class="form-control" placeholder="Min Price" @keyup.enter="fetchProducts">
          </div>
          <div class="col-md-2">
            <input v-model="maxPrice" type="number" class="form-control" placeholder="Max Price" @keyup.enter="fetchProducts">
          </div>
          <div class="col-md-2">
            <button class="btn btn-primary w-100" @click="fetchProducts">Search</button>
          </div>
        </div>
      </div>
    </div>

    <div v-if="loading" class="text-center">
      <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>

    <div v-else-if="error" class="alert alert-danger">
      {{ error }}
    </div>

    <div v-else-if="products.length === 0" class="alert alert-info">
      No products found.
    </div>

    <div v-else class="row">
      <div v-for="product in products" :key="product.id" class="col-md-3 mb-4">
        <div class="card product-card h-100" @click="$router.push(`/products/${product.id}`)">
          <img v-if="product.image" :src="`${ASSET_URL}/${product.image}`" class="card-img-top product-image" :alt="product.name">
          <div v-else class="card-img-top bg-secondary d-flex align-items-center justify-content-center product-image">
            <span class="text-white">No Image</span>
          </div>
          <div class="card-body">
            <h5 class="card-title">{{ product.name }}</h5>
            <p class="card-text text-muted small">{{ product.category?.name }}</p>
            <p class="card-text text-primary fw-bold">${{ product.price }}</p>
            <p class="card-text small">Stock: {{ product.stock }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue'
import { useRoute } from 'vue-router'
import http from '../services/http'
import { ASSET_URL } from '../config/api'

const route = useRoute()

const categories = ref([])
const products = ref([])
const loading = ref(false)
const error = ref(null)
const selectedCategory = ref('')
const searchQuery = ref('')
const minPrice = ref('')
const maxPrice = ref('')

const syncFiltersFromRoute = () => {
  selectedCategory.value = route.query.category_id ? String(route.query.category_id) : ''
  searchQuery.value = route.query.search ? String(route.query.search) : ''
}

const fetchCategories = async () => {
  try {
    const response = await http.get('/categories')
    categories.value = response.data
  } catch (error) {
    console.error('Error fetching categories:', error)
  }
}

const fetchProducts = async () => {
  loading.value = true
  error.value = null
  try {
    const params = {}
    if (selectedCategory.value) params.category_id = selectedCategory.value
    if (searchQuery.value) params.search = searchQuery.value
    if (minPrice.value) params.min_price = minPrice.value
    if (maxPrice.value) params.max_price = maxPrice.value

    const response = await http.get('/products', { params })
    products.value = response.data
  } catch (err) {
    console.error('Error fetching products:', err)
    error.value = err.response?.data?.message || 'Failed to fetch products. Please try again.'
  } finally {
    loading.value = false
  }
}

onMounted(() => {
  fetchCategories()
  syncFiltersFromRoute()
  fetchProducts()
})

watch(
  () => route.query,
  () => {
    syncFiltersFromRoute()
    fetchProducts()
  }
)
</script>

<style scoped>
.product-image {
  width: 100%;
  height: 180px;
  object-fit: cover;
  background: #f8f9fa;
}
</style>
