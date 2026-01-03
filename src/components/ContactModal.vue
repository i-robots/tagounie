<template>
  <BaseModal :visible="visible" :title="$t('contact.title')" @close="$emit('close')">
    <form class="contact-form" @submit.prevent="submit">
      <input type="text" :placeholder="$t('contact.namePlaceholder')" required />
      <input type="email" :placeholder="$t('contact.emailPlaceholder')" required />
      <textarea :placeholder="$t('contact.messagePlaceholder')" rows="4" required></textarea>
      <button type="submit" class="cta-button">{{ $t('contact.send') }}</button>
    </form>
  </BaseModal>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue'
import BaseModal from './BaseModal.vue'
import { useI18n } from 'vue-i18n'

const props = defineProps({ visible: { type: Boolean, default: false } })
const emit = defineEmits(['close'])
const { t } = useI18n()

const submit = () => {
  alert(t('contact.thanks'))
  setTimeout(() => emit('close'), 120)
}
</script>

<style scoped>
.contact-form{
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
  padding: 0.5rem 0;
  width: 100%;
}
.contact-form input,
.contact-form textarea{
  width: 100%;
  padding: 0.75rem 0.9rem;
  border-radius: 12px;
  border: 1px solid rgba(15,23,42,0.08);
  background: rgba(255,255,255,0.95);
  box-shadow: 0 1px 2px rgba(16,24,40,0.03);
  font-size: 0.95rem;
  outline: none;
  transition: box-shadow 150ms ease, transform 120ms ease, border-color 150ms ease;
}
.contact-form input::placeholder,
.contact-form textarea::placeholder{
  color: #9ca3af;
}
.contact-form input:focus,
.contact-form textarea:focus{
  border-color: rgba(245,158,11,0.9);
  box-shadow: 0 6px 18px rgba(245,158,11,0.12);
  transform: translateY(-1px);
}
.contact-form textarea{
  resize: vertical;
  min-height: 110px;
}
.contact-form .cta-button{
  margin-top: 0.25rem;
  align-self: flex-end;
  padding: 0.6rem 1.05rem;
  font-weight: 600;
  border-radius: 10px;
  border: none;
  cursor: pointer;
  color: #fff;
  background: linear-gradient(90deg, #f6c23e 0%, #f59e0b 100%);
  box-shadow: 0 8px 20px rgba(246,194,62,0.18);
  transition: transform 140ms ease, box-shadow 140ms ease, opacity 120ms ease;
}
.contact-form .cta-button:hover{
  transform: translateY(-2px);
  box-shadow: 0 12px 30px rgba(246,194,62,0.22);
}
</style>