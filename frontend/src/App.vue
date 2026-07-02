<template>
  <div id="app">
    <Navbar />
    <router-view />
    <Chatbot />
    <Footer />
  </div>
</template>

<script setup>
import Navbar from './components/layout/Navbar.vue'
import Chatbot from './components/layout/Chatbot.vue'
import Footer from './components/layout/Footer.vue'
</script>
