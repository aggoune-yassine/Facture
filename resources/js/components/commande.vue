<template>
    <div>
        <div class="container ">
            <div class="row my-5">
                <div class="col-md-12">
                    <div class="row mt-3">
                        <div class="col">
                            <a
                                href="#"
                                data-toggle="modal"
                                data-target="#addCommande"
                                class="btn mt-5 btn-sm btn-success text-white mb-2"
                            >
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group ">
                                <label for="">Recherche bon commande</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name=""
                                    id=""
                                    v-model="q"
                                    @keyup="searchcommande"
                                    aria-describedby="helpId"
                                    placeholder="code commande"
                                />
                            </div>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">structure</th>
                              
                             
                                <th scope="col">Ajoutée par</th>
                                <th scope="col">Ajoutée depuis</th>
                                <th scope="col">Action</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(commande, index) in commandes.data"
                                v-bind:key="index"
                            >
                                <th scope="row">
                                    <router-link
                                        :to="'detailcommande/' + commande.id"
                                        >{{ index }}</router-link
                                    >
                                </th>
                             
                                <td>{{commande.structure.structure}}</td>
                                <td>{{ commande.user.name}}</td>
                                <td>{{ commande.created}}</td>
                                 <td>
                                    <router-link
                                        :to="{
                                            path:
                                                'commande/edit/' +
                                                commande.id
                                        }"
                                        class="btn mr-1 btn-sm btn-primary"
                                    >
                                        <div class="fa fa-eye"></div>
                                    </router-link>

                                    <router-link
                                        :to="{
                                            path: 'commande/edit/' + commande.id
                                        }"
                                        class="btn mr-1 btn-sm btn-warning"
                                    >
                                        <div class="fa fa-edit"></div>
                                    </router-link>

                                    <a
                                        @click="supprimercommande(commande.id)"
                                        class="btn  btn-sm btn-danger text-white "
                                    >
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                               

                            </tr>
                        </tbody>
                    </table>

                    <div class="card-footer d-flex justify-content-center">
                        <pagination
                            :data="factures"
                            @pagination-change-page="getfacture"
                        ></pagination>
                    </div>
                </div>
            </div>
            <addcommande @add-fac="refresh()" />
        </div>
    </div>
</template>

<script>
import addcommande from "./Add_Commande.vue";
export default {
    data() {
        return {
            commandes: [],
            q: "",
           
        };
    },

    methods: {
        searchcommande() {
         //   if (this.q.length > 3) {
                axios
                    .get("api/commande/"+this.q)
                    .then(response => {
                        console.log(response);
                        this.commandes= response.data;

                        


                    })
                    .catch(error => {
                        console.log(error);
                    });
          //  }
        },

        getcommande(page) {
            if (typeof page === "undefined") {
                page = 1;
            }
            axios
                .get("api/commande?page=" + page)
                .then(response => {
                    console.log(response);
                    this.commandes = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },

        refresh() {
            this.getcommande();
        },
        supprimercommande() {
            Swal.fire({
                position: "center ",
                icon: "warning",
                title: "Voulez vous supprimer la facture?",
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonText: "oui",
                confirmButtonColor: "#3085D6",
                cancelButtonText: "Annulé",
                cancelButtonColor: "#d33"
            }).then(result => {
                if (result.value) {
                    axios
                        .delete(`api/facture/${facture}`)
                        .then(response => {

                            

                            if(response.data.message)

                            {  

                            Swal.fire({
                                position: "center ",
                                icon: "success",
                                title: "Facture Supprimée",
                                showConfirmButton: false,
                                timer: 1500
                            });

                            }

                            else

                            {
                                 Swal.fire({
                                position: "center ",
                                icon: "success",
                                title: "Facture non Supprimée . Elle contient des produits",
                                showConfirmButton: false,
                                timer: 2500
                            });

                            }
                            this.getfacture();
                        })
                        .catch(error => {
                            console.log(error);
                        });
                }
            });
        }
    },

    components: {
        addcommande
    },
    created() {
        this.getcommande();
    }
};
</script>
