<template>
  <div class="col-md-6 offset-md-3 border rounded p-4 mt-2 shadow">
    <form @submit.prevent="addCompagnieAerienne">
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
        <input type="file" class="form-control" id="logo" @change="onFileChange">
      </div>

      <div v-if="errors.length > 0" class="alert alert-danger mt-2">
        <ul>
          <li v-for="error in errors" :key="error">{{ error }}</li>
        </ul>
      </div>

      <button type="submit" class="btn btn-outline-primary">Enregistrer</button>
      <router-link to="/compagnie" class="btn btn-outline-danger mx-2">Annuler</router-link>
    </form>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import axios from "axios";

const router = useRouter();
const compagnieAerienne = ref({
  nom: "",
  contry: "",
  logo: null,
});

const errors = ref([]);

const onFileChange = (event) => {
  compagnieAerienne.value.logo = event.target.files[0];
};

const addCompagnieAerienne = async () => {
    try {
        const formData = new FormData();
        formData.append("nom", compagnieAerienne.value.nom);
        formData.append("contry", compagnieAerienne.value.contry);
        formData.append("logo", compagnieAerienne.value.logo);

        await axios.post("http://localhost:8000/api/compagnies-aeriennes", formData);

        router.push({ name: "ViewCompagnie" });
    } catch (error) {
        if (error.response && error.response.data && error.response.data.errors) {
            errors.value = Object.values(error.response.data.errors).flat();
        } else {
            console.log(error);
        }
    }
};

</script>

<style scoped>
/* Vos styles ici */
</style>
