<template>
  <footer class="site-footer">
    <div class="container">
      <div class="footer-top">
        <div class="footer-brand">
          <div class="footer-mark">
            <i class="bi bi-bag-heart-fill"></i>
          </div>
          <div>
            <h3>NovaMart</h3>
            <p>Curated commerce with a clean, modern shopping experience.</p>
          </div>
        </div>

        <div class="footer-columns">
          <div class="footer-col">
            <h4>Quick Links</h4>
            <router-link to="/">Home</router-link>
            <router-link to="/products">All Products</router-link>
            <router-link to="/orders">Orders</router-link>
            <router-link to="/wishlist">Wishlist</router-link>
          </div>
          <div class="footer-col">
            <h4>My Account</h4>
            <router-link to="/profile">Profile</router-link>
            <router-link to="/cart">Cart</router-link>
            <router-link to="/checkout">Checkout</router-link>
            <router-link to="/login">Login</router-link>
          </div>
          <div class="footer-col">
            <h4>Help</h4>
            <a href="#">FAQ</a>
            <a href="#">Shipping Policy</a>
            <a href="#">Returns & Refunds</a>
            <a href="#">Contact Support</a>
          </div>
        </div>
      </div>

      <div class="footer-bottom">
        <span>&copy; 2026 NovaMart. All rights reserved.</span>
        <div class="social-row">
          <a href="#"><i class="bi bi-facebook"></i></a>
          <a href="#"><i class="bi bi-instagram"></i></a>
          <a href="#"><i class="bi bi-twitter-x"></i></a>
          <a href="#"><i class="bi bi-youtube"></i></a>
        </div>
      </div>
    </div>
  </footer>
</template>

<script setup>
</script>

<style scoped>
.site-footer {
  margin-top: 4rem;
  background: #081124;
  color: white;
  padding: 3.5rem 0 1.5rem;
}

.footer-top {
  display: grid;
  grid-template-columns: 1.1fr 1fr;
  gap: 2rem;
  padding-bottom: 2rem;
}

.footer-brand {
  display: flex;
  gap: 1rem;
  align-items: flex-start;
}

.footer-mark {
  width: 3rem;
  height: 3rem;
  border-radius: 1rem;
  display: grid;
  place-items: center;
  background: linear-gradient(135deg, #0f62fe, #5a8dff);
}

.footer-brand h3 {
  margin: 0;
  font-weight: 900;
}

.footer-brand p {
  margin: 0.45rem 0 0;
  color: rgba(255, 255, 255, 0.72);
  max-width: 28rem;
}

.footer-columns {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 1rem;
}

.footer-col h4 {
  font-size: 0.95rem;
  margin-bottom: 0.95rem;
  font-weight: 800;
}

.footer-col a {
  display: block;
  color: rgba(255, 255, 255, 0.75);
  text-decoration: none;
  margin-bottom: 0.6rem;
}

.footer-bottom {
  border-top: 1px solid rgba(255, 255, 255, 0.1);
  padding-top: 1rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 1rem;
}

.social-row {
  display: flex;
  gap: 0.7rem;
}

.social-row a {
  width: 2.4rem;
  height: 2.4rem;
  border-radius: 50%;
  display: grid;
  place-items: center;
  color: white;
  background: rgba(255, 255, 255, 0.08);
  text-decoration: none;
}

@media (max-width: 991px) {
  .footer-top,
  .footer-columns {
    grid-template-columns: 1fr;
  }

  .footer-bottom {
    flex-direction: column;
    align-items: flex-start;
  }
}
</style>
