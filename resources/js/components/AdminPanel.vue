<template>
    <div>
        <div class="container ">
            <div class="row my-5">
                <div class="col-md-12">
             


             
                    <div class="row mt-3">
                        <div class="col">
                            <a
                                href="#"
                                data-toggle="modal"
                                data-target="#addFacture"
                                class="btn mt-5 btn-sm btn-success text-white mb-2"
                            >
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group ">
                                <label for="">Recherche facture</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name=""
                                    id=""
                                    v-model="q"
                                    @keyup="searchfacture"
                                    aria-describedby="helpId"
                                    placeholder="code facture"
                                />
                            </div>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Code facture</th>
                                <th scope="col">Description</th>
                                <th scope="col">Date Facture</th>
                                <th scope="col">Ajoutée par</th>
                                <th scope="col">Ajoutée depuis</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(facture, index) in factures.data"
                                v-bind:key="index"
                            >
                                <th scope="row">
                                    <router-link
                                        :to="'facture/' + facture.id"
                                        >{{ index }}</router-link
                                    >
                                </th>
                                <td>{{ facture.facture_code }}</td>
                                <td>{{ facture.description }}</td>
                                <td>{{ facture.date }}</td>
                                <td>{{ facture.user.name }}</td>
                                <td>{{ facture.created }}</td>

                                <td>
                                    <router-link
                                        :to="{
                                            path:
                                                'facture/edit/' +
                                               facture.id
                                        }"
                                        class="btn mr-1 btn-sm btn-primary"
                                    >
                                        <div class="fa fa-eye"></div>
                                    </router-link>

                                    <router-link
                                        :to="{
                                            path: 'facture/Mod/' + facture.id
                                        }"
                                        class="btn mr-1 btn-sm btn-warning"
                                    >
                                        <div class="fa fa-edit"></div>
                                    </router-link>

                                    <a
                                        @click="supprimerfacture(facture.id)"
                                        class="btn  btn-sm btn-danger text-white "
                                    >
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="card-footer d-flex justify-content-center">
                        <pagination
                            :data="factures"
                            @pagination-change-page="getfacture"
                        ></pagination>
                    </div>
                </div>
            </div>
            <addfacture @add-fac="refresh()" />
        </div>
    </div>
</template>

<script>
import addfacture from "./Add_Facture.vue";
export default {
    data() {
        return {
            factures: {},
            q: "",
           
        };
    },

    methods: {
        searchfacture() {
         //   if (this.q.length > 3) {
                axios
                    .get("api/facture/"+this.q)
                    .then(response => {
                        console.log(response);
                        this.factures= response.data;


                    })
                    .catch(error => {
                        console.log(error);
                    });
          //  }
        },

        getfacture(page) {
            if (typeof page === "undefined") {
                page = 1;
            }
            axios
                .get("api/facture?page=" + page)
                .then(response => {
                    console.log(response);
                    this.factures = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },

        refresh() {
            this.getfacture();
        },
        supprimerfacture(facture) {
            Swal.fire({
                position: "center ",
                icon: "warning",
                title: "Voulez vous supprimer la facture?",
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonText: "oui",
                confirmButtonColor: "#3085D6",
                cancelButtonText: "Annulé",
                cancelButtonColor: "#d33"
            }).then(result => {
                if (result.value) {
                    axios
                        .delete(`api/facture/${facture}`)
                        .then(response => {

                            

                            if(response.data.message)

                            {  

                            Swal.fire({
                                position: "center ",
                                icon: "success",
                                title: "Facture Supprimée",
                                showConfirmButton: false,
                                timer: 1500
                            });

                            }

                            else

                            {
                                 Swal.fire({
                                position: "center ",
                                icon: "success",
                                title: "Facture non Supprimée . Elle contient des produits",
                                showConfirmButton: false,
                                timer: 2500
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

    components: {
        addfacture
    },
    created() {
        this.getfacture();
    }
};
</script>
