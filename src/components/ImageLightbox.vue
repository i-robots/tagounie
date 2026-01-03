<template>
  <BaseModal :visible="props.visible" @close="$emit('close')" class="base-modal">
    <div class="image-lightbox">
      <ImageCarousel :total="props.total" :start="props.start" />
    </div>
  </BaseModal>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue'
import BaseModal from './BaseModal.vue'
import ImageCarousel from './ImageCarousel.vue'

const props = defineProps({ visible: { type: Boolean, default: false }, start: { type: Number, default: 1 }, total: { type: Number, default: 22 } })
const emit = defineEmits(['close'])
</script>

<style scoped>
.image-lightbox { display: flex; align-items: center; justify-content: center; }
.base-modal {
  padding-top: 5rem;
}
@media (max-width: 780px) {
  .base-modal {
    padding-top: 0;
  }
}
</style>
