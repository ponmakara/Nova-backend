<template>
  <div class="home-page">
    <section class="hero-shell">
      <div class="hero-glow hero-glow-a"></div>
      <div class="hero-glow hero-glow-b"></div>

      <div class="container position-relative">
        <div class="hero-grid">
          <div class="hero-copy">
            <div class="eyebrow-pill">
              <i class="bi bi-lightning-charge-fill me-2"></i>
              Curated finds for every day
            </div>

            <h1 class="hero-title">
              Shop Smarter,
              <span>Live Better</span>
            </h1>

            <p class="hero-lead">
              Explore fresh deals, trending essentials, and handpicked categories from your local NovaMart.
              Fast checkout, clean design, and a smoother shopping flow.
            </p>

            <form class="hero-search" @submit.prevent="submitSearch">
              <div class="search-field">
                <i class="bi bi-search"></i>
                <input
                  v-model="searchTerm"
                  type="text"
                  placeholder="Try 'headphones', 'perfume', or 'bicycle'"
                >
              </div>
              <select v-model="searchCategory" class="search-select">
                <option value="">All Categories</option>
                <option v-for="category in categories" :key="category.id" :value="category.id">
                  {{ category.name }}
                </option>
              </select>
              <button class="btn btn-light hero-search-btn" type="submit">Search</button>
            </form>

            <div class="hero-badges">
              <div class="mini-badge">
                <i class="bi bi-truck"></i>
                <div>
                  <strong>Free shipping</strong>
                  <span>On orders over $50</span>
                </div>
              </div>
              <div class="mini-badge">
                <i class="bi bi-shield-check"></i>
                <div>
                  <strong>Secure checkout</strong>
                  <span>Protected payments</span>
                </div>
              </div>
              <div class="mini-badge">
                <i class="bi bi-arrow-repeat"></i>
                <div>
                  <strong>Easy returns</strong>
                  <span>30-day policy</span>
                </div>
              </div>
            </div>
          </div>

          <div class="hero-visual">
            <div class="hero-collage">
              <article class="collage-card collage-large" v-if="heroProducts[0]">
                <img :src="productImage(heroProducts[0])" :alt="heroProducts[0].name">
                <div class="card-overlay">
                  <small>{{ heroProducts[0].category?.name }}</small>
                  <h3>{{ heroProducts[0].name }}</h3>
                  <p>{{ heroProducts[0].price }}</p>
                </div>
              </article>
              <article class="collage-card collage-tall" v-if="heroProducts[1]">
                <img :src="productImage(heroProducts[1])" :alt="heroProducts[1].name">
                <div class="card-overlay">
                  <small>{{ heroProducts[1].category?.name }}</small>
                  <h3>{{ heroProducts[1].name }}</h3>
                </div>
              </article>
              <article class="collage-card collage-wide" v-if="heroProducts[2]">
                <img :src="productImage(heroProducts[2])" :alt="heroProducts[2].name">
                <div class="card-overlay">
                  <small>Featured</small>
                  <h3>{{ heroProducts[2].name }}</h3>
                  <button class="pill-button" @click="$router.push(`/products/${heroProducts[2].id}`)">
                    Shop Now
                  </button>
                </div>
              </article>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="stats-strip">
      <div class="container">
        <div class="stats-grid">
          <div class="stat-item">
            <strong>{{ products.length || 30 }}+</strong>
            <span>Products</span>
          </div>
          <div class="stat-item">
            <strong>{{ categories.length || 3 }}+</strong>
            <span>Categories</span>
          </div>
          <div class="stat-item">
            <strong>24/7</strong>
            <span>Support</span>
          </div>
          <div class="stat-item">
            <strong>4.9★</strong>
            <span>Average Rating</span>
          </div>
        </div>
      </div>
    </section>

    <section class="flash-strip">
      <div class="container">
        <div class="flash-banner">
          <div>
            <div class="flash-label">Flash Sale</div>
            <strong>Up to 40% off on selected favorites</strong>
          </div>
          <div class="flash-meta">
            <span>Ends in:</span>
            <div class="timer-chip">04</div>
            <div class="timer-chip">29</div>
            <div class="timer-chip">07</div>
            <router-link to="/products" class="btn btn-light flash-btn">Shop Deals</router-link>
          </div>
        </div>
      </div>
    </section>

    <section class="content-section">
      <div class="container">
        <div class="section-heading">
          <div>
            <small class="section-kicker">Browse</small>
            <h2>Shop by Category</h2>
          </div>
          <router-link to="/products" class="section-link">View all <i class="bi bi-arrow-right"></i></router-link>
        </div>

        <div class="category-strip">
          <button
            v-for="category in categories"
            :key="category.id"
            class="category-chip"
            @click="$router.push(`/products?category_id=${category.id}`)"
          >
            <div class="category-icon">
              <i class="bi bi-bag-heart"></i>
            </div>
            <strong>{{ category.name }}</strong>
            <span>{{ productCountByCategory(category.id) }} items</span>
          </button>
        </div>
      </div>
    </section>

    <section class="content-section">
      <div class="container">
        <div class="section-heading">
          <div>
            <small class="section-kicker">Handpicked for you</small>
            <h2>Featured Products</h2>
          </div>
          <div class="filter-pills">
            <button
              class="filter-pill"
              :class="{ active: activeCategory === '' }"
              @click="activeCategory = ''"
            >
              All
            </button>
            <button
              v-for="category in categories"
              :key="category.id"
              class="filter-pill"
              :class="{ active: activeCategory === String(category.id) }"
              @click="activeCategory = String(category.id)"
            >
              {{ category.name }}
            </button>
          </div>
        </div>

        <div class="products-grid">
          <article
            v-for="product in filteredFeaturedProducts"
            :key="product.id"
            class="product-card-modern"
            @click="$router.push(`/products/${product.id}`)"
          >
            <div class="product-badge" v-if="product.stock > 20">Best Seller</div>
            <img :src="productImage(product)" :alt="product.name" class="product-media">
            <div class="product-body">
              <small>{{ product.category?.name }}</small>
              <h3>{{ product.name }}</h3>
              <div class="product-rating">
                <i class="bi bi-star-fill" v-for="i in 5" :key="i"></i>
                <span>(4.8)</span>
              </div>
              <div class="product-footer">
                <strong>${{ product.price }}</strong>
                <button class="add-pill" @click.stop="$router.push(`/products/${product.id}`)">
                  View
                </button>
              </div>
            </div>
          </article>
        </div>
      </div>
    </section>

    <section class="content-section">
      <div class="container">
        <div class="deal-panel">
          <div class="deal-copy">
            <div class="section-kicker">Deal of the day</div>
            <h2>{{ highlightProduct?.name || 'Sony WH-1000XM5 Headphones' }}</h2>
            <p>
              A featured product spotlight with a stronger visual hierarchy, clean gradients, and a more premium feel.
            </p>
            <div class="deal-price">
              <strong>${{ highlightProduct?.price || '149.00' }}</strong>
              <span>Save 25%</span>
            </div>
            <div class="deal-actions">
              <router-link
                v-if="highlightProduct"
                class="btn btn-primary rounded-pill px-4"
                :to="`/products/${highlightProduct.id}`"
              >
                Add to Cart
              </router-link>
              <router-link to="/products" class="btn btn-outline-light rounded-pill px-4">
                Details
              </router-link>
            </div>
          </div>

          <div class="deal-visual" v-if="highlightProduct">
            <img :src="productImage(highlightProduct)" :alt="highlightProduct.name">
          </div>
        </div>
      </div>
    </section>

    <section class="content-section">
      <div class="container">
        <div class="section-heading">
          <div>
            <small class="section-kicker">Just dropped</small>
            <h2>New Arrivals</h2>
          </div>
        </div>

        <div class="arrivals-grid">
          <article
            v-for="product in newArrivals"
            :key="product.id"
            class="arrival-card"
            @click="$router.push(`/products/${product.id}`)"
          >
            <img :src="productImage(product)" :alt="product.name">
            <div class="arrival-body">
              <small>{{ product.category?.name }}</small>
              <h3>{{ product.name }}</h3>
              <div class="arrival-footer">
                <strong>${{ product.price }}</strong>
                <button class="mini-add" @click.stop="$router.push(`/products/${product.id}`)">Add</button>
              </div>
            </div>
          </article>
        </div>
      </div>
    </section>

    <section class="content-section">
      <div class="container">
        <div class="promo-grid">
          <div class="promo-card promo-blue">
            <small>Free shipping</small>
            <h3>On orders over $50</h3>
            <router-link to="/products">Shop now <i class="bi bi-arrow-right"></i></router-link>
          </div>
          <div class="promo-card promo-purple">
            <small>Gift cards</small>
            <h3>Perfect for every occasion</h3>
            <router-link to="/products">Buy gift cards <i class="bi bi-arrow-right"></i></router-link>
          </div>
          <div class="promo-card promo-orange">
            <small>First order</small>
            <h3>20% off your first checkout</h3>
            <router-link to="/register">Register now <i class="bi bi-arrow-right"></i></router-link>
          </div>
        </div>
      </div>
    </section>

    <section class="content-section muted-section">
      <div class="container">
        <div class="section-heading centered">
          <div>
            <small class="section-kicker">What customers say</small>
            <h2>Loved by thousands</h2>
          </div>
        </div>

        <div class="testimonial-grid">
          <article class="testimonial-card" v-for="item in testimonials" :key="item.name">
            <div class="stars">
              <i class="bi bi-star-fill" v-for="i in 5" :key="i"></i>
            </div>
            <p>{{ item.quote }}</p>
            <div class="testimonial-person">
              <div class="avatar">{{ item.name.charAt(0) }}</div>
              <div>
                <strong>{{ item.name }}</strong>
                <span>{{ item.role }}</span>
              </div>
            </div>
          </article>
        </div>
      </div>
    </section>

    <section class="content-section">
      <div class="container">
        <div class="newsletter-panel">
          <div>
            <small class="section-kicker">Stay in the loop</small>
            <h2>Get deals, new arrivals, and inspiration in your inbox.</h2>
          </div>
          <form class="newsletter-form" @submit.prevent>
            <input type="email" placeholder="Enter your email address">
            <button class="btn btn-warning rounded-pill px-4">Subscribe</button>
          </form>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { computed, onMounted, ref } from 'vue'
