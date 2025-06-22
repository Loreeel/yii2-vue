import { reactive } from 'vue'
import axios from 'axios'

const state = reactive({
  isAdmin: false,
  token: null,
})

function setToken(token) {
  state.token = token
  state.isAdmin = true
  axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
  localStorage.setItem('admin_token', token)
}

function logout() {
  state.token = null
  state.isAdmin = false
  delete axios.defaults.headers.common['Authorization']
  localStorage.removeItem('admin_token')
}

function initFromStorage() {
  const token = localStorage.getItem('admin_token')
  if (token) {
    setToken(token)
  }
}

export default {
  state,
  setToken,
  logout,
  initFromStorage,
}
