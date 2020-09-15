import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../components/Home.vue'
import FactureDetails from '../components/FactureDetails.vue'

import login from '../components/login.vue'
import logout from '../components/logout.vue'
import inscription from '../components/inscription.vue'
import adminPanel from '../components/AdminPanel.vue'
import edit_facture from '../components/Edit_Facture.vue'
import budget from '../components/Budget.vue'


Vue.use(VueRouter)

const routes = [{

        path: '/',
        component: Home,
        name: 'home'
    },
    {

        path: '/inscription',
        component: inscription,
        name: 'inscription'
    },
    {

        path: '/login',
        component: login,
        name: 'login'
    },
    {

        path: '/logout',
        component: logout,
        name: 'logout'
    }, {

        path: '/facture/:id',
        component: FactureDetails,
        name: 'factureDetails'
    },
    {

        path: '/facture/edit/:id',
        component: edit_facture,
        name: 'edit_facture'
    },
    {

        path: '/facture/:id',
        component: FactureDetails,
        name: 'factureDetails'
    },

    {

        path: '/admin',
        component: adminPanel,
        name: 'adminPanel'
    },
    {

        path: '/budget',
        component: budget,
        name: 'budget'
    },

];

const router = new VueRouter({ routes, hashbang: false, mode: 'history' }

);
export default router;