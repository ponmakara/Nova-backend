import { defineStore } from 'pinia'
import { useAuthStore } from './auth'
import http from '../services/http'

export const useWishlistStore = defineStore('wishlist', {
  state: () => ({
    items: [],
    loading: false,
  }),
  
  actions: {
    async fetchWishlist() {
      const authStore = useAuthStore()
      if (!authStore.token) return
      
      this.loading = true
      try {
        const response = await http.get('/wishlist')
        this.items = response.data
      } catch (error) {
        console.error('Fetch wishlist error:', error)
      } finally {
        this.loading = false
      }
    },
    
    async addToWishlist(productId) {
      const authStore = useAuthStore()
      if (!authStore.token) {
        throw new Error('Please login to add items to wishlist')
      }
      
      try {
        const response = await http.post('/wishlist', {
          product_id: productId
        })
        await this.fetchWishlist()
        return response.data
      } catch (error) {
        throw error.response.data
      }
    },
    
    async removeFromWishlist(productId) {
      const authStore = useAuthStore()
      try {
        await http.delete(`/wishlist/${productId}`)
        await this.fetchWishlist()
      } catch (error) {
        throw error.response.data
      }
    },
    
    isInWishlist(productId) {
      return this.items.some(item => item.product_id === productId)
    }
  }
})
