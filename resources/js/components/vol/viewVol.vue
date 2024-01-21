<template>
<div>
 <br>
 
    <div class="card">
      <!-- Tableau des vols -->
      <DataTable v-model:filters="filters" v-model:selection="selectedVol" :value="vols"
                 stateStorage="session" stateKey="dt-state-demo-session" paginator :rows="5" filterDisplay="menu"
                 selectionMode="single" dataKey="id" stripedRows showGridlines :loading="isLoading">
        <template #header>
          <div class="p-d-flex p-jc-between p-ai-center">
            <div class="p-input-icon-left">
              <i class="pi pi-search" />
              <InputText v-model="filters['global'].value" placeholder="Recherche globale" />
            </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div class="p-input-icon-right">
              <AddVol :visible="showAddVolDialog" @close="closeAddVolDialog" />
            </div>
          </div>
        </template>
        <Column header="Numéro Vol" field="numero_vol" sortable></Column>
        <Column header="Départ" field="from" sortable></Column>
        <Column header="Destination" field="to" sortable></Column>
        <Column header="Date Départ" field="date_depart" sortable></Column>
        <Column header="Temps Départ" field="date_arrivee" sortable></Column>
        <Column header="Prix" field="prix" sortable></Column>
        <Column header="Capacité" field="capacite" sortable></Column>
        <Column header="Compagnie Aérienne" field="compagnieaerienneID" sortable></Column>
        <Column header="Actions" style="min-width: 12rem">
          <template #body="val">
            <div class="d-flex">
              <router-link :to="{ name: 'EditVol', params: { id: val.data.id } }" class="btn btn-warning mx-2">
                Modifier
              </router-link>
              <button type="button" class="btn btn-danger mx-2" @click="deleteVol(val.data.id)">
                SUPPRIMER
              </button>
           
            </div>
          </template>
        </Column>
      </DataTable>
      <button class="btn btn-success" @click="refreshTable" :disabled="isLoading">Actualiser</button>
      <i v-if="isLoading" class="pi pi-spin pi-spinner" style="font-size: 2rem"></i>
    </div>
  </div>
</template>

<script setup>
import api from '../config/app.js';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import AddVol from './addVol.vue';
import { ref, onMounted } from 'vue';
import InputText from 'primevue/inputtext'; // Assurez-vous d'importer le composant InputText si ce n'est pas déjà fait

const vols = ref([]);
const isLoading = ref(true);
const showAddVolDialog = ref(false);
const selectedVol = ref();
const filters = ref({
  global: { value: null, matchMode: 'contains' },
  numero_vol: { value: null, matchMode: 'startsWith' },
  from: { value: null, matchMode: 'startsWith' },
  to: { value: null, matchMode: 'startsWith' },
  date_depart: { value: null, matchMode: 'startsWith' },
  date_arrivee: { value: null, matchMode: 'startsWith' },
  prix: { value: null, matchMode: 'startsWith' },
  capacite: { value: null, matchMode: 'startsWith' },
  compagnieaerienneID: { value: null, matchMode: 'startsWith' },
});

const getVols = async () => {
  try {
    const response = await api.get('/api/vols');
    vols.value = response.data;
    isLoading.value = false;
  } catch (error) {
    console.log(error);
  }
};

const refreshTable = async () => {
  isLoading.value = true; // Activer l'indicateur de chargement
  await getVols(); // Attendre le chargement des données
  isLoading.value = false; // Désactiver l'indicateur de chargement
};

onMounted(() => {
  getVols();
});

async function deleteVol(volId) {
  try {
    await api.delete(`/api/vols/${volId}`);
    // Rafraîchir la liste des vols après la suppression
    getVols();
  } catch (error) {
    console.error("Erreur lors de la suppression du vol :", error);
  }
}
</script>

<style lang="css" scoped>
 .p-d-flex {
    justify-content: space-between;
  }
 
</style>
