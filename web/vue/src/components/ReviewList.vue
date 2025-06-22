<template>
  <div class="max-w-3xl mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Reviews</h2>

    <div v-if="loading" class="text-gray-600 animate-pulse">Loading...</div>
    <div v-else-if="error" class="text-red-600 bg-red-100 px-4 py-2 rounded">
      {{ error }}
    </div>
    <div v-else>
      <div v-if="reviews.length === 0" class="text-gray-500 italic">
        There are no reviews yet
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

            <template v-if="isAdmin">
              <!-- Admin template -->
              <div class="flex items-center space-x-2">
                <span
                  class="text-xs font-semibold px-2 py-1 rounded-full"
                  :class="statusClass(review.status)"
                >
                  {{ review.status }}
                </span>
                <button
                  @click="updateStatus(review.id, 'approved')"
                  :disabled="updating"
                  class="text-green-600 hover:text-green-800"
                  title="Одобрить"
                >
                  ✔️
                </button>
                <button
                  @click="updateStatus(review.id, 'rejected')"
                  :disabled="updating"
                  class="text-red-600 hover:text-red-800"
                  title="Отклонить"
                >
                  ❌
                </button>
              </div>
            </template>

            <template v-else>
              <!-- Guest template -->
              <span
                class="text-xs font-semibold px-2 py-1 rounded-full"
                :class="statusClass(review.status)"
              >
                {{ review.status }}
              </span>
            </template>
          </div>

          <p class="text-gray-800">{{ review.text }}</p>
          <p class="text-sm text-gray-400 mt-3">Создано: {{ review.created_at || '—' }}</p>
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import axios from 'axios'
import auth from '../store/auth'

const reviews = ref([])
const loading = ref(true)
const error = ref(null)
const updating = ref(false)

const isAdmin = computed(() => auth.state.isAdmin)
const token = computed(() => auth.state.token)

async function fetchReviews() {
  loading.value = true
  error.value = null

  try {
    const headers = token.value ? { Authorization: `Bearer ${token.value}` } : {}
    const { data } = await axios.get('/api/review', { headers })
    reviews.value = data
  } catch (err) {
    error.value = 'Loading error. Please try again later.'
    console.error(err)
  } finally {
    loading.value = false
  }
}

async function updateStatus(id, status) {
  try {
    updating.value = true
    const headers = token.value ? { Authorization: `Bearer ${token.value}` } : {}
    await axios.put(`/api/review/${id}`, { status }, { headers })

    // После успешного обновления — перезагружаем отзывы с сервера
    await fetchReviews()
  } catch (err) {
    console.error('Ошибка изменения статуса', err)
  } finally {
    updating.value = false
  }
}

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

onMounted(() => {
  fetchReviews()
})
</script>