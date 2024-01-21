<template>
  <div class="col-md-6 offset-md-3 border rounded p-4 mt-2 shadow">
    <form @submit.prevent="updateVol">
      <div class="mb-3">
        <label for="numero_vol" class="form-label">Numéro Vol</label>
        <input type="text" class="form-control" id="numero_vol" v-model="editedVol.numero_vol">
      </div>
      <div class="mb-3">
        <label for="from" class="form-label">De</label>
        <input type="text" class="form-control" id="from" v-model="editedVol.from">
      </div>

      <div class="mb-3">
        <label for="to" class="form-label">À</label>
        <input type="text" class="form-control" id="to" v-model="editedVol.to">
      </div>

      <div class="mb-3">
        <label for="date_depart" class="form-label">Date Départ</label>
        <input type="date" class="form-control" id="date_depart" v-model="editedVol.date_depart">
      </div>
      <div class="mb-3">
        <label for="date_arrivee" class="form-label">Temps Départ</label>
        <input type="time" class="form-control" id="date_arrivee" v-model="editedVol.date_arrivee">
      </div>
      <div class="mb-3">
        <label for="capacite" class="form-label">Capacité</label>
        <input type="text" class="form-control" id="capacite" v-model="editedVol.capacite">
      </div>
      <div class="mb-3">
        <label for="prix" class="form-label">Prix</label>
        <input type="text" class="form-control" id="prix" v-model="editedVol.prix">
      </div>
      <div class="mb-3">
        <label for="compagnie_aerienne" class="form-label">Compagnie Aérienne</label>
        <select class="form-control" v-model="editedVol.compagnie_aerienne" @change="onCompagnieChange">
          <option v-for="compagnie in compagnies" :key="compagnie.id" :value="compagnie.id">
            {{ compagnie.nom }}
          </option>
        </select>
      </div>

      <!-- Boutons -->
      <div class="d-flex justify-content-end mt-4">
        <!-- Bouton Mettre à jour -->
        <button type="submit" class="btn btn-primary">Mettre à jour</button>

        <!-- Bouton Annuler -->
        <router-link to="/vol" class="btn btn-danger mx-2">Annuler</router-link>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useRouter, useRoute } from 'vue-router';

const editedVol = ref({
  numero_vol: '',
  date_depart: '',
  date_arrivee: '',
  capacite: '',
  prix: '',
  compagnie_aerienne: '',
  from: '',
  to: ''
});

const router = useRouter();
const route = useRoute();
const compagnies = ref([]);

const getCompagnies = async () => {
  try {
    const response = await axios.get(`/api/compagnies-aeriennes`);
    compagnies.value = response.data;
  } catch (error) {
    console.error('Erreur lors de la récupération des compagnies aériennes', error);
  }
};

const getVol = async () => {
  try {
    const response = await axios.get(`/api/vols/${route.params.id}`);
    editedVol.value = response.data;
  } catch (error) {
    console.error('Erreur lors de la récupération du vol', error);
  }
};

const onCompagnieChange = () => {
  console.log('Compagnie sélectionnée :', editedVol.compagnie_aerienne);
};

const updateVol = async () => {
  try {
    const response = await axios.put(`/api/vols/${route.params.id}`, editedVol.value);
    console.log('Réponse de la mise à jour du vol :', response.data);
    router.push({ name: 'ViewVol' });
  } catch (error) {
    console.error('Erreur lors de la mise à jour du vol', error);
  }
};

onMounted(() => {
  onCompagnieChange();
  getCompagnies();
  getVol();
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

/* Style du bouton de mise à jour */
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
