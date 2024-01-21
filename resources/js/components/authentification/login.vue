<template>
    <div class="container">
      <div class="login-container">
        <div class="background-image top"></div>
        <div class="form">
          <div class="control">
            <h1>Connexion</h1>
          </div>
          <img src="\resources\images\24104f7f-fab4-4f09-bdb5-687ad2b2e652.png" width="450" height="250"/>
          <div class="control block-cube block-input">
            <InputText
              :name="'email'" 
              type="text"
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
          <Button label="Login" class="btnn" severity="info" rounded @click="handleLogin" />
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
  
  const handleLogin = async () => {
    try {
      const response = await axios.post('http://localhost:8000/api/login/', user);
      router.push("/");
      localStorage.setItem('user', response.data.user.name);
      localStorage.setItem('token', response.data.token);
    } catch (error) {
      console.error(error);
      alert('Erreur lors de la connexion. Veuillez réessayer.');
    }
  };
  </script>
  
  <style scoped>
  .container {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 90vh;
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
  
 
  /* Ajustez la largeur des champs d'e-mail et de mot de passe ici */
  .block-input {
    width: 100%;
  }
  
  /* Augmentez la largeur si vous le souhaitez */
  .block-cube input {
    width: 100%;
  }
  h1{
    color: lightskyblue;
  }
  .btnn{
border-radius: 15%;
width: 150px;
  }
  </style>
  