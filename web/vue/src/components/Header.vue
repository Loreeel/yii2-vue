<template>
  <header class="p-4 bg-gray-100 flex justify-between items-center">
    <h1 class="text-xl font-bold">Yii2+Vue test task</h1>
    <div>
      <button v-if="authState.isAdmin" @click="logout" class="bg-red-600 text-white px-3 py-1 rounded">Logout</button>
      <button v-else @click="showLogin = true" class="bg-green-600 text-white px-3 py-1 rounded">Login</button>
    </div>
    <AdminLoginModal :visible="showLogin" @close="showLogin = false" />
  </header>
</template>

<script setup>
import { ref } from 'vue'
import AdminLoginModal from './AdminLoginModal.vue'
import auth from '../store/auth'
import { useRouter } from 'vue-router'

const showLogin = ref(false)
const router = useRouter()

const authState = auth.state

function logout() {
  auth.logout()
  router.push('/')
}
</script>