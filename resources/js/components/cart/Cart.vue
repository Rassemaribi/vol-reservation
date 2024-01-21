<template>
  <div class="cart-container">
    <h2>Réservation</h2>
    <div v-if="cartItems.length === 0" class="cart-empty">
      <p>Pas De Réservation Disponible Pour Le Moment</p>
      <div class="start-shopping">
        <router-link to="/rechercheVol">Aller à la page des réservations</router-link>
      </div>
    </div>
    <div v-else>
      <div class="titles">
        <h3 class="flight-title">Détail Du Vol Rserver</h3>
        <h3 class="price">Prix</h3>
        <h3 class="quantity">Nombre de sièges</h3>
        <h3 class="total">Total</h3>
      </div>
      <div class="cart-items">
        <div v-for="(item, index) in cartItems" :key="index" class="cart-item">
          <div class="cart-flight">
            <h3>{{ item.flight.numero_vol }}</h3>
            <p>{{ item.flight.from }} - {{ item.flight.to }}</p>
            <p><strong>Compagnie aérienne :</strong>{{ item.flight.compagnieaerienneID }}</p>
            <p><strong>Date de départ :</strong> {{ item.flight.date_depart }}</p>
            <p><strong>Temps de départ :</strong> {{ item.flight.date_arrivee }}</p>
          </div>
          <div class="cart-flight-price">{{ item.flight.prix }} TND</div>
          <div class="cart-flight-quantity">
            <button @click="decrementQuantity(index)">
              <i class="pi pi-minus"></i>
            </button>
            <div class="count" v-if="item.qty !== undefined">
              <strong>{{ item.qty }}</strong>
            </div>
            <button @click="incrementQuantity(index)">
              <i class="pi pi-plus"></i>
            </button>
          </div>
          <div class="cart-flight-total-price">{{ item.flight.prix * item.qty }} TND</div>
        </div>
      </div>
      <div class="cart-summary">
        <Button class="btn btn-danger" @click="clearCart()">Supprimer Vol</button>
        <div class="cart-checkout">
          <div class="subtotal">
            <span>Sous-total</span>
            <span class="amount">{{ cartTotal }} TND</span>
          </div>
       
          <router-link :to="{ name: 'Payment' }">
            <button class="btn btn-info">Payement   <img src="https://namibind.com/wp-content/uploads/2019/06/visa-icon.png" width="45" height="35"/></button>
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>


<script setup>
import { ref, computed } from 'vue';
import { useStore } from 'vuex';

import 'primeicons/primeicons.css'
import Button from 'primevue/button';


const store = useStore();

const cartItems = computed(() => store.state.Volstore.cart);

const cartTotal = computed(() => {
  return cartItems.value.reduce((total, item) => total + item.flight.prix * item.qty, 0);
});

const removeFromCart = (index) => {
  store.commit('Volstore/removeFromCart', index);
};

const clearCart = () => {
  store.commit('Volstore/clearCart');
};

const incrementQuantity = (index) => {
  store.commit('Volstore/incrementQuantity', index);
};

const decrementQuantity = (index) => {
  store.commit('Volstore/decrementQuantity', { flight: cartItems.value[index].flight });
};

