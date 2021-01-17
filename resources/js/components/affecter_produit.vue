<template>
    <!-- Modal -->
    <div
        class="modal fade"
        id="aff_produit"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Affecter produit
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
                    <form @submit="submitForm" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for=""> structure d'affectation</label>
                            <select
                                class="form-control"
                                name=""
                                v-model="structure"
                                id=""
                            >
                                  <option
                                        v-for="(F, index) in codestructure"
                                        :value="F.id"
                                        v-bind:key="index"
                                    >
                                        {{ F.designation }}
                                    </option>
                            </select>
                        </div>

                        














                        <div class="input-group">
                            <div class="custom-file">
                                <input
                                    type="file"
                                    name="filename"
                                    class="custom-file-input"
                                    id="inputFileUpload"
                                    @change="onFileChange"
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
                            {{ filename }}
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
</template>

<script>
export default {
    data() {
        return {
            codestructure: "",
            structure: "",
            filename: "",
            file: "",
            success: ""
        };
    },

    methods: {
        onFileChange(e) {
            this.filename = "Selected File: " + e.target.files[0].name;
            this.file = e.target.files[0];
        },

        getstructure() {
            axios
                .get("/api/structure")
                .then(response => {
                    this.codestructure = response.data;


                })
                .catch(error => {});
        },
        submitForm(e) {
            // console.log(e);

            e.preventDefault();
            //et currentObj = this;
            const config = {
                headers: { "Content-Type": "multipart/form-data" }
            };

            // form data
            let formData = new FormData();
            formData.append("file", this.file);
            formData.append("structure", this.structure);

            formData.append("_method", "put");

            // send upload request
            axios
                .post(`/api/produit/${this.$route.params.id}`, formData, config)
                .then(response => {

                    Swal.fire({
                        position: "center ",
                        icon: "success",
                        title: "Affectation avec succes ",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    this.$emit("affecter-file");
                    $("#aff_produit").modal("hide");
                    // currentObj.success = response.data.success;
                    this.filename = "";
                    this.file = "";
                })
                .catch(error => {
                    // this.output = error;
                });
        }
    },

    created() {
        this.getstructure();
    }
};
</script>
