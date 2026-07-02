<template>
  <div class="cart container py-5">
    <h1 class="mb-4">Shopping Cart</h1>
    
    <div v-if="loading" class="text-center">
      <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
    
    <div v-else-if="error" class="alert alert-danger">
      {{ error }}
    </div>

    <div v-else-if="cartStore.items.length === 0" class="alert alert-info">
      Your cart is empty. <router-link to="/products">Continue shopping</router-link>
    </div>
    
    <div v-else>
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-body">
              <div v-for="item in cartStore.items" :key="item.id" class="d-flex align-items-center border-bottom py-3">
                <img v-if="item.product.image" :src="`${ASSET_URL}/${item.product.image}`" style="width: 80px; height: 80px; object-fit: contain; background: #fff; padding: 4px;" class="rounded me-3">
                <div v-else class="bg-secondary d-flex align-items-center justify-content-center rounded me-3" style="width: 80px; height: 80px;">
                  <span class="text-white small">No Image</span>
                </div>
                
                <div class="flex-grow-1">
                  <h5 class="mb-1">{{ item.product.name }}</h5>
                  <p class="mb-1 text-primary fw-bold">${{ item.product.price }}</p>
                </div>
                
                <div class="d-flex align-items-center">
                  <input v-model.number="item.quantity" type="number" class="form-control form-control-sm" style="width: 70px;" min="1" @change="updateQuantity(item.id, item.quantity)">
                  <span class="ms-3 fw-bold">${{ (item.quantity * item.product.price).toFixed(2) }}</span>
                  <button class="btn btn-sm btn-danger ms-3" @click="removeFromCart(item.id)">
                    <i class="bi bi-trash"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5>Order Summary</h5>
              <hr>
              <div class="d-flex justify-content-between mb-2">
                <span>Subtotal</span>
                <span>${{ cartStore.totalPrice.toFixed(2) }}</span>
              </div>
              <div class="d-flex justify-content-between mb-2">
                <span>Shipping</span>
                <span>Free</span>
              </div>
              <hr>
              <div class="d-flex justify-content-between mb-3">
                <strong>Total</strong>
                <strong>${{ cartStore.totalPrice.toFixed(2) }}</strong>
              </div>
              <router-link to="/checkout" class="btn btn-primary w-100 btn-lg">
                Proceed to Checkout
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { ASSET_URL } from '../config/api'
import { useCartStore } from '../stores/cart'

const cartStore = useCartStore()
const loading = ref(false)
const error = ref(null)

const updateQuantity = async (itemId, quantity) => {
  try {
    await cartStore.updateCartItem(itemId, quantity)
  } catch (error) {
    alert('Error updating quantity')
  }
}

const removeFromCart = async (itemId) => {
  try {
    await cartStore.removeFromCart(itemId)
  } catch (error) {
    alert('Error removing from cart')
  }
}

onMounted(async () => {
  loading.value = true
  error.value = null
  try {
    await cartStore.fetchCart()
  } catch (err) {
    error.value = err.response?.data?.message || 'Failed to fetch cart. Please try again.'
  } finally {
    loading.value = false
  }
})
</script>
