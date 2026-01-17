<template>
  <BaseModal :visible="visible" :title="$t('contact.title')" @close="$emit('close')">
    <form class="contact-form" @submit.prevent="submit">
      <input name="name" type="text" :placeholder="$t('contact.namePlaceholder')" required />
      <input name="email" type="email" :placeholder="$t('contact.emailPlaceholder')" required />
      <textarea name="message" :placeholder="$t('contact.messagePlaceholder')" rows="4" required></textarea>
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

const submit = async (e) => {
  // validate required fields before building FormData
  const form = e.target
  const nameInput = form.querySelector('[name="name"]')
  const emailInput = form.querySelector('[name="email"]')
  const name = (nameInput?.value || '').trim()
  const email = (emailInput?.value || '').trim()

  // clear previous custom validity messages
  nameInput?.setCustomValidity('')
  emailInput?.setCustomValidity('')

  if (!name) {
    const msg = t('contact.nameRequired') || 'Please provide your name'
    nameInput?.setCustomValidity(msg)
    nameInput?.reportValidity()
    nameInput?.focus()
    return
  }

  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
  if (!email || !emailRegex.test(email)) {
    const msg = t('contact.emailInvalid') || 'Please provide a valid email'
    emailInput?.setCustomValidity(msg)
    emailInput?.reportValidity()
    emailInput?.focus()
    return
  }

  // build FormData from the submitted form
  const formData = new FormData(form)

  try {
    const res = await fetch('/contact.php', { method: 'POST', body: formData })
    const text = await res.text()

    // If the PHP returns the success block (contains .w-form-done), show it inline
    if (res.ok && text.includes('w-form-done')) {
      // replace form contents with server response
      form.innerHTML = text
      setTimeout(() => emit('close'), 1200)
      return
    }

    // Otherwise try to show a failure message parsed from the response
    try {
      const parser = new DOMParser()
      const doc = parser.parseFromString(text, 'text/html')
      const fail = doc.querySelector('.w-form-fail')
      const msg = fail ? fail.textContent.trim() : (doc.body.textContent || '').trim()
      console.warn('Contact form submission failed:', msg)
    } catch (parseErr) {
      console.warn(t('contact.error') || 'Submission failed')
    }
  } catch (err) {
    console.warn(err)
  }
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