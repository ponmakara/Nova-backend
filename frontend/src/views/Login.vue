<template>
  <div class="auth-shell">
    <div class="auth-card">
      <div class="auth-copy">
        <span class="auth-kicker">Welcome back</span>
        <h1>Sign in to your account</h1>
        <p>Use your email and password, or continue with Google for a faster login.</p>
      </div>

      <div class="auth-panel">
        <div v-if="error" class="alert alert-danger">
          {{ error }}
        </div>

        <button type="button" class="social-button" @click="loginWithGoogle" :disabled="loading">
          <span class="social-icon">G</span>
          Continue with Google
        </button>

        <div class="auth-divider">
          <span>or</span>
        </div>

        <form @submit.prevent="handleLogin" class="auth-form">
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input v-model="form.email" type="email" class="form-control" id="email" required />
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input v-model="form.password" type="password" class="form-control" id="password" required />
          </div>

          <button type="submit" class="btn btn-primary w-100" :disabled="loading">
            <span v-if="loading" class="spinner-border spinner-border-sm me-2"></span>
            {{ loading ? 'Logging in...' : 'Login' }}
          </button>
        </form>

        <p class="auth-footer">
          Don't have an account? <router-link to="/register">Register</router-link>
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { useAuthStore } from '../stores/auth'
import { ASSET_URL } from '../config/api'

const router = useRouter()
const route = useRoute()
const authStore = useAuthStore()

const form = ref({
  email: '',
  password: ''
})

const loading = ref(false)
const error = ref('')

const finishSocialLogin = async (token) => {
  authStore.setSession({ token })
  await authStore.fetchProfile()
  router.replace('/')
}

const loginWithGoogle = () => {
  window.location.href = `${ASSET_URL}/auth/google/redirect`
}

const handleLogin = async () => {
  loading.value = true
  error.value = ''

  try {
    await authStore.login(form.value)
    router.push('/')
  } catch (err) {
    error.value = err.message || 'Login failed. Please try again.'
  } finally {
    loading.value = false
  }
}

onMounted(async () => {
  const token = route.query.token
  const oauthError = route.query.error

  if (typeof token === 'string' && token.length > 0) {
    loading.value = true

    try {
      await finishSocialLogin(token)
    } catch (err) {
      error.value = err.message || 'Google login failed. Please try again.'
    } finally {
      loading.value = false
    }
    return
  }

  if (typeof oauthError === 'string' && oauthError.length > 0) {
    error.value = ''
    router.replace({ path: '/login' })
  }
})
</script>

<style scoped>
.auth-shell {
  min-height: calc(100vh - 120px);
  display: grid;
  place-items: center;
  padding: 48px 16px;
  background: radial-gradient(circle at top, rgba(59, 130, 246, 0.12), transparent 42%),
    linear-gradient(180deg, #f8fbff 0%, #eef4ff 100%);
}

.auth-card {
  width: min(100%, 960px);
  display: grid;
  grid-template-columns: 1.05fr 0.95fr;
  overflow: hidden;
  border-radius: 28px;
  background: rgba(255, 255, 255, 0.9);
  box-shadow: 0 30px 80px rgba(15, 23, 42, 0.12);
  backdrop-filter: blur(18px);
}

.auth-copy {
  padding: 56px;
  color: #0f172a;
  background: linear-gradient(145deg, #0f62fe, #2563eb 55%, #60a5fa);
}

.auth-kicker {
  display: inline-flex;
  margin-bottom: 20px;
  padding: 8px 14px;
  border-radius: 999px;
  background: rgba(255, 255, 255, 0.18);
  color: #fff;
  font-size: 0.78rem;
  letter-spacing: 0.08em;
  text-transform: uppercase;
}

.auth-copy h1 {
  margin: 0;
  color: #fff;
  font-size: clamp(2.1rem, 4vw, 3.4rem);
  line-height: 1.02;
}

.auth-copy p {
  max-width: 32rem;
  margin: 18px 0 0;
  color: rgba(255, 255, 255, 0.92);
  font-size: 1.02rem;
}

.auth-panel {
  padding: 40px;
}

.social-button {
  width: 100%;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 12px;
  padding: 14px 18px;
  border: 1px solid rgba(37, 99, 235, 0.18);
  border-radius: 16px;
  background: #fff;
  font-weight: 700;
  color: #0f172a;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.social-button:hover {
  transform: translateY(-1px);
  box-shadow: 0 16px 28px rgba(15, 23, 42, 0.08);
}

.social-icon {
  width: 32px;
  height: 32px;
  display: grid;
  place-items: center;
  border-radius: 999px;
  background: #eff6ff;
  color: #1d4ed8;
  font-weight: 900;
}

.auth-divider {
  display: flex;
  align-items: center;
  gap: 14px;
  margin: 22px 0;
  color: #94a3b8;
  font-size: 0.86rem;
}

.auth-divider::before,
.auth-divider::after {
  content: '';
  height: 1px;
  flex: 1;
  background: #e2e8f0;
}

.auth-form {
  display: grid;
  gap: 4px;
}

.auth-footer {
  margin: 18px 0 0;
  text-align: center;
  color: #475569;
}

@media (max-width: 900px) {
  .auth-card {
    grid-template-columns: 1fr;
  }

  .auth-copy,
  .auth-panel {
    padding: 28px;
  }
}
</style>