import { useRouter } from 'vue-router'
import http from '../services/http'
import { ASSET_URL } from '../config/api'
import heroShopping from '../assets/hero-shopping.png'

const categories = ref([])
const products = ref([])
const searchTerm = ref('')
const searchCategory = ref('')
const activeCategory = ref('')
const router = useRouter()

const testimonials = [
  {
    name: 'Sophia Koa',
    role: 'Fashion Blogger',
    quote: 'NovaMart completely changed how I shop online. The products feel curated and the layout is a joy to use.'
  },
  {
    name: 'Hasan Lim',
    role: 'Software Engineer',
    quote: 'Fast browsing, clear product cards, and a checkout flow that feels polished. It is very easy to trust.'
  },
  {
    name: 'Maly Chan',
    role: 'Interior Designer',
    quote: 'I can find categories quickly and the product highlights make the whole storefront feel premium.'
  }
]

const highlightProduct = computed(() => products.value[0] || null)
const heroProducts = computed(() => products.value.slice(0, 3))
const newArrivals = computed(() => products.value.slice(4, 8))
const filteredFeaturedProducts = computed(() => {
  if (!activeCategory.value) {
    return products.value.slice(0, 8)
  }

  return products.value.filter((product) => String(product.category_id) === activeCategory.value).slice(0, 8)
})

