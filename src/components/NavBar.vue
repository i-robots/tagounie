<template>
  <nav>
    <div class="logo serif">Tagounite Sahara</div>
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
</script>

<style scoped>
/* minimal scoped rules if needed */
</style>
