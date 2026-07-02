<template>
  <header class="site-header">
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container">
        <router-link class="navbar-brand brand-lockup" to="/">
          <span class="brand-mark">
            <i class="bi bi-bag-heart-fill"></i>
          </span>
          <span class="brand-text">
            <strong>NovaMakara</strong>
          </span>
        </router-link>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNav">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="topNav">
          <ul class="navbar-nav mx-lg-auto align-items-lg-center gap-lg-1">
            <li class="nav-item">
              <router-link class="nav-link nav-chip" to="/">Home</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link nav-chip" to="/products">Shop</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link nav-chip" to="/wishlist">Wishlist</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link nav-chip" to="/orders">Orders</router-link>
            </li>
          </ul>

          <form class="nav-search" @submit.prevent="submitSearch">
            <i class="bi bi-search"></i>
            <input v-model="searchTerm" type="text" placeholder="Search products, brands...">
          </form>

          <div class="nav-actions">
            <!-- <router-link to="/admin/login" class="btn btn-sm btn-outline-primary rounded-pill admin-pill">
              <i class="bi bi-shield-lock me-1"></i> Admin
            </router-link> -->

            <router-link v-if="authStore.isAuthenticated" to="/wishlist" class="icon-action">
              <i class="bi bi-heart"></i>
              <span v-if="wishlistStore.items.length" class="icon-badge">{{ wishlistStore.items.length }}</span>
            </router-link>

            <router-link v-if="authStore.isAuthenticated" to="/cart" class="icon-action">
              <i class="bi bi-cart"></i>
              <span v-if="cartStore.totalItems" class="icon-badge">{{ cartStore.totalItems }}</span>
            </router-link>

            <router-link v-if="authStore.isAuthenticated" to="/profile" class="icon-action">
              <i class="bi bi-person"></i>
            </router-link>

            <router-link v-if="!authStore.isAuthenticated" to="/login" class="btn btn-sm btn-primary rounded-pill px-3">
              Login
            </router-link>

            <a v-if="authStore.isAuthenticated" href="#" class="btn btn-sm btn-dark rounded-pill px-3" @click.prevent="authStore.logout()">
              Logout
            </a>
          </div>
        </div>
      </div>
    </nav>
  </header>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '../../stores/auth'
import { useCartStore } from '../../stores/cart'
import { useWishlistStore } from '../../stores/wishlist'

const authStore = useAuthStore()
const cartStore = useCartStore()
const wishlistStore = useWishlistStore()
const router = useRouter()
const searchTerm = ref('')

const submitSearch = () => {
  const term = searchTerm.value.trim()
  if (!term) return
  router.push({ path: '/products', query: { search: term } })
}

onMounted(() => {
  if (authStore.isAuthenticated) {
    cartStore.fetchCart()
    wishlistStore.fetchWishlist()
  }
})
</script>

<style scoped>
.site-header {
  position: sticky;
  top: 0;
  z-index: 1020;
  padding: 0.85rem 0 0;
  background: linear-gradient(180deg, rgba(240, 246, 255, 0.92), rgba(240, 246, 255, 0.7));
  backdrop-filter: blur(18px);
}

.navbar {
  padding: 0;
}

.brand-lockup {
  display: inline-flex;
  align-items: center;
  gap: 0.8rem;
  text-decoration: none;
}

.brand-mark {
  width: 2.65rem;
  height: 2.65rem;
  border-radius: 0.95rem;
  display: grid;
  place-items: center;
  color: white;
  background: linear-gradient(135deg, #0f62fe, #3e8cff);
  box-shadow: 0 12px 30px rgba(15, 98, 254, 0.22);
}

.brand-text strong {
  display: block;
  color: #0b1a43;
  font-size: 1rem;
}

.brand-text small {
  display: block;
  color: #6c7a99;
  font-size: 0.74rem;
}

.nav-chip {
  border-radius: 999px;
  padding: 0.55rem 0.9rem !important;
  font-weight: 700;
  color: #0b1a43 !important;
}

.nav-chip.router-link-active {
  background: white;
  box-shadow: 0 10px 25px rgba(17, 41, 104, 0.08);
}

.nav-search {
  display: flex;
  align-items: center;
  gap: 0.65rem;
  min-height: 3rem;
  border-radius: 999px;
  padding: 0 1rem;
  margin: 0 1rem;
  min-width: min(100%, 18rem);
  background: white;
  border: 1px solid rgba(15, 98, 254, 0.12);
  box-shadow: 0 12px 24px rgba(17, 41, 104, 0.06);
}

.nav-search input {
  border: 0;
  outline: none;
  width: 100%;
  background: transparent;
}

.nav-search i {
  color: #8ea0c4;
}

.nav-actions {
  display: flex;
  align-items: center;
  gap: 0.65rem;
}

.admin-pill {
  font-weight: 800;
}

.icon-action {
  position: relative;
  width: 2.5rem;
  height: 2.5rem;
  border-radius: 50%;
  display: grid;
  place-items: center;
  color: #0b1a43;
  text-decoration: none;
  background: white;
  border: 1px solid rgba(15, 98, 254, 0.12);
  box-shadow: 0 10px 25px rgba(17, 41, 104, 0.06);
}

.icon-badge {
  position: absolute;
  top: -0.2rem;
  right: -0.2rem;
  min-width: 1.1rem;
  height: 1.1rem;
  border-radius: 999px;
  background: #ff5d19;
  color: white;
  font-size: 0.65rem;
  font-weight: 800;
  display: grid;
  place-items: center;
  padding: 0 0.2rem;
}

@media (max-width: 991px) {
  .nav-search {
    margin: 1rem 0;
  }

  .nav-actions {
    flex-wrap: wrap;
    padding-bottom: 0.75rem;
  }
}
</style>
