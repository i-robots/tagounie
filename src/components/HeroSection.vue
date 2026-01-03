<template>
  <header>
    <section id="home" class="hero">
      <div class="hero-content fade-in">
        <h1 class="serif">{{ $t('hero.title') }}</h1>
        <div class="hero-subtitle">{{ $t('hero.subtitle') }}</div>
        <p>{{ $t('hero.paragraph') }}</p>
        <a href="#join" class="cta-button">{{ $t('hero.cta') }}</a>
      </div>
    </section>
  </header>
</template>

<script setup>
// Static hero section — no props required
</script>

<style scoped>
/* keep styling via main styles */
</style>
