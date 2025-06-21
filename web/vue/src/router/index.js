// router/index.js или router.js
import { createRouter, createWebHistory } from 'vue-router'
import MainLayout from '@/layouts/MainLayout.vue'

import ReviewList from '../components/ReviewList.vue'

const routes = [
  {
    path: '/',
    component: MainLayout,
    children: [
      { path: '', component: ReviewList },
    ]
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router