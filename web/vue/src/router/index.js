import { createRouter, createWebHistory } from 'vue-router'

import MainLayout from '@/layouts/MainLayout.vue'

import HomePage from '../pages/HomePage.vue'
import AdminPage from '../pages/AdminPage.vue'

const routes = [
  {
    path: '/',
    component: MainLayout,
    children: [
      { path: '', component: HomePage },
      { path: '/admin', component: AdminPage },
    ]
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router