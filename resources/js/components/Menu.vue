<template>
  <div>
    <nav class="navbar navbar-expand-lg bg-white" data-bs-theme="dark">
      <div class="container-fluid">
        <img src="https://img.icons8.com/?size=80&id=KymPtnISGar8&format=png" width="65" height="65"/>
        <router-link class="navbar-brand" to="/" style="color: rgb(8, 2, 2);">RESERVATION & VOYAGE</router-link>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor02">
          <ul class="navbar-nav me-auto">
              <li class="nav-item">
              <router-link to="/compagnie" class="nav-link" style="color: rgb(9, 2, 2);">Compagnie Aérienne</router-link>
            </li>&nbsp;&nbsp;
            <li class="nav-item">
              <router-link to="/vol" class="nav-link" style="color: rgb(8, 1, 1);">Vols</router-link>
            </li>&nbsp;&nbsp;
            <li class="nav-item">
              <router-link to="/rechercheVol" class="nav-link" style="color: rgb(12, 5, 5);">Reserver un Vol</router-link>
            </li>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <li class="nav-item">

<router-link class="nav-link active" to="/login">Login
</router-link>
</li>
<li class="nav-item">
<router-link class="nav-link active" to="/register">Register
</router-link>
</li>
<li class="nav-item">
 <button type="button" class="btn btn-outline-dark" @click="logout">Logout</button>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</li>
          </ul>
          <li class="nav-item">
            <router-link class="nav-link active" to="/cart"><p >Billet Reserver</p></router-link>
            
</li>
        
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item me-3">
              <!-- Utilisez la balise router-link pour rendre l'icône d'avion un lien vers '/cart' -->
             
              <router-link to="/cart" class="nav-link">
          
                <div v-if="cartCount > 0" class="badge">{{ cartCount }} </div>
                <div class="nav-link position-relative"
                               :class="$route.name == 'Cart' ? 'active' : ''"
                               aria-current="page"
                               :to="{ name: 'Cart' }">

                    <i class="fa-solid fa-cart-shopping fa-lg" style="color: #ffffff;"></i>

                    <span v-if="$store.state.Volstore.cart.length > 0"
                          class="position-absolute top-0 end-0 translate-middle badge rounded-pill bg-danger d-inline">

                      {{ $store.state.Volstore.cart.length }}
                    </span>
                
                  </div>
              </router-link>
             
             
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</template>

<script setup>
import axios from 'axios';
import { useRouter } from 'vue-router';
const router = useRouter();


const logout=async()=> {
let token=""

token=localStorage.getItem('token')
console.log(token)
axios.post('http://localhost:8000/api/logout', null, {

headers: {
'Authorization': `Bearer ${token}`
}
})

.then((response) => {
console.log(response)
localStorage.removeItem('token')
localStorage.removeItem('user')

11
router.push("/login")
})
.catch(err => {console.log(err);alert(err) })

}
</script>
<style lang="scss" scoped>
/* Ajoutez vos styles ici si nécessaire */
.navbar {
  height: 70px; /* Ajustez la hauteur selon vos besoins */
}

.nav-link {
  color: rgb(8, 2, 2) !important; /* Couleur du texte des liens */
  transition: color 0.3s ease; /* Animation de transition pour l'effet hover */
}

.nav-link:hover {
  color: #007bff !important; /* Couleur du texte des liens au survol (bleu) */
}

.navbar-toggler {
  border-color: white; /* Couleur de la bordure du bouton de bascule */
}

.navbar-toggler-icon {
  background-color: white; /* Couleur de l'icône du bouton de bascule */
}

.form-control {
  background-color: #fff; /* Couleur du champ de recherche */
  color: #000; /* Couleur du texte du champ de recherche */
  border-color: white; /* Couleur de la bordure du champ de recherche */
}

.btn-secondary {
  background-color: #fff; /* Couleur du bouton de recherche */
  border-color: #fff; /* Couleur de la bordure du bouton de recherche */
}

/* Ajout d'effet de survol pour le bouton Search */
.btn-secondary:hover {
  background-color: #007bff; /* Couleur du bouton au survol (bleu) */
  border-color: #007bff; /* Couleur de la bordure du bouton au survol (bleu) */
  color: #fff; /* Couleur du texte au survol (blanc) */
}

/* Ajout d'effet de survol pour le bouton du panier */
.nav-item.me-3:hover .nav-link {
  color: #007bff !important; /* Couleur du texte au survol (bleu) */
}



.badge {
position: absolute;
  background-color: red;
  color: white;
  border-radius: 50%;
  font-size: 12px;
}
.d-inline{
  color: #000;
}
</style>