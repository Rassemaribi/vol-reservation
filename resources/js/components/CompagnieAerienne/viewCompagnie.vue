<template>
  <div>
    <div class="py-6">
      <br />
      <div class="container">
        <DataTable v-model:filters="filters" :value="compagniesAeriennes" paginator :rows="5" dataKey="id" filterDisplay="row" :loading="loading"
          :globalFilterFields="['nom', 'contry']" sortField="nom" :sortOrder="1" tableStyle="min-width: 50rem">
          <template #header>
            <div class="flex justify-content-end">
              <span class="p-input-icon-left">
           
                <router-link :to="{ name: 'AddCompagnie' }" class="btn btn-outline-success">Nouvelle Compagnie Aérienne</router-link>
              </span>
            </div>
          </template>
          <template #empty> Aucune compagnie aérienne trouvée. </template>
          <template #loading> Chargement des données des compagnies aériennes. Veuillez patienter. </template>
          <Column field="nom" header="Nom compagnie aérienne" sortable style="min-width: 12rem">
            <template #body="{ data }">
              {{ data.nom }}
            </template>
            <template #filter="{ filterModel, filterCallback }">
              <InputText v-model="filterModel.value" type="text" @input="filterCallback()" class="p-column-filter" placeholder="Recherche par nom" />
            </template>
          </Column>
          <Column field="contry" header="Pays" sortable style="min-width: 12rem">
            <template #body="{ data }">
              {{ data.contry }}
            </template>
            <template #filter="{ filterModel, filterCallback }">
              <InputText v-model="filterModel.value" type="text" @input="filterCallback()" class="p-column-filter" placeholder="Recherche par pays" />
            </template>
          </Column>
          <Column field="logo" header="Logo" style="min-width: 12rem">
  <template #body="{ data }">
    <img :src="`/uploads/${data.logo}`" alt="Logo" width="120" height="60" />
  </template>
</Column>



          <Column header="Modifier" style="min-width: 12rem">
            <template #body="{ data }">
              <router-link :to="{ name: 'UpdateCompagnie', params: { id: data.id } }" class="btn btn-success mx-2">Modifier</router-link>
            </template>
          </Column>
          <Column header="Supprimer" style="min-width: 12rem">
            <template #body="{ data }">
              <button class="btn btn-danger mx-2" @click="deleteCompagnieAerienne(data.id)">Supprimer</button>
            </template>
          </Column>
        </DataTable>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { FilterMatchMode } from 'primevue/api';
import axios from 'axios';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import InputText from 'primevue/inputtext';

const compagniesAeriennes = ref([]);
const filters = ref({
  global: { value: null, matchMode: FilterMatchMode.CONTAINS },
  nom: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
  contry: { value: null, matchMode: FilterMatchMode.STARTS_WITH }
});
const loading = ref(true);

const getCompagniesAeriennes = async () => {
  try {
    const response = await axios.get('http://localhost:8000/api/compagnies-aeriennes');
    compagniesAeriennes.value = response.data;
    loading.value = false;
  } catch (error) {
    console.log(error);
  }
};

const deleteCompagnieAerienne = async (id) => {
  try {
    await axios.delete(`http://localhost:8000/api/compagnies-aeriennes/${id}`);
    getCompagniesAeriennes();
  } catch (error) {
    console.log(error);
  }
};

onMounted(() => {
  getCompagniesAeriennes();
});
</script>

<style lang="scss" scoped>
/* Vos styles ici */
</style>
