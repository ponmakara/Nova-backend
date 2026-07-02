import { defineStore } from 'pinia'
import http from '../services/http'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null,
    token: localStorage.getItem('token') || null,
  }),
  
  getters: {
    isAuthenticated: (state) => !!state.token,
  },
  
  actions: {
    setSession({ token, user = null }) {
      this.token = token
      this.user = user
      localStorage.setItem('token', token)
    },

    clearSession() {
      this.token = null
      this.user = null
      localStorage.removeItem('token')
    },

    async register(userData) {
      try {
        const response = await http.post('/register', userData)
        this.setSession(response.data)
        return response.data
      } catch (error) {
        throw error.response?.data || { message: 'Registration failed. Please try again.' }
      }
    },
    
    async login(credentials) {
      try {
        const response = await http.post('/login', credentials)
        this.setSession(response.data)
        return response.data
      } catch (error) {
        throw error.response?.data || { message: 'Login failed. Please try again.' }
      }
    },
    
    async logout() {
      try {
        await http.post('/logout')
      } catch (error) {
        console.error('Logout error:', error)
      } finally {
        this.clearSession()
      }
    },
    
    async fetchProfile() {
      try {
        const response = await http.get('/profile')
        this.user = response.data
        return response.data
      } catch (error) {
        throw error.response?.data || { message: 'Failed to load profile.' }
      }
    },
    
    async updateProfile(userData) {
      try {
        const response = await http.put('/profile', userData)
        this.user = response.data
        return response.data
      } catch (error) {
        throw error.response?.data || { message: 'Failed to update profile.' }
      }
    },
    
    async changePassword(passwordData) {
      try {
        const response = await http.post('/change-password', passwordData)
        return response.data
      } catch (error) {
        throw error.response?.data || { message: 'Failed to change password.' }
      }
    }
  }
})
