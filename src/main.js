import { createApp } from 'vue'
import { createI18n } from 'vue-i18n'
import App from './App.vue'
import '../style/index.css'

import en from './locales/en.json'
import fr from './locales/fr.json'
import de from './locales/de.json'
import nl from './locales/nl.json'
import es from './locales/es.json'

const messages = {
	en,
	fr,
	de,
	nl,
	es
}

const defaultLocale = localStorage.getItem('locale') || (navigator.language || 'en').split('-')[0]

const i18n = createI18n({
	legacy: false,
	locale: messages[defaultLocale] ? defaultLocale : 'en',
	fallbackLocale: 'en',
	messages
})

createApp(App).use(i18n).mount('#app')
