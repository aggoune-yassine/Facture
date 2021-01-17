<template>
    <div>
        <div class="container">
            <div class="row my-5">
                <div class="col-sm-3 mt-4">
                    <div class="card ">
                        <div class="card-header ">Fournisseur du produit :</div>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                Nom: {{ fournisseur.title }}
                            </li>

                            <li class="list-group-item">
                                Adresse:
                                {{ fournisseur.adresse }}
                            </li>
                            <li class="list-group-item">
                                Email: {{ fournisseur.email }}
                            </li>
                            <li class="list-group-item">
                                Phone:
                                {{ fournisseur.telephone }}
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-6 mt-4">
                    <div class="card">
                        <div class="card-header ">
                            Information sur le produit :
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    Code produit : {{ code_produit }}
                                </li>

                                <li class="list-group-item">
                                    Description du produit : {{ description }}
                                </li>

                                <li class="list-group-item">
                                    Date achat:
                                    {{ date }}
                                </li>
                                <li class="list-group-item">
                                    code facture: {{ facture.facture_code }}
                                </li>
                                <li class="list-group-item">
                                    Date facture:
                                    {{ facture.date }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 ">
                    <div class="card">
                        <div class="card-header">
                            FICHE DE SORTIE
                        </div>
                        <div v-if="File || structure">
                         <div  class="card-body">
                           

                     <ul class="list-group list-group-flush">

                       <li class="list-group-item">
                                    Code du siege receptionnaire   :
                                    {{ structure }}
                                </li>
                            <li class="list-group-item">

                           
                              <button
                                type="button"
                                class="btn btn-primary"
                                data-toggle="modal"
                                data-target="#aff_produit"
                            >
                                Modifier affectation produit
                            </button>

                                       <button
                    type="button"
                    class="btn btn-primary"
                    @click="supprime"
                >
                    supprimer fiche mouvement
                </button>
                            </li>

                            
                        </ul>
                         </div>
                            <pdf :src="File"></pdf>
                        </div>
                        <div v-else class="card-body">
                         <ul class="list-group list-group-flush">

                          <li class="list-group-item">
                        
                            <button
                                type="button"
                                class="btn btn-primary"
                                data-toggle="modal"
                                data-target="#aff_produit"
                            >
                                Affecter produit
                            </button>
                            </li>

                         </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <aff_produit @affecter-file="refresh()"  />
    </div>
</template>

<script>
import pdf from "vue-pdf";
import aff_produit from "./affecter_produit";
export default {
    data() {
        return {
            facture: "",
            piece: "",
            code_produit: "",
            title: "",
            date: "",
            prix: "",
            montant_global: "",
            fournisseur: "",
            description: "",
            fournisseur: "",
            structure: "",
            etat_affectation: "0",
            Fiche_mouvement: "",
            File: ""
        };
    },

    components: {
        aff_produit: aff_produit,
        pdf: pdf
    },

    methods: {


        refresh(){
             
       
        this.getProduit();
    

    },
        getProduit() {
            axios
                .get(`/api/produit/show/${this.$route.params.id}`)
                .then(response => {
                    console.log(response);
                  //  this.detail = response.data;
                    this.code_produit = response.data.product.code;
                       this.facture = response.data.facture;
                  this.fournisseur = response.data.fournisseur;
                    this.description = response.data.product.description;
                    this.date = response.data.product.date_achat;
                   this.prix = response.data.product.unit_price;
                   this.montant_global = response.data.product.montant_facture;
                    this.montant_global = response.data.montant_facture;
              
                   
                    this.structure = response.data.product.structure.designation;
                   this.File = response.data.product.file;

                    //   this.title = this.facture.fournisseur.title;

                    //   this.fournisseur_id = this.facture.fournisseur.id;
                    //   this.piece='/'+this.facture.piece_depence;
                })
                .catch(error => {
                    console.log(error);
                });
        },

         supprime(){



  axios.delete('/api/produit/deletefile/'+this.$route.params.id)
  .then(response=> {

   
        this.File="";
  })
  .catch(error=> {
  })

 
   

        },


        onchangefichemouvement(event) {
            console.log(event.target.files[0]);
            this.Fiche_mouvement = event.target.files[0];
        }
    },

    created() {
        // alert("qsdqsdqs");

        this.getProduit();
    },

    
};
</script>
