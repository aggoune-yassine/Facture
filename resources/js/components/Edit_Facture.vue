<template>
    <div>
        <div class="container ">
            <div class="row my-4">
                <div class="container mt-5 text-center">
                    <div class="card ">
                        <div class="card-header">
                            Modifier & edit Facture
                        </div>

                        <div class="card-body">

                         <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span
                                            class="input-group-text"
                                            id="basic-addon1"
                                            >Ajouter piece</span
                                        >
                                    </div>
                                    <div class="input-group-append">
                                         <button
                                type="submit"
                                class="btn btn-primary"
                                data-toggle="modal"
                                data-target="#addfile"
                            >
                                +
                            </button>
                                    </div>
                                </div>
                         
                            <form
                                @submit="updatefacture"
                                enctype="multipart/form-data"
                            >
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span
                                            class="input-group-text"
                                            id="basic-addon1"
                                            >Code Facture</span
                                        >
                                    </div>
                                    <div class="input-group-append">
                                        <span
                                            class="input-group-text"
                                            id="basic-addon2"
                                            >{{ code_facture }}</span
                                        >
                                    </div>
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

                <addfile @add-file="refresh" />
            </div>
            <div>
                <input type="checkbox" v-model="show" />
                <select v-model="src" class="browser-default custom-select">
                    <option
                        v-if="facture.Piece_depense"
                        :value="facture.Piece_depense"
                        >Piece depense</option
                    >
                    <option v-if="facture.facture" :value="facture.facture"
                        >facture</option
                    >
                    <option
                        v-if="facture.Bon_de_livraison"
                        :value="facture.Bon_de_livraison"
                        >Bon_de_livraison</option
                    >
                    <option
                        v-if="facture.Ordre_de_service"
                        :value="facture.Ordre_de_service"
                        >Ordre de service</option
                    >
                    <option
                        v-if="facture.Bon_de_commande"
                        :value="facture.Bon_de_commande"
                    >
                        Bon de commande</option
                    >
                    <option v-if="facture.Caution" :value="facture.Caution">
                        Caution</option
                    >
                    <option
                        v-if="facture.Pv_reception_provisoire"
                        :value="facture.Pv_reception_provisoire"
                    >
                        Pv reception provisoire</option
                    >
                    <option
                        v-if="facture.Pv_de_reception"
                        :value="facture.Pv_de_reception"
                    >
                        Pv de reception</option
                    >
                    <option v-if="facture.Contrat" :value="facture.Contrat"
                        >Contrat</option
                    >
                    <option v-if="facture.proforma" :value="facture.proforma"
                        >proforma</option
                    >
                </select>
                <input v-model.number="page" type="number" style="width: 5em" />
                /{{ numPages }}
                <button
                    type="button"
                    class="btn btn-primary"
                    @click="rotate += 90"
                >
                    &#x27F3;
                </button>
                <button
                    type="button"
                    class="btn btn-primary"
                    @click="rotate -= 90"
                >
                    &#x27F2;
                </button>
                <button
                    type="button"
                    class="btn btn-primary"
                    @click="$refs.pdf.print()"
                >
                    imprimer
                </button>
                  <button
                    type="button"
                    class="btn btn-primary"
                    @click="supprime"
                >
                    supprimer
                </button>
                <div style="width: 100%">
                    <div
                        v-if="loadedRatio > 0 && loadedRatio < 1"
                        style="background-color: green; color: white; text-align: center"
                        :style="{ width: loadedRatio * 100 + '%' }"
                    >
                        {{ Math.floor(loadedRatio * 100) }}%
                    </div>
                    <pdf
                        v-if="show"
                        ref="pdf"
                        style="border: 1px solid red"
                        :src="src"
                        :page="page"
                        :rotate="rotate"
                        @password="password"
                        @progress="loadedRatio = $event"
                        @error="error"
                        @num-pages="numPages = $event"
                        @link-clicked="page = $event"
                    ></pdf>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import addfile from "./add_file_product";
