<template>
  <div class="app">
    <Menu />
    <div class="content">
      <router-view></router-view>
    </div>
  </div>
</template>

<script setup>
import Menu from './components/Menu.vue';
</script>

<style scoped>
.app {
  background-image: url('https://img.freepik.com/photos-premium/bungalow-eau-maldives-paysage-eau-ocean_87394-23688.jpg?w=900');
  background-size: cover;
  background-position: center;
  min-height: 100vh; /* Assurez-vous que le fond d'écran couvre toute la hauteur de la vue */
  color: white; /* Assurez-vous que le texte est lisible sur l'image de fond */
}

.content {
  margin-top: 0px;
}
</style>
