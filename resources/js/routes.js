import Accueil from './components/accueil.vue';
import ViewCompagnie from './components/CompagnieAerienne/viewCompagnie.vue'
import AddCompagnie from './components/CompagnieAerienne/addCompagnie.vue'
import UpdateCompagnie from './components/CompagnieAerienne/updateCompagnie.vue'
import ViewVol from './components/vol/ViewVol.vue'
import AddVol from './components/vol/addVol.vue'
import EditVol from './components/vol/editVol.vue'
import Menu from "./components/Menu.vue"
import RechercheVol from './components/vol/rechercheVol.vue'
import Cart from './components/cart/Cart.vue';
import Payment from './components/cart/Payment.vue';
import Login from './components/authentification/login.vue'
import Register from './components/authentification/register.vue'
export const routes = [
{
name: 'accueil',
path: '/',
component: Accueil
},
{
    name:"ViewCompagnie",
    path:"/compagnie",
    component:ViewCompagnie,
    meta:{isAuth:true}
    },
    {
        name:"AddCompagnie",
        path:"/addcompagnie",
        component:AddCompagnie,
        meta:{isAuth:true}
        },
        {
        name:"UpdateCompagnie",
        path:"/updatecompagnie/:id",
        component:UpdateCompagnie,
        meta:{isAuth:true}
        },
        {
            name:"ViewVol",
            path:"/vol",
            component:ViewVol,
            meta:{isAuth:true}
            },
            {
                name:"AddVol",
                path:"/addVol",
                component:AddVol,
                meta:{isAuth:true}
                },
                {
                name:"EditVol",
                path:"/editVol/:id",
                component:EditVol,
                meta:{isAuth:true}
                },
                {
                    name:"menu",
                    path:"/menu",
                    component:Menu
                    },
                    {
                        name:"RechercheVol",
                        path:"/rechercheVol",
                        component:RechercheVol
                        },
                        {
                            path:'/cart',
                            name:'Cart',
                            component:Cart
                            },

                            {
                                path:'/payment',
                                name:'Payment',
                                component:Payment
                                },
                                {
                                    name: "login",
                                    path: "/login",
                                    component: Login,
                                    },
                                    {
                                    name: "register",
                                    path: "/register",
                                    component: Register,
                                    },
];