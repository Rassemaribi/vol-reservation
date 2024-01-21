const state = {
    cart: [],        // Un tableau représentant le panier d'achat des vols
    cartTotal: 0,    // Le total actuel du panier
  };
  
  const mutations = {
    clearCart(state) {
      // Vider le panier et réinitialiser le total à zéro
      state.cart = [];
      state.cartTotal = 0;
    },
    addCart(state, payload) {
      // Ajouter un vol au panier et mettre à jour le total
      const flightInCartIndex = state.cart.findIndex(
        (item) => item.flight.id === payload.flight.id
      );
      
      // Assurez-vous que flight a la structure correcte
      if (flightInCartIndex < 0 && payload.flight.prix && payload.flight.id) {
        state.cart.push(payload);
        state.cartTotal = state.cart.reduce((cartTotal, cartItem) => {
          return (
            parseFloat(cartTotal) +
            parseFloat(cartItem.flight.prix * cartItem.qty)
          );
        }, 0);
      }
    },
    
    removeFromCart(state, payload) {
      if (payload && payload.flight) {
        // Supprimer un vol du panier et mettre à jour le total
        state.cart = state.cart.filter(function (cartItem) {
          return cartItem.flight.id !== payload.flight.id;
        });
        state.cartTotal = state.cart.reduce((cartTotal, cartItem) => {
          return (
            parseFloat(cartTotal) +
            parseFloat(cartItem.flight.prix * cartItem.qty)
          );
        }, 0);
      }
    },
    
    incrementQuantity(state, index) {
      // Incrémenter la quantité d'un vol dans le panier
      state.cart[index].qty++;
      state.cartTotal = state.cart.reduce((cartTotal, cartItem) => {
        return (
          parseFloat(cartTotal) +
          parseFloat(cartItem.flight.prix * cartItem.qty)
        );
      }, 0);
    },
  
    decrementQuantity(state, payload) {
        // Diminuer la quantité d'un vol dans le panier et recalculer le total
        const flightInCartIndex = state.cart.findIndex(
          (item) => item.flight.id === (payload.flight && payload.flight.id)
        );
    
        if (flightInCartIndex >= 0 && state.cart[flightInCartIndex].qty > 1) {
          state.cart[flightInCartIndex].qty--;
          state.cartTotal = state.cart.reduce((cartTotal, cartItem) => {
            return (
              parseFloat(cartTotal) +
              parseFloat(cartItem.flight.prix * cartItem.qty)
            );
          }, 0);
        }
      },
    
      updateFlightCapacity(state, flightsToUpdate) {
        flightsToUpdate.forEach(flightToUpdate => {
          const cartItemIndex = state.cart.findIndex(cartItem => cartItem.flight.id === flightToUpdate.id);
          const volIndex = state.vols.findIndex(vol => vol.id === flightToUpdate.id);
    
          if (cartItemIndex !== -1 && volIndex !== -1) {
            // Mettez à jour la capacité du vol dans le panier
            state.cart[cartItemIndex].flight.capacite -= 1; // ou ajustez selon votre logique
    
            // Mettez également à jour la capacité du vol dans la liste complète des vols
            state.vols[volIndex].capacite -= 1; // ou ajustez selon votre logique
          }
        });
      },
    };
  export default {
    namespaced: true,
    state,
    mutations,
  };
  