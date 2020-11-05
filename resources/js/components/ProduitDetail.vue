<template>
    <div>
        <div class="container ">
            <div class="row my-4">
                <div class="container mt-5 text-center">
                    <div class="card ">
                        <div class="card-header">
                            Details Produit
                        </div>

                        <div class="card-body">
                            <form
                                @submit="updatefacture"
                                enctype="multipart/form-data"
                            >
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span
                                            class="input-group-text"
                                            id="basic-addon1"
                                            >Code Produit</span
                                        >
                                    </div>
                                    <div class="input-group-append">
                                        <span
                                            class="input-group-text"
                                            id="basic-addon2"
                                            >{{ code_produit }}</span
                                        >
                                    </div>
                                </div>

                           

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span
                                            class="input-group-text"
                                            id="basic-addon1"
                                            >Fournisseur</span
                                        >
                                    </div>

                                    <select
                                        class="custom-select"
                                        id="inputGroupSelect01"
                                        v-model="fournisseur_id"
                                    >
                                        <option
                                            v-for="(F, index) in Fournisseur"
                                            :value="F.id"
                                            v-bind:key="index"
                                        >
                                            {{ F.title }}
                                        </option>
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span
                                            class="input-group-text"
                                            id="basic-addon1"
                                            >Description</span
                                        >
                                    </div>
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Details"
                                        aria-label="Details"
                                        aria-describedby="basic-addon1"
                                        v-model="description"
                                    />
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span
                                            class="input-group-text"
                                            id="basic-addon1"
                                            >Pièce dépense</span
                                        >
                                    </div>

                                    <div class="file-field">
                                        <div
                                            class="btn btn-primary btn-sm float-left"
                                        >
                                            <span>Choose file</span>
                                            <input
                                                type="file"
                                                @change="ondepencechange"
                                                name="piece_d"
                                            />
                                        </div>
                                    </div>
                                </div>
                                     <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span
                                            class="input-group-text"
                                            id="basic-addon1"
                                            >Piece Depense</span
                                        >
                                    </div>
                                 <iframe
                                    :src=piece
                                    frameBorder="0"
                                    width="700"
                                    height="500"
                                ></iframe>
                                </div>
     
                                

                                <div class="modal-footer">
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >
                                        Save changes
                                    </button>
                                </div>
                            </form>
                        </div>
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
            facture: {},
            piece:'',
            code_produit: "",
            title: "",
            date: "",
            prix:"",
            montant_global:"",
            fournisseur_id: "",
            description: "",
            Fournisseur: "",
            piece_d: ""
        };
    },

    methods: {
        updatefacture(e) {
            e.preventDefault();
            const config = {
                headers: { "Content-Type": "multipart/form-data" }
            };
            let formData = new FormData();

            formData.append("piece_d", this.piece_d);
            formData.append("code_facture", this.code_facture);
            formData.append("date", this.date);
            formData.append("fournisseur_id", this.fournisseur_id);
            formData.append("description", this.description);
            formData.append("_method", "put");

            axios
                .post(`/api/facture/${this.$route.params.id}`, formData, config)
                .then(response => {
                    //console.log(response);

                    Swal.fire({
                        position: "center ",
                        icon: "success",
                        title: "Facture Modifiée",
                        showConfirmButton: false,
                        timer: 1500
                    });

                    this.$router.push({ name: "adminPanel" });
                    this.$emit("add-fac");
                    //   $("#addFacture").modal("hide");
                    this.code_facture = "";
                    this.date = "";
                    this.fournisseur_id = "";
                    this.description = "";
                })
                .catch(error => {
                    console.log(error);
                });
            /*      axios
                .post("/api/facture", {
                    id_facture: this.code_facture,
                    date: this.date,
                    fournisseur_id: this.fournisseur_id,
                    description: this.description
                })
                .then(response => {
                    //console.log(response);
                    this.$emit("add-fac", response);
                    (this.code_facture = ""),
                        (this.date = ""),
                        (this.fournisseur_id = ""),
                        (this.description = "");
                })
                .catch(error => {
                    console.log(error);
                });*/
        },

        getProduit() {
            axios
                .get(`/api/produit/${this.$route.params.id}`)
                .then(response => {
                    console.log(response.data);
                   this.detail = response.data;
                    this.code_produit = this.detail.product['0'].code;
                     this.description = this.detail.product['0'].description;
                   this.date = this.detail.product['0'].date_achat;
                   this.prix =this.detail.product['0'].unit_price;
                   this.montant_global =this.detail.montant_facture;

                 //   this.title = this.facture.fournisseur.title;
                   
                 //   this.fournisseur_id = this.facture.fournisseur.id;
                 //   this.piece='/'+this.facture.piece_depence;
                })
                .catch(error => {
                    console.log(error);
                });
        },

   

        ondepencechange(event) {
            console.log(event.target.files[0]);
            this.piece_d = event.target.files[0];
        }
    },

    created() {
        // alert("qsdqsdqs");

        this.getProduit();
    }
};
</script>
