<template>
    <div>
        <div class="container ">
            <div class="row my-5">
                <div class="col-md-12">
                    <div class="card text-white bg-dark mt-5">
                        <div class="card-header">
                            <label for="">Liste des Produits</label>
                        </div>

                        <class class="card-body">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span
                                        class="input-group-text"
                                        id="basic-addon1"
                                        >Recherche produit par code</span
                                    >
                                </div>
                                <input
                                    v-model="q"
                                    @keyup="searchProduit"
                                    type="text"
                                    class="form-control"
                                    placeholder="Code produit"
                                    aria-label="Username"
                                    aria-describedby="basic-addon1"
                                />
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span
                                        class="input-group-text"
                                        id="basic-addon1"
                                        >Recherche Produit </span
                                    >
                                </div>
                                <select
                                    class="form-control"
                                    id="exampleFormControlSelect1"
                                    v-model="status"
                                    @change="searchProduit"
                                    
                                >
                                   
                                    <option value="">tous les produits</option>
                                   
                                    <option value="1">dans le stock</option>
                                    <option value="2">Fiche mouvement sans retour</option>
                                    <option value="3">Fiche mouvement avec retour</option>
                                    <option value="4">avec bon de commande</option>
                                </select>
                            </div>
                        </class>
                    </div>

                    <table class="table mt-4">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">ajouter au bon d'echarge</th>
                                <th scope="col">code produit</th>
                                <th scope="col">description</th>

                                <th scope="col">Prix</th>

                                <th scope="col">Date Facture</th>
                                <th scope="col">Ajoutée par</th>
                                <th scope="col">Ajoutée depuis</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(p, index) in produits.data"
                                v-bind:key="index"
                            >
                                <th scope="row">
                                    <router-link :to="'Produit/' + p.id">{{
                                        p.id
                                    }}</router-link>
                                </th>

                                 <td >
    <input type="checkbox" class="form-check-input center" v-model="tab" :value="p.id" id="exampleCheck1">
    
  </td>

                                <td>{{ p.code }}</td>
                                <td>{{ p.description }}</td>
                                <td>{{ p.unit_price }}</td>

                                <td>{{ p.date_achat }}</td>
                                <td>{{ p.user.name }}</td>
                                <td>{{ p.created }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <button v-on:click='bonadd'>click</button>

                    <div class="card-footer d-flex justify-content-center">
                        <pagination
                            :data="produits"
                            @pagination-change-page="getproduit"
                        ></pagination>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            produits: {},
            q: "",
            status:'',
            tab:[],
        };
    },

    methods: {
        searchProduit() {
            //   if (this.q.length > 3) {

                axios.get("api/produit", {
                    params: {
                        q:this.q,
                        status:this.status
                    

                    }
                })
                .then(response=> {
                      console.log(response);
                    this.produits = response.data;
                })
                .catch(error=> {
                     console.log(error);
                })
          
            //  }
        },


        bonadd(){
                     
                  axios.get("/api/produit/addbon", {
                    params: {
                        tab:this.tab,
                        id:this.$route.params.structure
                      
                    

                    }
                })
                .then(response=> {
                      console.log(response);
                    this.produits = response.data;
                })
                .catch(error=> {
                     console.log(error);
                })


        },
 

 onchange()
 {
alert('sddscsc');

 },
        getproduit(page) {
            if (typeof page === "undefined") {
                page = 1;
            }
            axios
                .get("/api/produit" ,
                {
                    params :{
                           page:page,
                          idstructure:this.$route.params.structure,
                    }

                })
                .then(response => {
                    console.log(response);
                    this.produits = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        }
    },

    created() {

      
        this.getproduit();
    }
};
</script>