import pdf from "vue-pdf";
export default {
    data() {
        return {
            facture: {},
            piece: "",
            code_facture: "",
            title: "",
            date: "",
            fournisseur_id: "",
            description: "",
            Fournisseur: "",
            piece_d: "",
            show: true,
            pdfList: [
                "",
                "/fiche_mouvement/3.pdf",
                "storage/Bon_de_commande/23.pdf",
                "https://cdn.rawgit.com/mozilla/pdf.js/c6e8ca86/test/pdfs/annotation-link-text-popup.pdf",
                "https://cdn.rawgit.com/mozilla/pdf.js/c6e8ca86/test/pdfs/calrgb.pdf",
                "https://cdn.rawgit.com/sayanee/angularjs-pdf/68066e85/example/pdf/relativity.protected.pdf",
                "data:application/pdf;base64,JVBERi0xLjUKJbXtrvsKMyAwIG9iago8PCAvTGVuZ3RoIDQgMCBSCiAgIC9GaWx0ZXIgL0ZsYXRlRGVjb2RlCj4+CnN0cmVhbQp4nE2NuwoCQQxF+/mK+wMbk5lkHl+wIFislmIhPhYEi10Lf9/MVgZCAufmZAkMppJ6+ZLUuFWsM3ZXxvzpFNaMYjEriqpCtbZSBOsDzw0zjqPHZYtTrEmz4eto7/0K54t7GfegOGCBbBdDH3+y2zsMsVERc9SoRkXORqKGJupS6/9OmMIUfgypJL4KZW5kc3RyZWFtCmVuZG9iago0IDAgb2JqCiAgIDEzOAplbmRvYmoKMiAwIG9iago8PAogICAvRXh0R1N0YXRlIDw8CiAgICAgIC9hMCA8PCAvQ0EgMC42MTE5ODcgL2NhIDAuNjExOTg3ID4+CiAgICAgIC9hMSA8PCAvQ0EgMSAvY2EgMSA+PgogICA+Pgo+PgplbmRvYmoKNSAwIG9iago8PCAvVHlwZSAvUGFnZQogICAvUGFyZW50IDEgMCBSCiAgIC9NZWRpYUJveCBbIDAgMCA1OTUuMjc1NTc0IDg0MS44ODk3NzEgXQogICAvQ29udGVudHMgMyAwIFIKICAgL0dyb3VwIDw8CiAgICAgIC9UeXBlIC9Hcm91cAogICAgICAvUyAvVHJhbnNwYXJlbmN5CiAgICAgIC9DUyAvRGV2aWNlUkdCCiAgID4+CiAgIC9SZXNvdXJjZXMgMiAwIFIKPj4KZW5kb2JqCjEgMCBvYmoKPDwgL1R5cGUgL1BhZ2VzCiAgIC9LaWRzIFsgNSAwIFIgXQogICAvQ291bnQgMQo+PgplbmRvYmoKNiAwIG9iago8PCAvQ3JlYXRvciAoY2Fpcm8gMS4xMS4yIChodHRwOi8vY2Fpcm9ncmFwaGljcy5vcmcpKQogICAvUHJvZHVjZXIgKGNhaXJvIDEuMTEuMiAoaHR0cDovL2NhaXJvZ3JhcGhpY3Mub3JnKSkKPj4KZW5kb2JqCjcgMCBvYmoKPDwgL1R5cGUgL0NhdGFsb2cKICAgL1BhZ2VzIDEgMCBSCj4+CmVuZG9iagp4cmVmCjAgOAowMDAwMDAwMDAwIDY1NTM1IGYgCjAwMDAwMDA1ODAgMDAwMDAgbiAKMDAwMDAwMDI1MiAwMDAwMCBuIAowMDAwMDAwMDE1IDAwMDAwIG4gCjAwMDAwMDAyMzAgMDAwMDAgbiAKMDAwMDAwMDM2NiAwMDAwMCBuIAowMDAwMDAwNjQ1IDAwMDAwIG4gCjAwMDAwMDA3NzIgMDAwMDAgbiAKdHJhaWxlcgo8PCAvU2l6ZSA4CiAgIC9Sb290IDcgMCBSCiAgIC9JbmZvIDYgMCBSCj4+CnN0YXJ0eHJlZgo4MjQKJSVFT0YK"
            ],
            src: "",
            loadedRatio: 0,
            page: 1,
            numPages: 0,
            rotate: 0
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

        supprime(){



  axios.delete('/api/facture/deletefile/'+this.$route.params.id, {
     params: {
         src:this.src
       
     }
 })
  .then(response=> {
  })
  .catch(error=> {
  })
        },

        refresh() {
            this.getFournisseur();
            this.getFacture();
        },

        getFacture() {
            axios
                .get(`/api/facture/show/${this.$route.params.id}`)
                .then(response => {
                    console.log(response);
                    this.facture = response.data;
                    this.code_facture = this.facture.facture_code;
                    this.date = this.facture.date;
                    this.title = this.facture.fournisseur.title;
                    this.description = this.facture.description;
                    this.fournisseur_id = this.facture.fournisseur.id;
                    this.piece = "/" + this.facture.piece_depence;
                })
                .catch(error => {
                    console.log(error);
                });
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

        ondepencechange(event) {
            console.log(event.target.files[0]);
            this.piece_d = event.target.files[0];
        },

        password: function(updatePassword, reason) {
            updatePassword(prompt('password is "test"'));
        },
        error: function(err) {
            console.log(err);
        }
    },

    components: {
        pdf: pdf,
        addfile: addfile
    },

    created() {
        // alert("qsdqsdqs");
        this.getFournisseur();
        this.getFacture();
    }

    /*   mounted() {
        // alert("qsdqsdqs");
        this.getFournisseur();
        this.getFacture();
    },
    */
};
</script>
