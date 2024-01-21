<template>
  <div>
    
        
        <Button label=" Nouveau Vol" @click="showAddVolDialog = true"  class="btn btn-outline-success" outlined />
   
    <!-- Ajout du vol -->
    <form @submit="addVol">
      <div class="card flex justify-content-center">
        <Dialog v-model:visible="showAddVolDialog" style="width: 70%;">
          <div class="form-group">
            <label for="numero_vol">Numéro Vol</label>
            <InputText class="p-inputtext form-control p-invalid" id="numero_vol" v-model="vol.numero_vol" required />
          </div>
          <div class="form-group">
            <label for="from">De</label>
            <InputText class="p-inputtext form-control p-invalid" id="from" v-model="vol.from" required />
          </div>

          <div class="form-group">
            <label for="to">À</label>
            <InputText class="p-inputtext form-control p-invalid" id="to" v-model="vol.to" required />
          </div>

          <div class="form-group">
            <label for="date_depart">Date Départ</label>
            <br>
            <input type="date" class="form-control" v-model="vol.date_depart" id="date_depart" style="width: 150px;" required />
          </div>
          <div class="form-group">
            <label for="heure_arrivee">Temps Départ</label>
            <br>
            <input type="time" class="form-control" v-model="vol.date_arrivee" id="heure_arrivee" style="width: 100px;" required />
          </div>
          <div class="form-group">
            <label for="capacite">Capacité</label>
            <InputText class="p-inputtext form-control p-invalid" type="text" id="capacite" v-model="vol.capacite" required />
          </div>
          <div class="form-group">
            <label for="prix">Prix</label>
            <InputText class="p-inputtext form-control p-invalid" type="text" id="prix" v-model="vol.prix" required />
          </div>
          <div class="form-group">
            <label for="compagnie_aerienne">Compagnie Aérienne</label>
            <select class="p-dropdown form-control p-invalid" v-model="vol.compagnieaerienneID" required>
              <!-- Options de compagnies aériennes -->
              <option v-for="compagnie in compagnies" :key="compagnie.nom" :value="compagnie.nom">{{ compagnie.nom }}</option>
            </select>
          </div>
<br>
          <button type="button" class="p-button btn btn-success" @click="addVol" >Enregistrer</button>&nbsp;

          <button type="button" class="p-button btn btn-secondary" @click="closeAddVolDialog">Annuler</button>
        </Dialog>
      </div>
    </form>
  </div>
</template>

<script setup>
import api from '../config/app.js';
import Dialog from 'primevue/dialog';
import { ref, onMounted } from 'vue';
import Calendar from 'primevue/calendar';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';

const showAddVolDialog = ref(false);
const vol = ref({
  numero_vol: "",
  date_depart: "",
  date_arrivee: "",
  capacite: "",
  prix: "",
  compagnieaerienneID: "", // Assurez-vous que le nom correspond à votre modèle de données
  from: "",
  to: "",
});
const compagnies = ref([]);

const getCompagnies = async () => {
  try {
    const response = await api.get("/api/compagnies-aeriennes");
    compagnies.value = response.data;
  } catch (error) {
    console.log(error);
  }
};

async function addVol() {
  try {
    await api.post("/api/vols", vol.value);
    showAddVolDialog.value = false; // Utilisez showAddVolDialog au lieu de visible
    emits('vol-added');
    // window.location.reload();
  } catch (error) {
    // Gérer l'erreur ici, si nécessaire
    console.error("Erreur lors de l'ajout du vol :", error);
  }
}

const closeAddVolDialog = () => {
  showAddVolDialog.value = false;
  emits('vol-added');
};
const refreshVols = () => {
  getVols(); 
};

onMounted(() => {
  getCompagnies();
});

</script>

<style lang="css" scoped>
/* Styles spécifiques à ce composant */
</style>
