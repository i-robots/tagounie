<template>
  <section id="activities" class="activities-section">
    <h2 class="section-title serif">{{ $t('experience.whatYouCanDo') }}</h2>
    <p class="about-content">{{ $t('experience.activitiesIntro') }}</p>

    <div class="activity-categories">
      <div class="category fade-in" v-for="(category, index) in activityCategories" :key="index">
        <h3>{{ category.title }}</h3>
        <ul>
          <li v-for="(item, i) in category.items" :key="i">{{ item }}</li>
        </ul>
      </div>
    </div>
  </section>
</template>

<script setup>
const props = defineProps({
  activityCategories: { type: Array, required: true }
})
</script>

<style scoped></style>
