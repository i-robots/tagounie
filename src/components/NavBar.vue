<template>
  <nav>
    <div class="logo serif" tabindex="0" @click="scrollTop" @keydown.enter="scrollTop">Tagounite Sahara</div>
    <button class="mobile-menu-btn" @click="menuOpen = !menuOpen">☰</button>
    <ul class="nav-links" :class="{ 'active': menuOpen }">
      <li><a href="#home" @click="closeMenu">{{ $t('nav.home') }}</a></li>
      <li><a href="#experience" @click="closeMenu">{{ $t('nav.experience') }}</a></li>
      <li><a href="#activities" @click="closeMenu">{{ $t('nav.activities') }}</a></li>
      <li><a href="#location" @click="closeMenu">{{ $t('nav.location') }}</a></li>
      <li><a href="#join" @click="closeMenu" class="cta-button">{{ $t('nav.join') }}</a></li>
      
    </ul>
  </nav>
</template>

<script setup>
import { ref } from 'vue'

const menuOpen = ref(false)
const closeMenu = () => { menuOpen.value = false }
const scrollTop = () => {
  menuOpen.value = false
  window.scrollTo({ top: 0, behavior: 'smooth' })
}
</script>

<style scoped>
.logo { cursor: pointer }
</style>
