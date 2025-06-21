<!-- components/Header.vue -->
<template>
  <header class="flex justify-between items-center p-4 bg-blue-600 text-white">
    <h1 class="text-2xl font-bold">Мой сайт</h1>
    <button
      @click="login"
      class="bg-white text-blue-600 font-semibold py-2 px-4 rounded hover:bg-blue-500 hover:text-white transition"
    >
      Войти
    </button>
  </header>
</template>

<script>
export default {
  name: 'Header',
  methods: {
    login() {
      alert('Нажата кнопка Войти');
      // Тут можно добавить логику перехода на страницу логина
      // например: this.$router.push('/login')
    }
  }
}
</script>