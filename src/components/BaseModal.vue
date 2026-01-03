<template>
  <div v-if="visible" class="base-modal" @keydown.esc="emitClose" tabindex="-1">
    <div class="base-modal-inner" role="dialog" aria-modal="true">
      <button class="modal-close" @click="emitClose">×</button>
      <div class="base-modal-title" v-if="title"><h3 class="serif">{{ title }}</h3></div>
      <div class="base-modal-body">
        <slot />
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue'

const props = defineProps({ visible: { type: Boolean, default: false }, title: { type: String, default: '' } })
const emit = defineEmits(['close'])

const emitClose = () => emit('close')
</script>

<style scoped>
.base-modal {
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,0.68);
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 1rem;
  z-index: 1000;
  backdrop-filter: blur(4px) saturate(120%);
}
.base-modal-inner {
  background: #ffffff;
  color: #0b0b0b;
  padding: 1.5rem 1.75rem;
  border-radius: 12px;
  max-width: 920px;
  width: 100%;
  box-shadow: 0 10px 30px rgba(2,6,23,0.35);
  position: relative;
}
.modal-close {
  position: absolute;
  right: 0.75rem;
  top: 0.75rem;
  background: transparent;
  border: none;
  font-size: 1.4rem;
  cursor: pointer;
  line-height: 1;
  padding: 0.35rem;
  border-radius: 6px;
}
.base-modal-body { margin-top: 0.25rem }

@media (max-width: 480px) {
  .base-modal-inner { padding: 1rem; border-radius: 10px }
  .modal-close { right: 0; top: 0 }
}
</style>
