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
            id="addFacture"
            tabindex="-1"
            role="dialog"
            aria-labelledby="addFacture"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Ajouter Facture
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
                    <form @submit="addfacture" enctype="multipart/form-data" >
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"
                                    >Code Facture</span
                                >
                            </div>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="code facture"
                                aria-label="code facture"
                                aria-describedby="basic-addon1"
                                v-model="code_facture"
                            />
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label
                                    class="input-group-text"
                                    for="inputGroupSelect01"
                                    >Date</label
                                >
                            </div>
                            <input
                                class="form-control"
                                type="date"
                                v-model="date"
                                id="example-date-input"
                            />
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"
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
                                <span class="input-group-text" id="basic-addon1"
                                    >Detail de la facture</span
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
                                <span class="input-group-text" id="basic-addon1"
                                    >Pièce dépense</span
                                >
                            </div>
                     
                             <div class="file-field">
                               <div class="btn btn-primary btn-sm float-left">
                              <span>Choose file</span>
                               <input type="file"
       @change="ondepencechange"
         name='piece_d'>
    </div>
   
  </div>
                        

                         </div>

                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal"
                            >
                                Close
                            </button>
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
</template>

<script>
export default {
    data() {
        return {
            code_facture: "",
            date: "",
            fournisseur_id: "",
            description: "",
            Fournisseur: "",
            piece_d:''
        };
    },

    methods: {
        addfacture(e) {

            e.preventDefault();
            const config={
                headers:{"Content-Type": "multipart/form-data"}
                
            }
            let formData=new FormData();

            formData.append("piece_d",this.piece_d)
            formData.append("code_facture",this.code_facture)
            formData.append("date",this.date)
            formData.append("fournisseur_id",this.fournisseur_id)
            formData.append("description",this.description)
            
            formData.append("user_id",User.isLogged().id)


             axios.post("api/facture",formData,config)
                .then(response => {
                    //console.log(response);

                    Swal.fire({
               position: 'center ',
              icon: 'success',
             title: 'Facture Ajoutée',
             showConfirmButton: false,
              timer: 1500
              })
                this.$emit("add-fac");
                    $('#addFacture').modal('hide');
                    (this.code_facture = "");
                        (this.date = "");
                        (this.fournisseur_id = "");
                        (this.description = "");
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

        getFournisseur() {
            axios
                .get("/api/Fournisseur")
                .then(response => {
                    console.log(response.data);
                    this.Fournisseur = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },

        ondepencechange(event){
            console.log(event.target.files[0])
            this.piece_d=event.target.files[0];
        }
    },

    created() {
        // alert("qsdqsdqs");
        this.getFournisseur();
    }
};
</script>