const productImage = (product) => product?.image ? `${ASSET_URL}/${product.image}` : heroShopping

const productCountByCategory = (id) => {
  return products.value.filter((product) => product.category_id === id).length
}

const submitSearch = () => {
  const query = {}
  if (searchTerm.value.trim()) query.search = searchTerm.value.trim()
  if (searchCategory.value) query.category_id = searchCategory.value
  const params = new URLSearchParams(query).toString()
  router.push(params ? `/products?${params}` : '/products')
}

onMounted(async () => {
  try {
    const [categoriesRes, productsRes] = await Promise.all([
      http.get('/categories'),
      http.get('/products')
    ])

    categories.value = categoriesRes.data
    products.value = productsRes.data
  } catch (error) {
    console.error('Error fetching home data:', error)
  }
})
</script>

<style scoped>
.home-page {
  background: linear-gradient(180deg, #eef5ff 0%, #f8fbff 46%, #eef6ff 100%);
}

.hero-shell {
  position: relative;
  overflow: hidden;
  padding: 1.5rem 0 4rem;
  background: linear-gradient(135deg, #0f62fe 0%, #2b50f5 38%, #3e2bd8 100%);
  color: white;
}

.hero-glow {
  position: absolute;
  border-radius: 999px;
  filter: blur(14px);
  opacity: 0.35;
}

.hero-glow-a {
  width: 22rem;
  height: 22rem;
  background: rgba(255, 255, 255, 0.18);
  right: -4rem;
  top: -5rem;
}

.hero-glow-b {
  width: 16rem;
  height: 16rem;
  background: rgba(255, 122, 0, 0.35);
  left: -3rem;
  bottom: -4rem;
}

.hero-grid {
  position: relative;
  z-index: 1;
  display: grid;
  grid-template-columns: 1.15fr 0.95fr;
  gap: 2rem;
  align-items: center;
  min-height: 38rem;
}

.eyebrow-pill,
.section-kicker {
  text-transform: uppercase;
  letter-spacing: 0.16em;
  font-size: 0.7rem;
  font-weight: 800;
}

.eyebrow-pill {
  display: inline-flex;
  align-items: center;
  gap: 0.35rem;
  padding: 0.55rem 0.9rem;
  border-radius: 999px;
  background: rgba(255, 255, 255, 0.14);
  border: 1px solid rgba(255, 255, 255, 0.18);
  margin-bottom: 1.2rem;
}

.hero-title {
  font-size: clamp(2.6rem, 5vw, 5rem);
  line-height: 0.96;
  font-weight: 900;
  max-width: 11ch;
  margin: 0;
}

.hero-title span {
  color: #d8e6ff;
}

.hero-lead {
  max-width: 36rem;
  font-size: 1.05rem;
  line-height: 1.7;
  margin: 1.25rem 0 1.6rem;
  color: rgba(255, 255, 255, 0.9);
}

.hero-search {
  display: grid;
  grid-template-columns: 1fr auto auto;
  gap: 0.75rem;
  align-items: center;
  max-width: 48rem;
}

.search-field,
.search-select {
  min-height: 3.6rem;
  border-radius: 999px;
  border: 1px solid rgba(255, 255, 255, 0.26);
  background: rgba(255, 255, 255, 0.18);
  backdrop-filter: blur(10px);
  color: white;
}

.search-field {
  display: flex;
  align-items: center;
  gap: 0.8rem;
  padding: 0 1rem 0 1.1rem;
}

.search-field i {
  opacity: 0.8;
}

.search-field input,
.search-select {
  width: 100%;
  border: 0;
  background: transparent;
  color: white;
  outline: none;
}

.search-field input::placeholder {
  color: rgba(255, 255, 255, 0.78);
}

.search-select {
  padding: 0 1rem;
}

.search-select option {
  color: #0f172a;
}

.hero-search-btn {
  min-height: 3.6rem;
  border-radius: 999px;
  padding: 0 1.4rem;
  font-weight: 800;
  color: #1636a9;
}

.hero-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 0.8rem;
  margin-top: 1.2rem;
}

.mini-badge {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  padding: 0.75rem 1rem;
  border-radius: 1rem;
  background: rgba(255, 255, 255, 0.12);
  border: 1px solid rgba(255, 255, 255, 0.14);
}

.mini-badge i {
  font-size: 1.1rem;
  width: 2.4rem;
  height: 2.4rem;
  border-radius: 50%;
  display: grid;
  place-items: center;
  background: rgba(255, 255, 255, 0.16);
}

.mini-badge strong,
.mini-badge span {
  display: block;
}

.mini-badge strong {
  font-size: 0.92rem;
}

.mini-badge span {
  color: rgba(255, 255, 255, 0.75);
  font-size: 0.78rem;
}

.hero-collage {
  display: grid;
  grid-template-columns: 1fr 1fr;
  grid-template-rows: 220px 220px;
  gap: 0.9rem;
}

.collage-card {
  position: relative;
  overflow: hidden;
  border-radius: 1.4rem;
  background: rgba(255, 255, 255, 0.1);
  box-shadow: 0 24px 60px rgba(1, 15, 72, 0.32);
}

.collage-large {
  grid-column: 1 / 2;
  grid-row: 1 / 2;
}

.collage-tall {
  grid-column: 2 / 3;
  grid-row: 1 / 3;
}

.collage-wide {
  grid-column: 1 / 2;
  grid-row: 2 / 3;
}

.collage-card img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

.card-overlay {
  position: absolute;
  inset: auto 0 0 0;
  padding: 1rem;
  background: linear-gradient(180deg, transparent, rgba(6, 15, 48, 0.82));
}

.card-overlay small {
  display: block;
  text-transform: uppercase;
  letter-spacing: 0.12em;
  opacity: 0.75;
}

.card-overlay h3 {
  margin: 0.25rem 0 0.2rem;
  font-size: 1.1rem;
  font-weight: 800;
}

.card-overlay p {
  margin: 0;
  font-weight: 700;
}

.pill-button {
  border: 0;
  border-radius: 999px;
  padding: 0.55rem 1rem;
  font-weight: 700;
  background: white;
  color: #0f62fe;
}

.stats-strip {
  background: rgba(255, 255, 255, 0.65);
  border-bottom: 1px solid rgba(15, 98, 254, 0.08);
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 1rem;
  padding: 1.3rem 0;
}

.stat-item {
  text-align: center;
}

.stat-item strong {
  display: block;
  font-size: 1.7rem;
  color: #0b1a43;
}

.stat-item span {
  color: #5d6b8b;
}

.flash-strip {
  background: linear-gradient(90deg, #ff7a18 0%, #ff5d19 100%);
  color: white;
}

.flash-banner {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 1rem;
  padding: 1rem 1.25rem;
}

.flash-label {
  text-transform: uppercase;
  letter-spacing: 0.1em;
  font-size: 0.72rem;
  font-weight: 800;
  opacity: 0.85;
}

.flash-meta {
  display: flex;
  align-items: center;
  gap: 0.55rem;
  flex-wrap: wrap;
}

.timer-chip {
  min-width: 2.4rem;
  height: 2.4rem;
  border-radius: 0.8rem;
  display: grid;
  place-items: center;
  font-weight: 800;
  background: rgba(255, 255, 255, 0.2);
}

.flash-btn {
  border-radius: 999px;
  font-weight: 800;
  color: #ff5d19;
}

.content-section {
  padding: 4.2rem 0;
}

.muted-section {
  background: #f6f9ff;
}

.section-heading {
  display: flex;
  align-items: end;
  justify-content: space-between;
  gap: 1rem;
  margin-bottom: 1.4rem;
}

.section-heading.centered {
  justify-content: center;
  text-align: center;
}

.section-heading h2 {
  margin: 0.15rem 0 0;
  font-size: clamp(1.8rem, 3vw, 2.4rem);
  font-weight: 900;
  color: #0b1a43;
}

.section-link {
  color: #0f62fe;
  font-weight: 800;
  text-decoration: none;
}

.category-strip {
  display: grid;
  grid-template-columns: repeat(6, minmax(0, 1fr));
  gap: 1rem;
}

.category-chip {
  border: 1px solid rgba(15, 98, 254, 0.12);
  background: white;
  border-radius: 1.2rem;
  padding: 1rem;
  text-align: center;
  box-shadow: 0 10px 25px rgba(17, 41, 104, 0.06);
}

.category-icon {
  width: 3rem;
  height: 3rem;
  margin: 0 auto 0.75rem;
  border-radius: 1rem;
  display: grid;
  place-items: center;
  background: linear-gradient(135deg, #0f62fe, #6b8cff);
  color: white;
  font-size: 1.1rem;
}

.category-chip strong,
.category-chip span {
  display: block;
}

.category-chip strong {
  color: #0b1a43;
}

.category-chip span {
  color: #6c7a99;
  font-size: 0.8rem;
}

.filter-pills {
  display: flex;
  flex-wrap: wrap;
  gap: 0.6rem;
  justify-content: flex-end;
}

.filter-pill {
  border: 1px solid rgba(15, 98, 254, 0.12);
  background: white;
  color: #0b1a43;
  border-radius: 999px;
  padding: 0.5rem 0.9rem;
  font-weight: 700;
}

.filter-pill.active {
  background: #0f62fe;
  color: white;
}

.products-grid {
  display: grid;
  grid-template-columns: repeat(4, minmax(0, 1fr));
  gap: 1rem;
}

.product-card-modern {
  position: relative;
  overflow: hidden;
  border-radius: 1.25rem;
  background: white;
  box-shadow: 0 14px 35px rgba(17, 41, 104, 0.08);
  cursor: pointer;
}

.product-badge {
  position: absolute;
  top: 0.8rem;
  left: 0.8rem;
  z-index: 2;
  background: #17c964;
  color: white;
  padding: 0.35rem 0.7rem;
  border-radius: 999px;
  font-size: 0.72rem;
  font-weight: 800;
}

.product-media {
  width: 100%;
  height: 210px;
  object-fit: cover;
  display: block;
}

.product-body {
  padding: 1rem;
}

.product-body small,
.arrival-body small {
  color: #6b7a98;
  text-transform: uppercase;
  letter-spacing: 0.08em;
  font-weight: 800;
}

.product-body h3,
.arrival-body h3 {
  font-size: 1rem;
  margin: 0.45rem 0;
  color: #0b1a43;
}

.product-rating {
  display: flex;
  align-items: center;
  gap: 0.15rem;
  color: #ffb400;
  font-size: 0.82rem;
}

.product-rating span {
  color: #6c7a99;
  margin-left: 0.45rem;
}

.product-footer,
.arrival-footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-top: 0.95rem;
}

.add-pill,
.mini-add {
  border: 0;
  border-radius: 999px;
  background: #0f62fe;
  color: white;
  font-weight: 800;
  padding: 0.52rem 1rem;
}

.deal-panel {
  display: grid;
  grid-template-columns: 1.05fr 0.95fr;
  gap: 1rem;
  border-radius: 1.6rem;
  padding: 2rem;
  background: linear-gradient(135deg, #0c1530 0%, #192e64 100%);
  color: white;
  box-shadow: 0 24px 50px rgba(8, 16, 40, 0.18);
}

.deal-copy h2 {
  margin: 0.55rem 0 0.8rem;
  font-size: clamp(2rem, 3vw, 2.9rem);
  font-weight: 900;
}

.deal-copy p {
  color: rgba(255, 255, 255, 0.8);
  max-width: 32rem;
}

.deal-price {
  display: flex;
  align-items: center;
  gap: 1rem;
  margin: 1rem 0;
}

.deal-price strong {
  font-size: 2.4rem;
}

.deal-price span {
  background: #17c964;
  color: white;
  padding: 0.3rem 0.6rem;
  border-radius: 999px;
  font-weight: 800;
}

.deal-actions {
  display: flex;
  gap: 0.8rem;
  flex-wrap: wrap;
}

.deal-visual {
  border-radius: 1.2rem;
  overflow: hidden;
  background: rgba(255, 255, 255, 0.12);
  min-height: 290px;
  display: grid;
  place-items: center;
}

.deal-visual img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.arrivals-grid {
  display: grid;
  grid-template-columns: repeat(4, minmax(0, 1fr));
  gap: 1rem;
}

.arrival-card {
  background: white;
  border-radius: 1.2rem;
  overflow: hidden;
  box-shadow: 0 14px 35px rgba(17, 41, 104, 0.08);
  cursor: pointer;
}

.arrival-card img {
  width: 100%;
  height: 180px;
  object-fit: cover;
}

.arrival-body {
  padding: 1rem;
}

.promo-grid {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 1rem;
}

.promo-card {
  border-radius: 1.25rem;
  padding: 1.5rem;
  color: white;
  min-height: 180px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  box-shadow: 0 18px 35px rgba(17, 41, 104, 0.14);
}

.promo-card small {
  text-transform: uppercase;
  letter-spacing: 0.08em;
  font-weight: 800;
}

.promo-card h3 {
  font-size: 1.4rem;
  font-weight: 900;
  margin: 0.45rem 0 1rem;
}

.promo-card a {
  color: white;
  font-weight: 800;
  text-decoration: none;
}

.promo-blue {
  background: linear-gradient(135deg, #0f62fe, #1ea7ff);
}

.promo-purple {
  background: linear-gradient(135deg, #7c3aed, #b25cff);
}

.promo-orange {
  background: linear-gradient(135deg, #ff7a18, #ff4d2e);
}

.testimonial-grid {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 1rem;
}

.testimonial-card {
  background: white;
  border-radius: 1.1rem;
  border: 1px solid rgba(15, 98, 254, 0.12);
  padding: 1.4rem;
  box-shadow: 0 10px 25px rgba(17, 41, 104, 0.06);
}

.stars {
  color: #ffb400;
  margin-bottom: 0.8rem;
}

.testimonial-card p {
  color: #24355f;
  line-height: 1.7;
}

.testimonial-person {
  display: flex;
  align-items: center;
  gap: 0.8rem;
  margin-top: 1rem;
}

.testimonial-person .avatar {
  width: 2.7rem;
  height: 2.7rem;
  border-radius: 50%;
  background: linear-gradient(135deg, #0f62fe, #6f8dff);
  color: white;
  display: grid;
  place-items: center;
  font-weight: 900;
}

.testimonial-person span {
  display: block;
  color: #6c7a99;
  font-size: 0.85rem;
}

.newsletter-panel {
  border-radius: 1.5rem;
  padding: 2rem;
  background: linear-gradient(135deg, #0f62fe, #6c2cff);
  color: white;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 1rem;
}

.newsletter-panel h2 {
  margin-top: 0.35rem;
  font-size: clamp(1.7rem, 3vw, 2.4rem);
  font-weight: 900;
  max-width: 18ch;
}

.newsletter-form {
  display: flex;
  gap: 0.75rem;
  flex-wrap: wrap;
}

.newsletter-form input {
  min-width: min(100%, 20rem);
  border: 0;
  border-radius: 999px;
  padding: 0.9rem 1rem;
  outline: none;
}

@media (max-width: 991px) {
  .hero-grid,
  .deal-panel,
  .newsletter-panel {
    grid-template-columns: 1fr;
    display: grid;
  }

  .hero-grid {
    min-height: auto;
    gap: 2.5rem;
  }

  .category-strip,
  .products-grid,
  .arrivals-grid,
  .promo-grid,
  .testimonial-grid {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }

  .stats-grid {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }
}

@media (max-width: 767px) {
  .hero-search {
    grid-template-columns: 1fr;
  }

  .category-strip,
  .products-grid,
  .arrivals-grid,
  .promo-grid,
  .testimonial-grid,
  .stats-grid {
    grid-template-columns: 1fr;
  }

  .flash-banner,
  .section-heading {
    flex-direction: column;
    align-items: flex-start;
  }
}
</style>
