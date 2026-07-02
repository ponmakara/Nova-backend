<template>
  <div class="checkout container py-5">
    <h1 class="mb-4">Checkout</h1>
    
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
      <form @submit.prevent="placeOrder">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-body">
                <h5>Shipping Information</h5>
                <div class="mb-3">
                  <label class="form-label">Shipping Address</label>
                  <textarea v-model="form.shipping_address" class="form-control" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                  <label class="form-label">Phone</label>
                  <input v-model="form.phone" type="tel" class="form-control" required>
                </div>

                <div class="mb-3">
                  <label class="form-label">Notes (Optional)</label>
                  <textarea v-model="form.notes" class="form-control" rows="2"></textarea>
                </div>
              </div>
            </div>

            <div class="card mt-3">
              <div class="card-body">
                <h5>Payment Method</h5>
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="paymentMethod" id="cash" value="cash" v-model="form.payment_method" checked>
                    <label class="form-check-label" for="cash">
                      <i class="bi bi-cash me-2"></i>Cash on Delivery
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="paymentMethod" id="card" value="card" v-model="form.payment_method">
                    <label class="form-check-label" for="card">
                      <i class="bi bi-credit-card me-2"></i>Credit/Debit Card
                    </label>
                  </div>
                </div>

                <div v-if="form.payment_method === 'card'" class="card bg-light">
                  <div class="card-body">
                    <h6 class="mb-3">Card Details</h6>
                    <div class="mb-3">
                      <label class="form-label">Card Number</label>
                      <input v-model="form.card_number" type="text" class="form-control" placeholder="1234 5678 9012 3456" maxlength="19">
                    </div>
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label class="form-label">Expiry Date</label>
                        <input v-model="form.card_expiry" type="text" class="form-control" placeholder="MM/YY" maxlength="5">
                      </div>
                      <div class="col-md-6 mb-3">
                        <label class="form-label">CVV</label>
                        <input v-model="form.card_cvv" type="text" class="form-control" placeholder="123" maxlength="3">
                      </div>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Cardholder Name</label>
                      <input v-model="form.card_name" type="text" class="form-control" placeholder="Name on card">
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="mt-3">
              <button type="submit" class="btn btn-primary btn-lg w-100" :disabled="loading">
                <span v-if="loading" class="spinner-border spinner-border-sm"></span>
                {{ loading ? 'Processing...' : 'Place Order' }}
              </button>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                <h5>Order Summary</h5>
                <hr>
                <div v-for="item in cartStore.items" :key="item.id" class="d-flex justify-content-between mb-2">
                  <span>{{ item.product.name }} x {{ item.quantity }}</span>
                  <span>${{ (item.quantity * item.product.price).toFixed(2) }}</span>
                </div>
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
                <div class="d-flex justify-content-between">
                  <strong>Total</strong>
                  <strong>${{ cartStore.totalPrice.toFixed(2) }}</strong>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '../stores/auth'
import { useCartStore } from '../stores/cart'
import http from '../services/http'

const router = useRouter()
const authStore = useAuthStore()
const cartStore = useCartStore()

const form = ref({
  shipping_address: '',
  phone: '',
  notes: '',
  payment_method: 'cash',
  card_number: '',
  card_expiry: '',
  card_cvv: '',
  card_name: ''
})

const loading = ref(false)
const error = ref(null)

const placeOrder = async () => {
  loading.value = true
  error.value = null
  try {
    await http.post('/orders', form.value)
    alert('Order placed successfully!')
    await cartStore.fetchCart()
    router.push(`/orders`)
  } catch (err) {
    console.error('Error placing order:', err)
    error.value = err.response?.data?.message || 'Failed to place order. Please try again.'
  } finally {
    loading.value = false
  }
}

onMounted(async () => {
  loading.value = true
  error.value = null
  try {
    await cartStore.fetchCart()

    const user = await authStore.fetchProfile()
    if (user) {
      form.value.shipping_address = user.address || ''
      form.value.phone = user.phone || ''
    }
  } catch (err) {
    console.error('Error loading checkout:', err)
    error.value = err.response?.data?.message || 'Failed to load checkout data. Please try again.'
  } finally {
    loading.value = false
  }
})
</script>
