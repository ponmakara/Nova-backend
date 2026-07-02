<template>
  <div class="orders container py-5">
    <h1 class="mb-4">My Orders</h1>
    
    <div v-if="loading" class="text-center">
      <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
    
    <div v-else-if="error" class="alert alert-danger">
      {{ error }}
    </div>

    <div v-else-if="orders.length === 0" class="alert alert-info">
      You have no orders yet.
    </div>
    
    <div v-else>
      <div v-for="order in orders" :key="order.id" class="card mb-3">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
              <h5 class="mb-0">Order #{{ order.order_number }}</h5>
              <small class="text-muted">{{ new Date(order.created_at).toLocaleString() }}</small>
            </div>
            <div>
              <span class="badge bg-{{ order.status === 'completed' ? 'success' : (order.status === 'pending' ? 'warning' : 'info') }}">
                {{ order.status.toUpperCase() }}
              </span>
            </div>
          </div>
          
          <div class="table-responsive">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Subtotal</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="item in order.order_items" :key="item.id">
                  <td>{{ item.product.name }}</td>
                  <td>${{ item.price }}</td>
                  <td>{{ item.quantity }}</td>
                  <td>${{ item.subtotal }}</td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="3" class="text-end"><strong>Total:</strong></td>
                  <td><strong>${{ order.total_amount }}</strong></td>
                </tr>
              </tfoot>
            </table>
          </div>
          
          <div class="mt-3">
            <p><strong>Shipping Address:</strong> {{ order.shipping_address }}</p>
            <p><strong>Phone:</strong> {{ order.phone }}</p>
            <p v-if="order.notes"><strong>Notes:</strong> {{ order.notes }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import http from '../services/http'

const orders = ref([])
const loading = ref(false)
const error = ref(null)

const fetchOrders = async () => {
  loading.value = true
  error.value = null
  try {
    const response = await http.get('/orders')
    orders.value = response.data
  } catch (err) {
    console.error('Error fetching orders:', err)
    error.value = err.response?.data?.message || 'Failed to fetch orders. Please try again.'
  } finally {
    loading.value = false
  }
}

onMounted(() => {
  fetchOrders()
})
</script>
