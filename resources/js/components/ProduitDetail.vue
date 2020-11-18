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
                        <div v-if="File">
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
        <aff_produit />
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
        getProduit() {
            axios
                .get(`/api/produit/${this.$route.params.id}`)
                .then(response => {
                    console.log(response.data);
                    this.detail = response.data;
                    this.code_produit = this.detail.product["0"].code;
                    this.description = this.detail.product["0"].description;
                    this.date = this.detail.product["0"].date_achat;
                    this.prix = this.detail.product["0"].unit_price;
                    this.montant_global = this.detail.montant_facture;
                    this.facture = this.detail.product["0"].facture;
                    this.fournisseur = this.detail.product["0"].fournisseur;
                    this.structure = this.detail.product["0"].structure;
                    this.File = this.detail.product["0"].file;

                    //   this.title = this.facture.fournisseur.title;

                    //   this.fournisseur_id = this.facture.fournisseur.id;
                    //   this.piece='/'+this.facture.piece_depence;
                })
                .catch(error => {
                    console.log(error);
                });
        },

        onchangefichemouvement(event) {
            console.log(event.target.files[0]);
            this.Fiche_mouvement = event.target.files[0];
        }
    },

    created() {
        // alert("qsdqsdqs");

        this.getProduit();
    }
};
</script>