</script>

  
  <style scoped>
  .cart-container {
  background-color: rgba(95, 83, 83, 0.508); /* Fond gris transparent */
  padding: 2rem 4rem;
  border-radius: 10px; /* Coins arrondis pour le cadre */
  margin: 60px; /* Marge autour du conteneur */
  padding: 50px;
}
  .error-template {
padding: 40px 15px;
text-align: center;


}
.error-actions {
margin-top: 15px;
margin-bottom: 15px;
}
.error-actions .btn {
margin-right: 10px;
}
.bag-quantity {
display: flex;
align-items: center;
justify-content: center;
height: 25px;
width: 25px;
border-radius: 50%;
background: yellow;
font-size: 14px;
font-weight: 700;
color: black;
margin-left: 5px;
}
/* Home */
.home-container {
padding: 2rem 4rem;
}
.home-container h2 {
font-size: 40px;
font-weight: 400;
text-align: center;
}
.products {
display: flex;
justify-content: space-between;
flex-wrap: wrap;
margin-top: 2rem;
}
.product {
display: flex;
flex-direction: column;
justify-content: space-between;
margin: 1rem auto;
padding: 1rem;
border-radius: 15px;
width: 250px;
max-width: 100%;
height: 400px;
box-shadow: -5px -5px 10px rgba(255, 255, 255, 0.5),


2px 2px 5px rgba(94, 104, 121, 0.3);
}
.product h3 {
font-size: 25px;
font-weight: 400;
}
.product img {
width: 80%;
margin-top: 1rem;
margin-left: auto;
margin-right: auto;
}
.product .details {
display: flex;
justify-content: space-between;
align-items: center;
}
.product .details .price {
font-size: 20px;
font-weight: 700;
}
.product button {
width: 100%;
height: 40px;
border-radius: 5px;
margin-top: 2rem;
font-weight: 400;
letter-spacing: 1.15px;
background-color: #4b70e2;
color: #f9f9f9;
border: none;
outline: none;
cursor: pointer;
}
/* Cart */
.cart-container {
padding: 2rem 4rem;
}
.cart-container h2 {
font-weight: 400;
font-size: 30px;
text-align: center;
}
.cart-container .titles {
margin: 2rem 0 1rem 0;
}
.cart-container .titles h3 {
font-size: 14px;


font-weight: 400;
text-transform: uppercase;
}
.cart-item,
.cart-container .titles {
display: grid;
align-items: center;
grid-template-columns: 3fr 1fr 1fr 1fr;
column-gap: 0.5rem;
}
.cart-item {
border-top: 1px solid rgb(187, 187, 187);
padding: 1rem 0;
}
.cart-container .titles .product-title {
padding-left: 0.5rem;
}
.cart-container .titles .total {
padding-right: 0.5rem;
justify-self: right;
}
.cart-item .cart-product {
display: flex;
}
.cart-item .cart-product img {
width: 100px;
max-width: 100%;
margin-right: 1rem;
}
.cart-item .cart-product h3 {
font-weight: 400;
}
.cart-item .cart-product button {
border: none;
outline: none;
margin-top: 0.7rem;
cursor: pointer;
background: none;
color: gray;
}
.cart-item .cart-product button:hover {
color: black;
}
.cart-item .cart-product-quantity {
display: flex;
align-items: flex-start;
justify-content: center;
width: 130px;



max-width: 100%;
border: 0.5px solid rgb(177, 177, 177);
border-radius: 5px;
}
.cart-item .cart-product-quantity button {
border: none;
outline: none;
background: none;
padding: 0.7rem 1.5rem;
cursor: pointer;
}
.cart-item .cart-product-quantity .count {
padding: 0.7rem 0;
}
.cart-item .cart-product-total-price {
padding-right: 0.5rem;
justify-self: right;
font-weight: 700;
}
/* cart summary */
.cart-summary {
display: flex;
justify-content: space-between;
align-items: flex-start;
border-top: 1px solid rgb(187, 187, 187);
padding-top: 2rem;
}
.cart-summary .clear-btn {
width: 130px;
height: 40px;
border-radius: 5px;
font-weight: 400;
letter-spacing: 1.15px;
border: 0.5px solid rgb(177, 177, 177);
color: gray;
background: none;
outline: none;
cursor: pointer;
}
.cart-checkout {
width: 270px;
max-width: 100%;
}
.cart-checkout .subtotal {
display: flex;
justify-content: space-between;
font-size: 20px;
}



.cart-checkout .amount {
font-weight: 700;
}
.cart-checkout p {
font-size: 14px;
font-weight: 200;
margin: 0.5rem 0;
}
.cart-checkout button {
width: 100%;
height: 40px;
border-radius: 5px;
font-weight: 400;
letter-spacing: 1.15px;
background-color: #4b70e2;
color: #f9f9f9;
border: none;
outline: none;
cursor: pointer;
}
.continue-shopping,
.start-shopping {
margin-top: 1rem;
}
.continue-shopping a,
.start-shopping a {
color: gray;
text-decoration: none;
display: flex;
align-items: center;
}
.continue-shopping a span,
.start-shopping a span {
margin-left: 0.5rem;
}
.cart-empty {
font-size: 20px;
margin-top: 2rem;
color: rgb(84, 84, 84);
display: flex;
flex-direction: column;
align-items: center;
}
.drag{
margin-top: 70px;
}
.cart-empty {
  font-size: 20px;
  margin-top: 2rem;
  color: rgb(61, 52, 52);
  display: flex;
  flex-direction: column;
  align-items: center;
  background-color: rgba(239, 233, 233, 0.777); /* Couleur grise transparente */
  padding: 1rem; /* Ajout de la marge intérieure pour améliorer l'apparence */
  border-radius: 5px; /* Coins arrondis pour le cadre */
}
  </style>
  