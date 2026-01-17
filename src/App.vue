<template>
  <div id="app">
    <NavBar />
    <div id="nav-placeholder"></div>

    <HeroSection />

    <ExperienceSection :experiences="experiences" />

    <ActivitiesSection :activityCategories="activityCategories" />

    <!-- Unique Experiences -->
    <section class="unique-experiences">
      <h2 class="section-title serif">Unique Desert Experiences</h2>
      <div class="experience-grid">
        <div class="experience-item fade-in" v-for="(exp, index) in uniqueExperiences" :key="index">
          <div class="experience-icon">{{ exp.icon }}</div>
          <h3>{{ exp.title }}</h3>
        </div>
      </div>
    </section>

    <!-- Gallery Section -->
    <section class="gallery">
      <h2 class="section-title serif">Life in Tagounite</h2>
      <div class="gallery-grid">
        <div class="gallery-item fade-in" v-for="n in galleryCount" :key="n" @click="openLightbox(1 + n)" style="cursor: pointer;">
          <img :src="`images/WhatsApp_${1 + n}.jpeg`" :alt="`Tagounite desert experience ${n}`" loading="lazy">
        </div>
      </div>
    </section>

    <!-- Video Section -->
    <section class="video-section">
      <h2 class="section-title serif">Experience Tagounite</h2>
      <p class="about-content">See what life is like in our desert oasis community</p>
      <div class="video-container fade-in">
        <div class="video-player-wrapper">
          <video src="../public/images/WhatsApp Video 2026-01-01 at 7.28.17 PM.mp4" controls autoplay loop muted></video>
          <video src="../public/images/WhatsApp Video 2026-01-01 at 7.28.24 PM.mp4" controls autoplay loop muted></video>
        </div>
      </div>
    </section>

    <!-- Location & Travel -->
    <section id="location">
      <h2 class="section-title serif">Location – Tagounite, Morocco</h2>
      <div class="location-content">
        <div>
          <p>Our project is located in Tagounite, a peaceful village in southern Morocco, near the Drâa Valley. The area is known for its palm groves, desert landscapes, and warm local culture. Life here is calm, natural, and far away from big cities.</p>
          <ul style="margin-top: 1rem; padding-left: 1.5rem;">
            <li>Gateway to the Sahara Desert</li>
            <li>Authentic village life</li>
            <li>Far from tourist crowds</li>
            <li>Surrounded by palm trees, dunes and open skies</li>
          </ul>

          <div class="travel-steps">
            <h3>How to Get to Tagounite</h3>
            <div class="travel-step" v-for="(step, index) in travelSteps" :key="index">
              <div class="step-number">{{ index + 1 }}</div>
              <div>
                <strong>{{ step.title }}</strong>
                <p>{{ step.description }}</p>
              </div>
            </div>
          </div>
        </div>

        <div class="map-container fade-in">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3446.693615983712!2d-5.5869303!3d29.9775238!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjnCsDU4JzM5LjEiTiA1wrAzNScwNS4xIlc!5e0!3m2!1sen!2s!4v1690000000000!5m2!1sen!2s" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </section>

    <section id="accommodation">
      <h2 class="section-title serif">🛏️ Accommodation, Facilities & Safety</h2>
      <div class="accom-columns fade-in">
        <div class="section-cont">
          <div class="accommodation-card">
            <p style="font-size: larger; margin-bottom: 1rem;"><strong>Where will I sleep? Is it clean?</strong></p>
            <p>Volunteers stay in our on-site hostel, located directly on the farm. The accommodation is simple, clean, and peaceful.</p>
            <ul>
              <li>Shared or private rooms (depending on availability)</li>
              <li>Clean mattresses, blankets, and mosquito protection</li>
              <li>Regular cleaning of rooms and common areas</li>
            </ul>
          </div>
          <MedicalSection />
        </div>
        <div class="safety-card fade-in">
          <p style="font-size: larger; margin-bottom: 1rem;"><strong>Is it safe for volunteers? Especially women?</strong></p>
          <p style="margin-bottom: 1rem;">Safety is one of our top priorities. Tagounite is a quiet and traditional village where people know each other and look out for one another.</p>
          <p>We regularly host solo female volunteers and women feel safe and respected here. The project is family-oriented, and there is zero tolerance for harassment or unsafe behavior.</p>
          <ul>
            <li>We clearly explain cultural norms</li>
            <li>Provide guidance on clothing and local customs</li>
            <li>Are always available if a volunteer feels uncomfortable</li>
            <li>You will never be left alone in unsafe situations</li>
          </ul>
        </div>
      </div>
    </section>

    <!-- Who is it for -->
    <section class="who-for">
      <h2 class="section-title serif">Who This Experience Is For</h2>
      <div class="experience-grid">
        <div class="experience-item fade-in" v-for="(item, index) in whoFor" :key="index">
          <p>{{ item }}</p>
        </div>
      </div>
      <p style="text-align: center; margin-top: 2rem; font-style: italic;">No special skills required — just curiosity and respect.</p>
    </section>

    <IncludedSection />
    <HostSection />

    <!-- Join Section -->
    <section id="join" class="join-section">
      <h2 class="section-title serif" style="color: white;">Join Us</h2>
      <div class="about-content" style="color: #ccc;">
        <p style="font-size: 1.5rem; margin-bottom: 1rem;">Come as a volunteer.</p>
        <p>Leave as family.</p>
      </div>
      <div style="margin-top: 1rem;">
        <a href="mailto:info@tagounitedesert.life" class="cta-button" style="margin-right: 1rem;">Email Us</a>
        <button class="cta-button" @click="showContactForm = true" style="background: transparent; border: 2px solid var(--primary);">Contact Us</button>
      </div>
    </section>

    <FooterSection />

    <ContactModal :visible="showContactForm" @close="showContactForm = false" />
    <ImageLightbox :visible="lightboxVisible" :start="lightboxIndex" :total="22" @close="closeLightbox" />
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import NavBar from './components/NavBar.vue'
import HeroSection from './components/HeroSection.vue'
import ExperienceSection from './components/ExperienceSection.vue'
import ActivitiesSection from './components/ActivitiesSection.vue'
import ContactModal from './components/ContactModal.vue'
import FooterSection from './components/FooterSection.vue'
import ImageLightbox from './components/ImageLightbox.vue'
import IncludedSection from './components/IncludedSection.vue'
import HostSection from './components/HostSection.vue'
import MedicalSection from './components/MedicalSection.vue'

