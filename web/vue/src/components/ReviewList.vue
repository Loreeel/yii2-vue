<template>
  <div class="max-w-3xl mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Отзывы</h2>

    <div v-if="loading" class="text-gray-600 animate-pulse">Загрузка отзывов...</div>
    <div v-else-if="error" class="text-red-600 bg-red-100 px-4 py-2 rounded">
      {{ error }}
    </div>
    <div v-else>
      <div v-if="reviews.length === 0" class="text-gray-500 italic">
        Пока нет отзывов.
      </div>

      <ul class="space-y-6">
        <li
          v-for="review in reviews"
          :key="review.id"
          class="bg-white border border-gray-200 shadow-sm rounded-xl p-6 hover:shadow-md transition-shadow duration-300"
        >
          <div class="flex justify-between items-center mb-2">
            <h3 class="text-xl font-semibold text-blue-700">
              {{ review.author_name }}
            </h3>
            <span
              class="text-xs font-semibold px-2 py-1 rounded-full"
              :class="statusClass(review.status)"
            >
              {{ review.status }}
            </span>
          </div>
          <p class="text-gray-800">{{ review.text }}</p>
          <p class="text-sm text-gray-400 mt-3">Создано: {{ review.created_at || '—' }}</p>
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const reviews = ref([])
const loading = ref(true)
const error = ref(null)

onMounted(async () => {
  try {
    const { data } = await axios.get('/api/review')
    reviews.value = data
  } catch (err) {
    error.value = 'Ошибка загрузки отзывов'
    console.error(err)
  } finally {
    loading.value = false
  }
})

function statusClass(status) {
  switch (status) {
    case 'approved':
      return 'bg-green-100 text-green-700'
    case 'pending':
      return 'bg-yellow-100 text-yellow-700'
    case 'rejected':
      return 'bg-red-100 text-red-700'
    default:
      return 'bg-gray-100 text-gray-600'
  }
}
</script>
