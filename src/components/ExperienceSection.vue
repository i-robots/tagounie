<template>
  <section id="experience">
    <h2 class="section-title serif">{{ $t('experience.aboutTitle') }}</h2>
    <div class="about-content">
      <p>{{ $t('experience.aboutParagraph') }}</p>
    </div>

    <div class="experience-grid">
      <div class="experience-item fade-in" v-for="(exp, index) in experiences" :key="index">
        <div class="experience-icon">{{ exp.icon }}</div>
        <h3>{{ exp.title }}</h3>
        <p>{{ exp.description }}</p>
      </div>
    </div>
  </section>
</template>

<script setup>
const props = defineProps({
  experiences: { type: Array, required: true }
})
</script>

<style scoped></style>
