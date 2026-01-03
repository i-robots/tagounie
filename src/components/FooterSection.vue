<template>
  <footer>
    <div class="footer-content">
      <div class="footer-section">
        <h3 class="serif">{{ $t('footer.title') }}</h3>
        <p>{{ $t('footer.description') }}</p>
      </div>

      <div class="footer-section">
        <h3>Quick Links</h3>
        <ul class="footer-links">
          <li><a href="#home">{{ $t('footer.quickLinks.home') }}</a></li>
          <li><a href="#experience">{{ $t('footer.quickLinks.experience') }}</a></li>
          <li><a href="#activities">{{ $t('footer.quickLinks.activities') }}</a></li>
          <li><a href="#location">{{ $t('footer.quickLinks.location') }}</a></li>
        </ul>
      </div>

      <div class="footer-section">
        <h3>What We Do</h3>
        <div style="display: flex; flex-wrap: wrap; gap: 0.5rem; margin-top: 1rem;">
          <template v-for="tag in 4" :key="tag">
            <span style="background: rgba(255,255,255,0.1); padding: 0.3rem 0.6rem; border-radius: 20px; font-size: 0.8rem;">{{ $t(`footer.tags[${tag}]`)}}</span>
          </template>
        </div>
      </div>
    </div>

    <div style="    padding-bottom: 1rem;">
      <div class="copyright">{{ $t('footer.copyright') }}</div>
      <div class="lang-select">
        <label for="lang" style="margin-right:0.5rem; font-weight:600;">Language</label>
        <select id="lang" v-model="locale" @change="onLocaleChange">
          <option value="en">EN</option>
          <option value="fr">FR</option>
          <option value="de">DE</option>
          <option value="nl">NL</option>
          <option value="es">ES</option>
        </select>
      </div>
    </div>
  </footer>
</template>

<script setup>
import { useI18n } from 'vue-i18n'

const { locale } = useI18n()

const onLocaleChange = () => {
  localStorage.setItem('locale', locale.value)
}
</script>

<style scoped>
.lang-select  {
  float: right;
}

.lang-select select{
  background: rgba(255,255,255,0.06);
  border: 1px solid rgba(255,255,255,0.08);
  padding: 0.35rem 0.6rem;
  color: white;
  border-radius: 8px;
  font-weight:600;
}

.lang-select select option{
  color: black;
}
.lang-select select:focus{ 
  outline: none; 
  box-shadow: 0 6px 18px rgba(0,0,0,0.18); 
}

@media screen and (max-width: 768px) {
  .lang-select  {
    margin-top: 1rem;
    float: unset;
    text-align: center;
  }
}
</style>
