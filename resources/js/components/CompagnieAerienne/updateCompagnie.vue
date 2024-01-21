<template>
  <br>
  <br>
  <div class="col-md-6 offset-md-3 border rounded p-4 mt-2 shadow">
    <form @submit.prevent="updateCompagnieAerienne">
      <div class="mb-3">
        <label for="nomCompagnie" class="form-label">Nom compagnie aérienne</label>
        <input type="text" class="form-control" id="nomCompagnie" v-model="compagnieAerienne.nom">
      </div>
      <div class="mb-3">
        <label for="contry" class="form-label">Pays</label>
        <input type="text" class="form-control" id="contry" v-model="compagnieAerienne.contry">
      </div>
      <div class="mb-3">
        <label for="logo" class="form-label">Logo</label>
        <input type="file" class="form-control" id="logo" @change="handleLogoChange" />
      </div>

      

      <!-- Boutons -->
      <div class="d-flex justify-content-end mt-4">
        <!-- Bouton Mettre à jour -->
        <button type="submit" class="btn btn-primary">Mettre à jour</button>

        <!-- Bouton Annuler -->
        <router-link to="/compagnie" class="btn btn-danger mx-2">Annuler</router-link>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useRouter, useRoute } from 'vue-router';

const compagnieAerienne = ref({
  nom: '',
  country: '',
  logo: null,
});

const router = useRouter();
const route = useRoute();

const getCompagnieAerienne = async () => {
  try {
    const response = await axios.get(`http://localhost:8000/api/compagnies-aeriennes/${route.params.id}`);
    compagnieAerienne.value = response.data;
  } catch (error) {
    console.error('Erreur lors de la récupération de la compagnie aérienne', error);
  }
};

const updateCompagnieAerienne = async () => {
  try {
    const formData = new FormData();
    formData.append('nom', compagnieAerienne.value.nom);
    formData.append('country', compagnieAerienne.value.country);
    formData.append('logo', compagnieAerienne.logo);

    const response = await axios.put(`http://localhost:8000/api/compagnies-aeriennes/${route.params.id}`, formData, {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    });

    console.log('Réponse de la mise à jour :', response.data);
    router.push({ name: 'ViewCompagnie' });
  } catch (error) {
    console.error('Erreur lors de la mise à jour de la compagnie aérienne', error);
  }
};

const handleLogoChange = (event) => {
  const file = event.target.files[0];
  if (file) {
    compagnieAerienne.logo = file;
  }
};

onMounted(() => {
  getCompagnieAerienne();
});
</script>

<style lang="scss" scoped>
/* Ajoutez vos styles ici */
/* Style général du formulaire */
form {
  padding: 20px;
}

/* Style des étiquettes */
.form-label {
  font-weight: bold;
}

/* Style des champs de saisie */
.form-control {
  margin-bottom: 10px;
}

/* Style du bouton Mettre à jour */
.btn-primary {
  background-color: #4CAF50;
  border: none;
}

/* Style du bouton Annuler */
.btn-danger {
  background-color: #f44336;
  border: none;
  color: white;
}

/* Style des boutons dans la barre d'action */
.d-flex {
  gap: 10px;
}
</style>
