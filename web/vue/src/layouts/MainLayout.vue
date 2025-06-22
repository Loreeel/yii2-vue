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
      <router-view />
    </main>
  </div>
</template>