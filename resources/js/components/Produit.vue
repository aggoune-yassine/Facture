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
                                   
                                
                                    <option value="2">les Produits dans le stock</option>
                                    <option value="3">Les Produits hors stock </option>
                                 
                                </select>
                            </div>

                                <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span
                                        class="input-group-text"
                                        id="basic-addon1"
                                        >Type</span
                                    >
                                </div>

                                <select
                                    class="custom-select"
                                    id="inputGroupSelect01"
                                    v-model="type_id"
                                     @change="searchProduit"
                                >
                                    <option
                                        v-for="(T, index) in type"
                                        :value="T.id"
                                        v-bind:key="index"
                                    >
                                        {{ T.designation }}
                                    </option>
                                </select>
                            </div>
                        </class>
                    </div>

                    <table class="table mt-4">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">id</th>
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

                                <td>{{ p.code }}</td>
                                <td>{{ p.description }}</td>
                                <td>{{ p.unit_price }}</td>

                                <td>{{ p.date_achat }}</td>
                                <td>{{ p.user.name }}</td>
                                <td>{{ p.created }}</td>
                            </tr>
                        </tbody>
                    </table>

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
            type:'',
            type_id:'',
        };
    },

    methods: {
        searchProduit() {
            //   if (this.q.length > 3) {

                axios.get("api/produit", {
                    params: {
                        q:this.q,
                        status:this.status,
                        type_id:this.type_id,


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
 

 onchange()
 {
alert('sddscsc');

 },
        getproduit(page) {
            if (typeof page === "undefined") {
                page = 1;
            }
            axios
                .get("api/produit?page=" + page)
                .then(response => {
                    console.log(response);
                    this.produits = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
             getTypemateriel() {
            axios
                .get("/api/materiel")
                .then(response => {
                    console.log(response.data);
                    this.type = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
    },

    created() {
        this.getproduit();
        this.getTypemateriel();
    }
};
</script>
