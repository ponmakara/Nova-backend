import { defineStore } from 'pinia'
import { useAuthStore } from './auth'
import http from '../services/http'

export const useCartStore = defineStore('cart', {
  state: () => ({
    items: [],
    loading: false,
  }),
  
  getters: {
    totalItems: (state) => state.items.reduce((sum, item) => sum + item.quantity, 0),
    totalPrice: (state) => state.items.reduce((sum, item) => sum + (item.quantity * item.product.price), 0),
  },
  
  actions: {
    async fetchCart() {
      const authStore = useAuthStore()
      if (!authStore.token) return
      
      this.loading = true
      try {
        const response = await http.get('/cart')
        this.items = response.data
      } catch (error) {
        console.error('Fetch cart error:', error)
      } finally {
        this.loading = false
      }
    },
    
    async addToCart(productId, quantity = 1) {
      const authStore = useAuthStore()
      if (!authStore.token) {
        throw new Error('Please login to add items to cart')
      }
      
      try {
        const response = await http.post('/cart', {
          product_id: productId,
          quantity
        })
        await this.fetchCart()
        return response.data
      } catch (error) {
        throw error.response.data
      }
    },
    
    async updateCartItem(itemId, quantity) {
      const authStore = useAuthStore()
      try {
        const response = await http.put(`/cart/${itemId}`, {
          quantity
        })
        await this.fetchCart()
        return response.data
      } catch (error) {
        throw error.response.data
      }
    },
    
    async removeFromCart(itemId) {
      const authStore = useAuthStore()
      try {
        await http.delete(`/cart/${itemId}`)
        await this.fetchCart()
      } catch (error) {
        throw error.response.data
      }
    },
    
    async clearCart() {
      const authStore = useAuthStore()
      try {
        await http.delete('/cart')
        this.items = []
      } catch (error) {
        throw error.response.data
      }
    }
  }
})
