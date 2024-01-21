<template>
    <div class="container">
      <div class="login-container">
        <div class="background-image top"></div>
        <div class="form">
          <div class="control">
            <h1>Inscription</h1>
          </div>
          <img src="\resources\images\regis.png" width="450" height="250"/>
          <div class="control block-cube block-input">
            <InputText
              :name="'name'"
              type="text"
              placeholder="Nom"
              v-model="user.name"
              required
              autofocus
              autocomplete="off"
            />
          </div>
          <div class="control block-cube block-input">
            <InputText
              :name="'email'"
              type="email"
              placeholder="Adresse E-mail"
              v-model="user.email"
              required
              autofocus
              autocomplete="off"
            />
          </div>
          <div class="control block-cube block-input">
            <InputText
              :name="'password'"
              type="password"
              placeholder="Mot de passe"
              v-model="user.password"
              required
              autocomplete="off"
            />
          </div>
          <div class="control block-cube block-input">
            <InputText
              :name="'password_confirmation'"
              type="password"
              placeholder="Confirmation du mot de passe"
              v-model="user.password_confirmation"
              required
              autocomplete="off"
            />
          </div>
          <Button label="Inscription" class="btnn" severity="info" rounded @click="handleSubmit" />
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import axios from 'axios';
  import { useRouter } from 'vue-router';
  import Button from 'primevue/button';
  import InputText from 'primevue/inputtext';
  
  const router = useRouter();
  let user = {};
  
  const handleSubmit = async () => {
    try {
      const response = await axios.post('http://localhost:8000/api/register/', user);
      console.log(response);
      router.replace({ name: 'login' });
    } catch (error) {
      console.error(error);
      alert('Erreur lors de l\'inscription. Veuillez réessayer.');
    }
  };
  </script>
  
  <style scoped>
  .container {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
  }
  
  .login-container {
    position: relative;
    width: 500px;
    background: rgba(255, 255, 255, 0.7);
    padding: 15px;
    border-radius: 25px;
    box-shadow: 0 0 10px rgba(101, 21, 21, 0.2);
  }
  
  .form {
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  
  .control {
    margin: 0 0 20px;
  }
  
  .block-cube {
    position: relative;
  }
  
  .block-cube .bg-top,
  .block-cube .bg-right,
  .block-cube .bg {
    background: rgba(255, 255, 255, 0.5);
  }
  
  .block-input {
    width: 100%;
  }
  
  .block-cube input {
    width: 100%;
  }
  
  .btnn {
    border-radius: 15%;
    width: 150px;
  }
  
  
  
  h1 {
    color: lightskyblue;
  }
  </style>
  