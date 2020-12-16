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
            id="addfile"
            tabindex="-1"
            role="dialog"
            aria-labelledby="addfile"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Ajouter les pieces a la Facture
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
                            @submit="updatefacture"
                            enctype="multipart/form-data"
                        >
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"
                                    >Piece depense</span
                                >
                                <div class="custom-file">
                                    <input
                                        type="file"
                                        name="filename"
                                        class="custom-file-input"
                                        id="inputFileUpload"
                                        @change="Piecedepense"
                                    />
                                    <label
                                        class="custom-file-label"
                                        for="inputFileUpload"
                                        >Choisir fichier
                                    </label>
                                </div>
                            </div>
                            <br />
                            <p class="text-danger font-weight-bold">
                                {{ Piece_depense1.name }}
                            </p>

                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"
                                    >Facture</span
                                >
                                <div class="custom-file">
                                    <input
                                        type="file"
                                        name="filename"
                                        class="custom-file-input"
                                        id="inputFileUpload"
                                        @change="facture"
                                    />
                                    <label
                                        class="custom-file-label"
                                        for="inputFileUpload"
                                        >Choisir fichier
                                    </label>
                                </div>
                            </div>
                            <br />
                            <p class="text-danger font-weight-bold">
                                {{ facture1.name }}
                            </p>

                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"
                                    >Bon de livraison</span
                                >
                                <div class="custom-file">
                                    <input
                                        type="file"
                                        name="filename"
                                        class="custom-file-input"
                                        id="inputFileUpload"
                                        @change="Bon_de_livraison"
                                    />
                                    <label
                                        class="custom-file-label"
                                        for="inputFileUpload"
                                        >Choisir fichier
                                    </label>
                                </div>
                            </div>
                            <br />
                            <p class="text-danger font-weight-bold">
                                {{ Bon_de_livraison1.name }}
                            </p>

                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"
                                    >Ordre de service</span
                                >
                                <div class="custom-file">
                                    <input
                                        type="file"
                                        name="filename"
                                        class="custom-file-input"
                                        id="inputFileUpload"
                                        @change="Ordre_de_service"
                                    />
                                    <label
                                        class="custom-file-label"
                                        for="inputFileUpload"
                                        >Choisir fichier
                                    </label>
                                </div>
                            </div>
                            <br />
                            <p class="text-danger font-weight-bold">
                                {{ Ordre_de_service1.name }}
                            </p>

                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"
                                    >Bon de commande.</span
                                >
                                <div class="custom-file">
                                    <input
                                        type="file"
                                        name="filename"
                                        class="custom-file-input"
                                        id="inputFileUpload"
                                        @change="Bon_de_commande"
                                    />
                                    <label
                                        class="custom-file-label"
                                        for="inputFileUpload"
                                        >Choisir fichier
                                    </label>
                                </div>
                            </div>
                            <br />
                            <p class="text-danger font-weight-bold">
                                {{ Bon_de_commande1.name }}
                            </p>

                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"
                                    >Caution</span
                                >
                                <div class="custom-file">
                                    <input
                                        type="file"
                                        name="filename"
                                        class="custom-file-input"
                                        id="inputFileUpload"
                                        @change="Caution"
                                    />
                                    <label
                                        class="custom-file-label"
                                        for="inputFileUpload"
                                        >Choisir fichier
                                    </label>
                                </div>
                            </div>
                            <br />
                            <p class="text-danger font-weight-bold">
                                {{ Caution1.name }}
                            </p>

                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"
                                    >Pv reception provisoire</span
                                >
                                <div class="custom-file">
                                    <input
                                        type="file"
                                        name="filename"
                                        class="custom-file-input"
                                        id="inputFileUpload"
                                        @change="Pv_reception_provisoire"
                                    />
                                    <label
                                        class="custom-file-label"
                                        for="inputFileUpload"
                                        >Choisir fichier
                                    </label>
                                </div>
                            </div>
                            <br />
                            <p class="text-danger font-weight-bold">
                                {{ Pv_reception_provisoire1.name }}
                            </p>

                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"
                                    >Pv de réception quantitatif et
                                    qualitatif</span
                                >
                                <div class="custom-file">
                                    <input
                                        type="file"
                                        name="filename"
                                        class="custom-file-input"
                                        id="inputFileUpload"
                                        @change="Pv_de_reception"
                                    />
                                    <label
                                        class="custom-file-label"
                                        for="inputFileUpload"
                                        >Choisir fichier
                                    </label>
                                </div>
                            </div>
                            <br />
                            <p class="text-danger font-weight-bold">
                                {{ Pv_de_reception1.name }}
                            </p>

                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"
                                    >Contrat</span
                                >
                                <div class="custom-file">
                                    <input
                                        type="file"
                                        name="filename"
                                        class="custom-file-input"
                                        id="inputFileUpload"
                                        @change="Contrat"
                                    />
                                    <label
                                        class="custom-file-label"
                                        for="inputFileUpload"
                                        >Choisir fichier
                                    </label>
                                </div>
                            </div>
                            <br />
                            <p class="text-danger font-weight-bold">
                                {{ Contrat1.name }}
                            </p>

                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"
                                    >proforma</span
                                >
                                <div class="custom-file">
                                    <input
                                        type="file"
                                        name="filename"
                                        class="custom-file-input"
                                        id="inputFileUpload"
                                        @change="proforma"
                                    />
                                    <label
                                        class="custom-file-label"
                                        for="inputFileUpload"
                                        >Choisir fichier
                                    </label>
                                </div>
                            </div>
                            <br />
                            <p class="text-danger font-weight-bold">
                                {{ proforma1.name }}
                            </p>

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
            code_facture: "",

            Piece_depense1: "",
            facture1: "",
            Bon_de_livraison1: "",
            Ordre_de_service1: "",
            Bon_de_commande1: "",
            Caution1: "",
            Pv_reception_provisoire1: "",
            Pv_de_reception1: "",

            Contrat1: "",
            proforma1: ""
        };
    },

    methods: {
        updatefacture(e) {
            e.preventDefault();
            const config = {
                headers: { "Content-Type": "multipart/form-data" }
            };
            let formData = new FormData();

                 formData.append("_method", "put");




            formData.append("Piece_depense", this.Piece_depense1);
            formData.append("facture", this.facture1);
            formData.append("Bon_de_livraison", this.Bon_de_livraison1);
            formData.append("Ordre_de_service", this.Ordre_de_service1);
            formData.append("Bon_de_commande", this.Bon_de_commande1);
            formData.append("Caution", this.Caution1);
            formData.append("Pv_reception_provisoire", this.Pv_reception_provisoire1);
            formData.append("Pv_de_reception", this.Pv_de_reception1);
            formData.append("Contrat", this.Contrat1);
            formData.append("proforma", this.proforma1);

            formData.append("code_facture", this.code_facture);

            formData.append("user_id", User.isLogged().id);

            axios
                .post(`/api/facture/file/${this.$route.params.id}`,formData, config)
                .then(response => {
                    //console.log(response);

                     Swal.fire({
                        position: "center ",
                        icon: "success",
                        title: "Les fichiers sont ajoutés avec succès ",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    
                    $("#addfile").modal("hide");
                    this.code_facture = "";
                    this.date = "";
                    this.fournisseur_id = "";
                    this.description = "";
                      this.Piece_depense1= "",
            this.facture1= "",
            this.Bon_de_livraison1="",
            this.Ordre_de_service1= "",
            this.Bon_de_commande1= "",
            this.Caution1="",
            this.Pv_reception_provisoire1= "",
            this.Pv_de_reception1= "",

            this.Contrat1= "",
            this.proforma1= "",
           // this.$router.push({ name: 'edit_facture',params: {id:5} })
            this.$emit("add-file");

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


};
</script>
