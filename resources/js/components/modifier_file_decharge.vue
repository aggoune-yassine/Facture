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
            id="moddecharge"
            tabindex="-1"
            role="dialog"
            aria-labelledby="moddecharge"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Modifier bon décharge
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
                            @submit="moddecharge"
                            enctype="multipart/form-data"
                        >
                            <div class="input-group mb-3">
                                <div class="input-group">
                                    <span
                                        class="input-group-text"
                                        id="basic-addon1"
                                        >bon décharge</span
                                    >
                                    <div class="custom-file">
                                        <input
                                            type="file"
                                            name="filename"
                                            class="custom-file-input"
                                            id="inputFileUpload"
                                            @change="Piecedecharge"
                                        />
                                        <label
                                            class="custom-file-label"
                                            for="inputFileUpload"
                                            >Choisir fichier
                                        </label>
                                    </div>
                                </div>
                                <p class="text-danger font-weight-bold">
                                    {{ decharge1.name }}
                                </p>
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
            code_decharge: "",
            structure: "",
            structure_id: "",
            allerros: [],
            decharge1: ""
        };
    },

    methods: {
        moddecharge(e) {
            e.preventDefault();
            const config = {
                headers: { "Content-Type": "multipart/form-data" }
            };
            let formData = new FormData();
          
            formData.append("decharge", this.decharge1);

            formData.append("user_id", User.isLogged().id);

            axios
                .post(`/api/commande/update/${this.$route.params.id}`, formData, config)
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

       

        Piecedecharge(event) {
            this.decharge1 = event.target.files[0];
        }
    },

    created() {
        // alert("qsdqsdqs");
        this.getStructure();
    }
};
</script>
