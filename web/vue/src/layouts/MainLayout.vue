<script>    
import Header from '@/components/Header.vue'

export default {
  components: {
    Header
  }
}

</script>

<template>
  <div>
    <Header></Header>
    <main style="padding: 1rem;">
      <!-- сюда Vue Router подставит текущую страницу -->
      <router-view />
    </main>
  </div>
</template>