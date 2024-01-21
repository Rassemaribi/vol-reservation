<template>
  <div>
    <!-- Champs de recherche -->
    <div class="search-form">
      <span class="p-float-label flex-fill">
        <InputText v-model="search.from" id="search-from" />
        <label for="search-from">Départ</label>
      </span>

      <span class="p-float-label flex-fill">
        <InputText v-model="search.to" id="search-to" />
        <label for="search-to">Destination</label>
      </span>

      <span class="p-float-label flex-fill">
        <Calendar v-model="search.date_depart" showIcon iconDisplay="input" id="search-date-depart" />
        <label for="search-date-depart">Date de Départ</label>
      </span>

      <button @click="searchFlights" class="btn btn-primary">Rechercher Vol</button>
    </div>


    
    <!-- Tableau des vols -->
    <div class="card">
      <DataTable v-if="searchResult.length > 0" :value="searchResult" :key="searchResult" stripedRows paginator showGridlines :rows="5" dataKey="id" :loading="isLoading">
        <Column header="id" field="id"></Column>
        <Column header="Numéro Vol" field="numero_vol"></Column>
        <Column header="Départ" field="from"></Column>
        <Column header="Destination" field="to"></Column>
        <Column header="Date Départ" field="date_depart"></Column>
        <Column header="Temps Départ" field="date_arrivee"></Column>
        <Column header="Prix" field="prix"></Column>
        <Column header="Capacité" field="capacite"></Column>
        <Column header="Compagnie Aérienne" field="compagnieaerienneID"></Column>
        <Column header="Actions" style="min-width: 12rem">
          <template #body="val">
            <div class="d-flex">
              <button @click="addToCart(val.data)" class="btn btn-primary" v-if="val.data && val.data.id">Reserver vol </button>
            </div>
          </template>
        </Column>
      </DataTable>

      <!-- Afficher un message d'erreur après une recherche infructueuse -->
      <div v-if="searchPerformed">
        <Message severity="error">
          <p>Merci de visiter notre site web.</p>
          <p>Désolé ! Votre destination n'a pas été trouvée.</p>
        </Message>
      </div>
    </div>
  </div>
  <br>
  <!-- Cartes stylisées -->
  <div class="card-container">
  <div class="d-flex justify-content-around">
    <div class="card">
      <!-- Première carte -->
      <Card style="width: 20em">
        <template #header>
          <img alt="user header" src="https://img.freepik.com/photos-gratuite/paysage-urbain-paris-sous-lumiere-du-soleil-ciel-bleu-fra_181624-50289.jpg?size=626&ext=jpg&uid=R71655946&ga=GA1.1.60220694.1688461920&semt=sph" width="321" />
        </template>
        <template #title>Paris</template>
        <template #subtitle>France</template>
        <template #content>
          <p class="m-0">
            Paris est la capitale de la France. La Ville Lumière est réputée pour sa riche histoire, ses monuments emblématiques tels que la Tour Eiffel et le Louvre, et sa cuisine délicieuse.
          </p>
        </template>
        
      </Card>
    </div>

    <div class="card">
      <!-- Deuxième carte -->
      <Card style="width: 20em">
        <template #header>
          <img alt="user header" src="https://img.freepik.com/photos-gratuite/paysage-brouillard-matinal-montagnes-montgolfieres-au-lever-du-soleil_335224-794.jpg?size=626&ext=jpg&uid=R71655946&ga=GA1.1.60220694.1688461920&semt=sph" width="321" />
        </template>
        <template #title>Turquie</template>
        <template #subtitle>Cappadoce</template>
        <template #content>
          <p class="m-0">
            La Turquie est un pays magnifique avec une histoire riche. La Cappadoce, en particulier, est célèbre pour ses formations rocheuses uniques, ses vallées pittoresques et ses montgolfières colorées.
          </p>
        </template>
      
      </Card>
    </div>

    <div class="card">
      <!-- Troisième carte -->
      <Card style="width: 20em">
        <template #header>
          <img alt="user header" src="https://img.freepik.com/photos-gratuite/belle-fille-debout-bateau-recherche-montagnes-dans-barrage-ratchaprapha-au-parc-national-khao-sok-province-surat-thani-thailande_335224-849.jpg?size=626&ext=jpg&uid=R71655946&ga=GA1.2.60220694.1688461920&semt=sph" width="321" />
        </template>
        <template #title>Bali</template>
        <template #subtitle>Indonésie</template>
        <template #content>
          <p class="m-0">
            Bali est une île paradisiaque en Indonésie, réputée pour ses plages magnifiques, ses temples culturels, sa vie marine diversifiée et ses rizières verdoyantes.
          </p>
        </template>
     
      </Card>
    </div>
  </div>
</div>
</template>

<script setup>
import api from '../config/app.js';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import InputText from 'primevue/inputtext';
import Calendar from 'primevue/calendar';
import Message from 'primevue/message';
import { ref, onMounted } from 'vue';
import store from '../../store';

import Card from 'primevue/card';
import Button from 'primevue/button';

const vols = ref([]);
const isLoading = ref(true);
const searchResult = ref([]);
const search = ref({
  from: '',
  to: '',
  date_depart: ''
});
const addToCart = (flightData) => {
  if (flightData && flightData.prix && flightData.id) {
    store.commit("Volstore/addCart", { flight: flightData, qty: 1 });
  } else {
    console.error("Le vol que vous essayez d'ajouter au panier n'a pas toutes les propriétés nécessaires définies.");
  }
};

const getVols = async () => {
  try {
    const response = await api.get("/api/vols");
    vols.value = response.data;
    isLoading.value = false;
  } catch (error) {
    console.error(error);
  }
};

const searchFlights = () => {
  searchResult.value = vols.value.filter(flight => {
    const fromMatch = flight.from.toLowerCase().includes(search.value.from.toLowerCase());
    const toMatch = flight.to.toLowerCase().includes(search.value.to.toLowerCase());
    return fromMatch && toMatch;
  });
  searchPerformed.value = true;
};

const redirectTo = (url) => {
  window.open(url, '_blank');
};

const searchPerformed = ref(false);

onMounted(() => {
  getVols();
});
</script>

<style lang="css" scoped>
/* Styles spécifiques à ce composant */

.search-form {
  display: flex; /* Affiche les éléments en ligne */
  background-color: rgba(255, 255, 255, 0.664); 
  padding: 25px; 
  margin: 20px ; 
  border-radius: 15px; /* Ajout de coins arrondis pour un aspect visuel */
  align-items: center; /* Centre les éléments verticalement dans le conteneur */
}

.search-form label {
  margin-right: 2px;
}

.search-form span {
  margin-right: 40px; /* Espace entre chaque champ */
}
.error-message {
  background-color: rgba(255, 255, 255, 0.8);
  padding: 10px;
  margin-top: 20px;
}
.card-container {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    margin-top: 1px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
</style>
