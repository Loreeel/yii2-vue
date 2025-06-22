<template>
  <div class="max-w-xl mx-auto p-4 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Write your review</h2>

    <form @submit.prevent="submitReview" novalidate class="space-y-4">
      <div>
        <label class="block mb-1 font-semibold" for="author_name">Name</label>
        <input
          id="author_name"
          v-model="authorName"
          type="text"
          required
          class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
          placeholder="Input your name"
        />
      </div>

      <div>
        <label class="block mb-1 font-semibold" for="text">Review</label>
        <textarea
          id="text"
          v-model="text"
          rows="4"
          required
          class="w-full border border-gray-300 rounded px-3 py-2 resize-none focus:outline-none focus:ring-2 focus:ring-blue-500"
          placeholder="Write your review here"
        ></textarea>
      </div>

      <div v-if="error" class="text-red-600 font-semibold">{{ error }}</div>
      <div v-if="success" class="text-green-600 font-semibold">Thank you! The review has been sent for moderation.</div>

      <button
        type="submit"
        :disabled="loading"
        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 disabled:opacity-50 cursor-pointer"
      >
        {{ loading ? 'Loading...' : 'Send' }}
      </button>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const authorName = ref('')
const text = ref('')
const loading = ref(false)
const error = ref('')
const success = ref(false)

async function submitReview() {
  error.value = ''
  success.value = false
  if (!authorName.value.trim() || !text.value.trim()) {
    error.value = 'Fill all fields.'
    return
  }

  loading.value = true
  try {
    await axios.post('/api/review', {
      author_name: authorName.value.trim(),
      text: text.value.trim(),
    })
    success.value = true
    authorName.value = ''
    text.value = ''
  } catch (err) {
    error.value = 'Error creating review. Please try again later.'
    console.error(err)
  } finally {
    loading.value = false
  }
}
</script>
