<template>
  <div class="payment-container">
    <form @submit.prevent="handleSubmit">
      <div class="card" style="width: 50rem;">
        <div class="card-body">
          <h5 class="card-title">Montant à payer : {{ amount }} TND</h5>
          <br />
          <div class="card-text">
            <div class="form-group">
              <input type="email" class="form-control" placeholder="email" v-model="email" />
            </div>
            <br />
          </div>
          <div id="card-element"></div>
          <br />
          <button type="submit" class="btn btn-success">Procéder au paiement</button>
        </div>
      </div>
    </form>
  </div>
  </template>
  
  <script setup>
  import { onMounted, ref } from 'vue';
  import { loadStripe } from '@stripe/stripe-js';
  import store from '../../store';
  import api from '../config/app.js';
  import { useRouter } from 'vue-router';
  const router = useRouter();
  
  const stripePromise = loadStripe('pk_test_51OM7SRJNVPsJIGT4QVwLFVGhIlpP1namzBF506XCOKhmEvhEJNpsWRsRJI83ahVaGX8IlVHdioZttlQUwVKKIZYL00hoHl1ojh');
  const stripe = ref(null);
  const cardElement = ref(null);
  const amount = ref(0);
  const email = ref("");
  
  onMounted(async () => {
    stripe.value = await stripePromise;
    const elements = stripe.value.elements();
    cardElement.value = elements.create('card');
    cardElement.value.mount('#card-element');
    amount.value = store.state.Volstore.cartTotal; // Assurez-vous que le nom du store est correct
  });
  
  const handleSubmit = async () => {
  const { token, error } = await stripe.value.createToken(cardElement.value);
  if (error) {
    console.error(error);
  } else {
    // Envoyer le token au serveur pour traiter le paiement
    const response = await api.post('/api/createpayment', {
      token: token.id,
      amount: amount.value * 100, // Convertir le montant en cents
      email: email.value
    });
    if (response.data.message) {
      console.log(response.data.message);
      // Le paiement est réussi
alert(response.data.message);
    

      // Vider le panier
      store.commit('Volstore/clearCart');

      // Redirection
      router.push('/rechercheVol');
        // Mettre à jour la capacité des vols dans le magasin (store)
      const flightsToUpdate = store.state.Volstore.cart.map(item => item.flight);
      store.commit('Volstore/updateFlightCapacity', flightsToUpdate);
    } else {
      console.error(response.data.error);
    }
  }
};
</script>
  <style scoped>
  .payment-container {
    display: flex;
    margin-top: 100px;
    padding: 10px;
    justify-content: center;
    align-items: center;
    
  }
  </style>
  