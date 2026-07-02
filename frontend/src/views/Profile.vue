<template>
  <div class="profile container py-5">
    <h1 class="mb-4">My Profile</h1>
    
    <div class="row">
      <div class="col-md-8">
        <div class="card mb-4">
          <div class="card-body">
            <h5>Update Profile</h5>
            <form @submit.prevent="updateProfile">
              <div class="mb-3">
                <label class="form-label">Name</label>
                <input v-model="profileForm.name" type="text" class="form-control" required>
              </div>
              
              <div class="mb-3">
                <label class="form-label">Email</label>
                <input v-model="profileForm.email" type="email" class="form-control" required>
              </div>
              
              <div class="mb-3">
                <label class="form-label">Phone</label>
                <input v-model="profileForm.phone" type="tel" class="form-control">
              </div>
              
              <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea v-model="profileForm.address" class="form-control" rows="3"></textarea>
              </div>
              
              <button type="submit" class="btn btn-primary" :disabled="loading">
                <span v-if="loading" class="spinner-border spinner-border-sm"></span>
                {{ loading ? 'Updating...' : 'Update Profile' }}
              </button>
            </form>
          </div>
        </div>
        
        <div class="card">
          <div class="card-body">
            <h5>Change Password</h5>
            <form @submit.prevent="changePassword">
              <div class="mb-3">
                <label class="form-label">Current Password</label>
                <input v-model="passwordForm.current_password" type="password" class="form-control" required>
              </div>
              
              <div class="mb-3">
                <label class="form-label">New Password</label>
                <input v-model="passwordForm.password" type="password" class="form-control" required minlength="8">
              </div>
              
              <div class="mb-3">
                <label class="form-label">Confirm New Password</label>
                <input v-model="passwordForm.password_confirmation" type="password" class="form-control" required>
              </div>
              
              <button type="submit" class="btn btn-warning" :disabled="loading">
                <span v-if="loading" class="spinner-border spinner-border-sm"></span>
                {{ loading ? 'Changing...' : 'Change Password' }}
              </button>
            </form>
          </div>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5>Account Info</h5>
            <hr>
            <p><strong>Name:</strong> {{ authStore.user?.name }}</p>
            <p><strong>Email:</strong> {{ authStore.user?.email }}</p>
            <p><strong>Phone:</strong> {{ authStore.user?.phone || '-' }}</p>
            <p><strong>Address:</strong> {{ authStore.user?.address || '-' }}</p>
            <p><strong>Role:</strong> {{ authStore.user?.is_admin ? 'Admin' : 'User' }}</p>
            <p><strong>Joined:</strong> {{ authStore.user?.created_at ? new Date(authStore.user.created_at).toLocaleDateString() : '-' }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useAuthStore } from '../stores/auth'

const authStore = useAuthStore()

const profileForm = ref({
  name: '',
  email: '',
  phone: '',
  address: ''
})

const passwordForm = ref({
  current_password: '',
  password: '',
  password_confirmation: ''
})

const loading = ref(false)

const updateProfile = async () => {
  loading.value = true
  try {
    await authStore.updateProfile(profileForm.value)
    alert('Profile updated successfully!')
  } catch (error) {
    alert('Error updating profile')
  } finally {
    loading.value = false
  }
}

const changePassword = async () => {
  loading.value = true
  try {
    await authStore.changePassword(passwordForm.value)
    alert('Password changed successfully!')
    passwordForm.value = { current_password: '', password: '', password_confirmation: '' }
  } catch (error) {
    alert('Error changing password')
  } finally {
    loading.value = false
  }
}

onMounted(async () => {
  await authStore.fetchProfile()
  if (authStore.user) {
    profileForm.value = {
      name: authStore.user.name,
      email: authStore.user.email,
      phone: authStore.user.phone || '',
      address: authStore.user.address || ''
    }
  }
})
</script>
