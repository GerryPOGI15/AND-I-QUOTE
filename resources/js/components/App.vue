<template>
    <div id="app">
      <nav class="bg-blue-600 text-white p-4">
        <div class="container mx-auto">
          <router-link to="/" class="text-xl font-bold">Quotation System</router-link>
        </div>
      </nav>
      <main class="container mx-auto p-4">
        <router-view></router-view>
      </main>
    </div>
  </template>
  
  <script>
  export default {
    name: 'App'
  }
  </script>