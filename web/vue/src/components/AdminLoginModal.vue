<template>
  <div class="fixed inset-0 flex items-center justify-center bg-black/50" v-if="visible">
    <div class="bg-white p-6 rounded-xl w-full max-w-sm">
      <h2 class="text-xl font-bold mb-4">Login as admin</h2>

      <input
        v-model="token"
        type="password"
        placeholder="Input admin token"
        class="border w-full p-2 rounded mb-2"
        :class="{ 'border-red-500': error }"
      />
      <div v-if="error" class="text-red-500 text-sm mb-2">
        {{ error }}
      </div>

      <button
        @click="login"
        class="bg-blue-600 text-white px-4 py-2 rounded w-full"
        :disabled="loading"
      >
        {{ loading ? 'Checking...' : 'Login' }}
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'
import auth from '../store/auth'

const props = defineProps({ visible: Boolean })
const emit = defineEmits(['close'])

const token = ref('')
const error = ref('')
const loading = ref(false)
const router = useRouter()

async function login() {
  loading.value = true
  error.value = ''

  try {
    const response = await axios.post('/api/auth/login', null, {
      headers: {
        Authorization: `Bearer ${token.value.trim()}`,
      },
    })

    auth.setToken(response.data.access_token)
    emit('close')
    router.push('/admin')
  } catch (e) {
    if (e.response?.status === 401) {
      error.value = 'Wrong token. Please try again.'
    } else {
      error.value = 'Server error.'
    }
  } finally {
    loading.value = false
  }
}
</script>
