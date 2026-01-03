<template>
  <div class="image-carousel">
    <div class="carousel-main">
      <button class="nav left" @click="prev" aria-label="Previous">‹</button>
      <img :src="src" :alt="alt" @click="openLightbox" loading="lazy" />
      <button class="nav right" @click="next" aria-label="Next">›</button>
    </div>

    <div class="thumbs" role="list" ref="thumbsRef">
      <div v-for="i in total" :key="i" class="thumb" :class="{active: i === index}" :data-index="i" @click="setIndex(i)">
        <img :src="`images/WhatsApp_${i}.jpeg`" :alt="`Thumb ${i}`" loading="lazy" />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch, onMounted, nextTick } from 'vue'

const props = defineProps({ total: { type: Number, default: 22 }, start: { type: Number, default: 1 } })
const emit = defineEmits(['open'])

const index = ref(Math.min(Math.max(props.start, 1), props.total))
const thumbsRef = ref(null)

const prev = () => { index.value = index.value === 1 ? props.total : index.value - 1 }
const next = () => { index.value = index.value === props.total ? 1 : index.value + 1 }
const setIndex = (i) => { index.value = i }

const src = computed(() => `images/WhatsApp_${index.value}.jpeg`)
const alt = computed(() => `Tagounite desert experience ${index.value}`)

const openLightbox = () => emit('open', src.value, alt.value)

const scrollThumbIntoView = async (i) => {
  await nextTick()
  const container = thumbsRef.value
  if (!container) return
  const active = container.querySelector(`[data-index='${i}']`)
  if (active && typeof active.scrollIntoView === 'function') {
    active.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' })
  }
}

watch(() => props.start, (v) => {
  const newIndex = Math.min(Math.max(v || 1, 1), props.total)
  index.value = newIndex
  scrollThumbIntoView(newIndex)
})

watch(index, (v) => scrollThumbIntoView(v))

onMounted(() => scrollThumbIntoView(index.value))
</script>

<style scoped>
.image-carousel { display: flex; flex-direction: column; gap: 0.75rem; align-items: center; }
.carousel-main { position: relative; display: flex; align-items: center; justify-content: center; width: 100%; }
.carousel-main img { max-width: 100%; max-height: 60vh; border-radius: 8px; cursor: pointer; }
.nav { position: absolute; top: 50%; transform: translateY(-50%); background: rgba(0,0,0,0.45); color: white; border: none; padding: 0.5rem 0.75rem; font-size: 1.6rem; cursor: pointer; border-radius: 6px; }
.nav.left { left: 0.5rem }
.nav.right { right: 0.5rem }
.thumbs { display: flex; gap: 0.5rem; overflow-x: auto; padding: 0.25rem 0; max-width: 70vw; }
.thumb { flex: 0 0 auto; width: 72px; height: 48px; border-radius: 6px; overflow: hidden; cursor: pointer; border: 2px solid transparent; }
.thumb img { width: 100%; height: 100%; object-fit: cover; display: block; }
.thumb.active { border-color: var(--primary, #c57a3a); }
</style>
