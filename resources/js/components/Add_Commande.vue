<template>
    <div>
        <!-- Button trigger modal 
        <button
            type="button"
            class="btn btn-primary"
            data-toggle="modal"
            data-target="#addFacture"
        >
            Ajouter Facture
        </button>

         Modal -->

        <div
            class="modal fade"
            id="addCommande"
            tabindex="-1"
            role="dialog"
            aria-labelledby="addCommande"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Ajouter Commande
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form
                            @submit="addcommande"
                            enctype="multipart/form-data"
                        >
                        
                           
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span
                                        class="input-group-text"
                                        id="basic-addon1"
                                        >structure destinataire</span
                                    >
                                </div>

                                <select
                                    class="custom-select"
                                    id="inputGroupSelect01"
                                    v-model="structure_id"
                                >
                                    <option
                                        v-for="(s, index) in structure"
                                        :value="s.id"
                                        v-bind:key="index"
                                    >
                                        {{ s.structure }}
                                    </option>
                                </select>
                            </div>
                            <div
                                v-if="allerros.structure_id"
                                class="alert alert-danger"
                                role="alert"
                            >
                                {{ allerros.structure_id[0] }}
                            </div>

                           

                         

                            <div class="modal-footer">
                                <button
                                    type="button"
                                    class="btn btn-secondary"
                                    data-dismiss="modal"
                                >
                                    Close
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    Save changes
                                </button>
                            </div>
                        </form>
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
          
            structure: "",
            structure_id:'',
            allerros: []
        };
    },

    methods: {
        addcommande(e) {
            e.preventDefault();
            const config = {
                headers: { "Content-Type": "multipart/form-data" }
            };
            let formData = new FormData();

            formData.append("structure_id", this.structure_id);
          

            formData.append("user_id", User.isLogged().id);

            axios
                .post("api/commande", formData, config)
                .then(response => {
                    //console.log(response);

                    Swal.fire({
                        position: "center ",
                        icon: "success",
                        title: "Commande Ajoutée",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    this.$emit("add-com");
                    $("#addCommande").modal("hide");
                    this.structure = "";
                  
                })
                .catch(error => {
                    this.allerros = error.response.data.errors;
                });
        },

        getStructure() {
            axios
                .get("/api/structure")
                .then(response => {
                    console.log(response.data);
                  
                    this.structure = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },

        Piecedepense(event) {
            this.Piece_depense1 = event.target.files[0];
        },

        facture(e) {
            this.facture1 = e.target.files[0];
        },
        Bon_de_livraison(e) {
            this.Bon_de_livraison1 = e.target.files[0];
        },
        Ordre_de_service(e) {
            this.Ordre_de_service1 = e.target.files[0];
        },
        Bon_de_commande(e) {
            this.Bon_de_commande1 = e.target.files[0];
        },
        Caution(e) {
            this.Caution1 = e.target.files[0];
        },
        Pv_reception_provisoire(e) {
            this.Pv_reception_provisoire1 = e.target.files[0];
        },
        Pv_de_reception(e) {
            this.Pv_de_reception1 = e.target.files[0];
        },
        Contrat(e) {
            this.Contrat1 = e.target.files[0];
        },
        proforma(e) {
            this.proforma1 = e.target.files[0];
        }
    },

    created() {
        // alert("qsdqsdqs");
        this.getStructure();
    }
};
</script>
