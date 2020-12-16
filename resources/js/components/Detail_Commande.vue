<template>
    <div>
        <div class="container mt-5">
            <div class="row my-5">
                <div class="col-md-12">
                    <div class="card mt-4">
                       
                        <div class="card-header">
                            Ajouter Produit a la décharge

                            <router-link :to="chamin"
                                            >
                                            
                                            <i class="fa fa-plus"></i>
                                            
                                            
                                            </router-link>
                           
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                              
                            </div>

                            <div class="table-responsive-sm">

  
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="center">#</th>
                                            <th>code Produit</th>

                                            <th>Description</th>
                                            <th>Date d'achat</th>

                                            <th class="right">Prix Unitaire</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(commande, index) in commandes"
                                            v-bind:key="index"
                                        >

                                         
                                          <td>
                                            <router-link :to="'/Produit/'+commande.id"
                                            >{{ commande.id}}</router-link>

                                          </td>
                                            <td class="left strong">
                                                {{ commande.code }}
                                            </td>

                                            <td class="left">
                                                {{
                                                   commande.description
                                                }}
                                            </td>

                                             <td class="left">
                                                {{
                                                   commande.date_achat
                                                }}
                                            </td>
                                            <td class="left">
                                                {{commande.unit_price }}
                                            </td>

                                            
                                            <td>
                                                <a
                                                    @click="
                                                        supprimerProduit(
                                                            commande.id
                                                        )
                                                    "
                                                    class="btn  btn-sm btn-danger text-white "
                                                >
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                           
    
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <addproduit @add-prod="refresh" />
        <addproduittodecharge v-if="str" v-bind:idbon="idbon" v-bind:str="str"  />
       
    </div>
</template>

<script>
import addproduit from "./Add_Produit.vue";
import addproduittodecharge from "./Add_list_produit.vue";
export default {
    data() {
        return {

            
            facture: "",

            produits: [],
            commandes:'',
            bondecharge:'',
            
            str:'',
            idbon:this.$route.params.id


        };
    },

 

    methods: {


         getcommande() {


             axios.get(`/api/commande/commande_produit/${this.$route.params.id}`)
             .then(response=> {
                  //     console.log(response);
                    this.commandes = response.data.produits;
                    this.bondecharge=response.data.commande;
                    this.str=this.bondecharge.structure_id;
               
                   

             })
             .catch(error=> {
                     console.log(error);
             })
     
        },
        getfacture() {
            axios
                .get(`/api/facture/show/${this.$route.params.id}`)
                .then(response => {
                    console.log(response);
                   // this.facture = response.data;

                 //   this.produits = response.data.produits;
                })
                .catch(error => {
                    console.log(error);
                });
        },

        refresh(data) {
            //  alert(produits.facture);
            //  this.facture.produits = data.produits;
            //  this.facture.nbr = data.nbr;
            //  this.facture.total = data.total;

            this.getfacture();
        },

        supprimerProduit(produit) {
            Swal.fire({
                position: "center ",
                icon: "warning",
                title: "Voulez vous supprimer le produit du bon d'écharge?",
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonText: "oui",
                confirmButtonColor: "#3085D6",
                cancelButtonText: "Annulé",
                cancelButtonColor: "#d33"
            }).then(result => {
                if (result.value) {
      
                    axios
                        .delete(`/api/produit/supproduit/${produit}`)

                        .then(response => {
                            if (response.data.message) {
                                Swal.fire({
                                    position: "center ",
                                    icon: "success",
                                    title: "produit Supprimé",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                Swal.fire({
                                    position: "center ",
                                    icon: "success",
                                    title:
                                        "produit non  Supprimé. Déja affecté",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                            this.getcommande();
                        })
                        .catch(error => {
                            console.log(error);
                        });
                }
            });
        }
    },

       mounted() {
      //  this.getfacture();
        this.getcommande();
    },

    components: { addproduit,addproduittodecharge }
};
</script>