const showContactForm = ref(false)

const experiences = ref([
  { icon: '🏠', title: 'Live Simply', description: 'Live simply and sustainably in harmony with nature' },
  { icon: '👨‍👩‍👧‍👦', title: 'Share Daily Life', description: 'Share daily life with the local community' },
  { icon: '🎨', title: 'Learn Traditions', description: 'Learn traditional skills passed down through generations' },
  { icon: '🌿', title: 'Reconnect', description: 'Disconnect from stress and reconnect with nature' }
])

const activityCategories = ref([
  {
    title: '🌿 Culture & Community',
    items: [
      'Cultural exchange and language practice',
      'Moroccan Arabic (Darija) & Amazigh basics',
      'Storytelling evenings with locals',
      'Traditional music & drumming nights',
      'Henna art workshops',
      'Bread baking in clay ovens',
      'Local market visits & bartering'
    ]
  },
  {
    title: '🌵 Nature & Sustainability',
    items: [
      'Farm work (planting, watering, harvesting)',
      'Helping with animals',
      'Desert ecology & oasis farming',
      'Permaculture & water-saving techniques',
      'Palm tree care & irrigation systems',
      'Hostel support (cleaning, organizing, welcoming guests)',
      'Gardening and eco-projects'
    ]
  },
  {
    title: '🐪 Adventure & Well-being',
    items: [
      'Multi-day camel trekking',
      'Star gazing & astronomy',
      'Sunrise & sunset desert walks',
      'Sandboarding on dunes',
      'Desert meditation & breathwork',
      'Yoga at sunrise/sunset',
    ]
  }
])

