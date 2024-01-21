<template>
    <div class="container-fluid d-flex align-items-center justify-content-center p-0">
      <div class="card w-100">
        <img src="\resources\images\depliant-vectoriel-temps-pour-voyager-espace-copie-blanche-ciel-avion_134830-1061.jpg" class="card-img-top" alt="Welcome Image">
        <div class="card-body text-center">
          <h2 class="card-title">Bienvenue dans notre site de réservation de vols</h2>
          <p class="card-text">Trouvez les meilleurs vols pour votre prochain voyage.</p>
          <router-link to="/rechercheVol" class="btn btn-primary">Commencer la reservation</router-link>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    mounted() {
      console.log('Component mounted.');
    }
  }
  </script>
  
  <style>
  .card {
    color: aquamarine;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  
  .card-img-top {
    height: 69vh;
    object-fit: cover;
  }
  
  .card-title {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 10px;
  }
  
  .card-text {
    font-size: 18px;
    margin-bottom: 20px;
  }
  
  .btn-primary {
    background-color: #007bff;
    color: #fff;
    border: none;
  }
  
  .btn-primary:hover {
    background-color: #0056b3;
  }
  </style>
  