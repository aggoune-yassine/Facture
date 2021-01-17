<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top ">
            <router-link class="navbar-brand" :to="home">Facturation & stock</router-link>
            <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation">
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                  <router-link class="nav-link" :to="home">Accueil</router-link>
                </li>
                  <li class="nav-item">
                
                   <router-link class="nav-link" :to="ad" v-if="logged && admin" >facturation</router-link>
                </li>

                
                
                
    



  <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Stock
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <router-link class="nav-link" :to="Produit" v-if="logged && admin" >List des produits </router-link>
                                 <div class="dropdown-divider"></div>  
                         <router-link class="nav-link" :to="commande" v-if="logged && admin" >List des décharges </router-link>
       
        </div>
      </li>
                
                
                 <li class="nav-item">
                  <router-link class="nav-link" :to="budget" >Budget</router-link>
                </li>
                <li class="nav-item">
                  <router-link class="nav-link" :to="signup" v-if="!logged">Inscription</router-link>
                </li>
                <li class="nav-item">
                  <router-link class="nav-link" :to="login" v-if="!logged">Connexion</router-link>
                </li>

                
                <li class="nav-item">
                    <a class="nav-link" @click="userlogout" style="cursor:pointer" v-if="logged">
                        <span class="font-weight-bold">{{name.toUpperCase()}}</span> Déconnexion
                    </a>
                </li>
              </ul>
            </div>
        </nav>
    </div>
</template>

<script>
export default {
    data(){
        return{
            home : '/',
            login : '/login',
            signup : '/inscription',
            logout : '/logout',
            budget : '/budget',
            ad : '/admin',
            commande:'/commande',
            Produit:'/Produit',
            logged : User.isLogged().logged,
            name : User.isLogged().name,
            admin :User.isadmin()
        }
    },
    methods: {
        userlogout(){
            User.logout();
            this.logged = false;
           // this.$router.go();
            this.$router.push({name : 'login'});
        }
    },
}
</script>