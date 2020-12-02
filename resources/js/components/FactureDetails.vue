<template>
    <div>
        <div class="container mt-5">
            <div class="row my-5">
                <div class="col-md-12">
                    <div class="card mt-4">
                        <div class="card-header">
                            Facture
                            <strong>{{ facture.date }}</strong>
                            <span
                                v-if="(facture.produits = 0)"
                                class="float-right"
                            >
                                <strong>Status de la facture:</strong>
                                Payée</span
                            >
                            <span v-else class="float-right">
                                <strong>Status de la facture:</strong>
                                Non Payée</span
                            >
                        </div>
                        <div class="card-header">
                            Ajouter Produit
                            <a
                                href="#"
                                data-toggle="modal"
                                data-target="#addproduit"
                                class="btn  btn-sm btn-success text-white "
                            >
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-sm-6">
                                    <h6 class="mb-3">Fournisseur:</h6>
                                    <div>
                                        <strong>informations:</strong>
                                    </div>
                                    <div>
                                        Nom: {{ facture.fournisseur.title }}
                                    </div>
                                    <div>
                                        Adresse:
                                        {{ facture.fournisseur.adresse }}
                                    </div>
                                    <div>
                                        Email: {{ facture.fournisseur.email }}
                                    </div>
                                    <div>
                                        Phone:
                                        {{ facture.fournisseur.telephone }}
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive-sm">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="center">#</th>
                                            <th>Produit</th>

                                            <th>Ligne Budgetaire</th>
                                            <th>Date d'achat</th>

                                            <th class="right">Prix Unitaire</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(produit, index) in produits"
                                            v-bind:key="index"
                                        >
                                            <td class="center">{{ index }}</td>
                                            <td class="left strong">
                                                {{ produit.description }}
                                            </td>

                                            <td class="left">
                                                {{
                                                    produit.budget
                                                        .ligne_budgetaire
                                                }}
                                            </td>
                                            <td class="left">
                                                {{ produit.date_achat }}
                                            </td>

                                            <td class="right">
                                                {{ produit.unit_price }}DA
                                            </td>

                                            <td>
                                                <a
                                                    @click="
                                                        supprimerProduit(
                                                            produit.id
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
                            <div class="row">
                                <div class="col-lg-4 col-sm-5"></div>

                                <div class="col-lg-4 col-sm-5 ml-auto">
                                    <table class="table table-clear">
                                        <tbody>
                                            <tr>
                                                <td class="left">
                                                    <strong>Montant</strong>
                                                </td>
                                                <td class="right">
                                                    {{ facture.total }} DA
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="left">
                                                    <strong>Tva (19%)</strong>
                                                </td>
                                                <td class="right">
                                                    {{ facture.total * 1.9 }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="left">
                                                    <strong
                                                        >Nombre d'articles
                                                    </strong>
                                                </td>
                                                <td class="right">
                                                    {{
                                                        facture.produits.length
                                                    }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="left">
                                                    <strong>Total</strong>
                                                </td>
                                                <td class="right">
                                                    <strong
                                                        >{{
                                                            facture.total
                                                        }}
                                                        DA</strong
                                                    >
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
        </div>

        <addproduit @add-prod="refresh" />
    </div>
</template>

<script>
import addproduit from "./Add_Produit.vue";
export default {
    data() {
        return {
            facture: "",

            produits: []
        };
    },

    created() {
        this.getfacture();
    },

    methods: {
        getfacture() {
            axios
                .get(`/api/facture/show/${this.$route.params.id}`)
                .then(response => {
                    console.log(response);
                    this.facture = response.data;

                    this.produits = response.data.produits;
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
                title: "Voulez vous supprimer le produit?",
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonText: "oui",
                confirmButtonColor: "#3085D6",
                cancelButtonText: "Annulé",
                cancelButtonColor: "#d33"
            }).then(result => {
                if (result.value) {
                    axios
                        .delete(`/api/produit/${produit}`)

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
                            this.getfacture();
                        })
                        .catch(error => {
                            console.log(error);
                        });
                }
            });
        }
    },

    components: { addproduit }
};
</script>