const uniqueExperiences = ref([
  { icon: '🐪', title: 'Camel Trekking through Sahara' },
  { icon: '🌌', title: 'Sleeping Under the Stars' },
  { icon: '🔥', title: 'Campfire Story Evenings' },
  { icon: '🌴', title: 'Life in an Oasis Village' },
  { icon: '🧭', title: 'Learning from Nomadic Guides' },
  { icon: '🌅', title: 'Sunrise Walks in Dunes' },
  { icon: '🍞', title:  'Natural building (mud, clay, palm leaves)' },
  { icon: '🎶', title: 'Traditional Music & Drumming' }
])

const travelSteps = ref([
  { title: 'Fly to Morocco', description: 'Fly to Marrakech (RAK), Ouarzazate (OZZ), or Agadir (AGA)' },
  { title: 'Bus to Zagora', description: 'Take CTM/Supratours bus from Marrakech (7-8 hours)' },
  { title: 'Transfer to Tagounite', description: '45-minute shared taxi or private pickup from Zagora' },
  { title: 'Arrive & Settle', description: 'Welcome to our peaceful desert oasis community' }
])

const whoFor = ref([
  'Love nature and simple living',
  'Are curious about other cultures',
  'Want to escape mass tourism',
  'Are open-minded and respectful',
  'Enjoy meaningful connections',
  'Looking for peace, adventure and purpose',
  'Solar cooking & off-grid living',
  'Visit most beautiful oasis regions'
])

// showContactForm is handled by ContactModal via emits

  const lightboxVisible = ref(false)
  const lightboxIndex = ref(1)

  // responsive gallery count: 14 when >1378px, otherwise 12
  const galleryCount = ref(12)
  const updateGalleryCount = () => {
    galleryCount.value = window.innerWidth > 1377 ? 15 : 12
  }

  const openLightbox = (index = 1) => {
    lightboxIndex.value = index
    lightboxVisible.value = true
  }

  const closeLightbox = () => { lightboxVisible.value = false }

onMounted(() => {
  const selectors = '.experience-item, .category, .gallery-item, .video-container, .map-container, section'
  let elements = Array.from(document.querySelectorAll(selectors)).filter(el => !el.classList.contains('fade-in'))
  elements.forEach(el => el.classList.add('reveal'))

  const observer = new IntersectionObserver((entries, obs) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('in-view')
        obs.unobserve(entry.target)
      }
    })
  }, { threshold: 0.12 })

  document.querySelectorAll('.reveal').forEach(el => observer.observe(el))

  const hero = document.querySelector('.hero-content')
  if (hero) setTimeout(() => hero.classList.add('in-view'), 120)

  const navEl = document.querySelector('nav')
  const placeholder = document.querySelector('#nav-placeholder')

  const setPlaceholder = () => {
    if (navEl && placeholder) {
      const h = navEl.offsetHeight
      placeholder.style.height = h + 'px'
      document.documentElement.style.setProperty('--nav-height', h + 'px')
    }
  }

  setPlaceholder()
  window.addEventListener('resize', setPlaceholder)
  // keep gallery count in sync
  updateGalleryCount()
  window.addEventListener('resize', updateGalleryCount)

  const handleNav = () => {
    if (!navEl || !placeholder) return
    if (window.scrollY > 80) navEl.classList.add('scrolled')
    else navEl.classList.remove('scrolled')

    requestAnimationFrame(() => {
      const h = Math.round(navEl.getBoundingClientRect().height)
      placeholder.style.height = h + 'px'
      document.documentElement.style.setProperty('--nav-height', h + 'px')
    })
  }

  handleNav()
  window.addEventListener('scroll', handleNav, { passive: true })
})

onUnmounted(() => {
  window.removeEventListener('resize', updateGalleryCount)
})
</script>