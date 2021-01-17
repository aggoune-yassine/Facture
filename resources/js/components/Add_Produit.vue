<template>
    <div>
        <!-- Button trigger modal -->
       

        <!-- Modal -->
        <div
            class="modal fade"
            id="addproduit"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Ajouter Produit
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


                           <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"
                                    >Code produit </span
                                >
                            </div>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Produit"
                                aria-label="Produit"
                                aria-describedby="basic-addon1"
                                v-model="code"
                            />
                        </div>
                          <div
                                v-if="allerros.code"
                                class="alert alert-danger"
                                role="alert"
                            >
                                {{ allerros.code[0] }}
                            </div>


                            
                     
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"
                                    >Libelé produit</span
                                >
                            </div>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Produit"
                                aria-label="Produit"
                                aria-describedby="basic-addon1"
                                v-model="description"
                            />
                        </div>

                        <div
                                v-if="allerros.description"
                                class="alert alert-danger"
                                role="alert"
                            >
                                {{ allerros.description[0] }}
                            </div>

                        <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span
                                        class="input-group-text"
                                        id="basic-addon1"
                                        >Type</span
                                    >
                                </div>

                                <select
                                    class="custom-select"
                                    id="inputGroupSelect01"
                                    v-model="type_id"
                                >
                                    <option
                                        v-for="(T, index) in type"
                                        :value="T.id"
                                        v-bind:key="index"
                                    >
                                        {{ T.designation }}
                                    </option>
                                </select>
                            </div>

                            <div
                                v-if="allerros.materiel_id"
                                class="alert alert-danger"
                                role="alert"
                            >
                                {{ allerros.materiel_id[0] }}
                            </div>

                 

                              <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label
                                    class="input-group-text"
                                    for="inputGroupSelect01"
                                    >Annee d'exercice</label
                                >
                            </div>
                            <select
                                class="custom-select"
                                id="inputGroupSelect01"
                                v-model="date"
                            >
                              
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                            </select>
                        </div>
                           <div
                                v-if="allerros.date"
                                class="alert alert-danger"
                                role="alert"
                            >
                                {{ allerros.date[0] }}
                            </div>


                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"
                                    >Ligne Bdgetaire</span
                                >
                            </div>

             <select
                                class="custom-select"
                                id="inputGroupSelect01"
                                v-model='code_budget'
                               
                            >
                              
                               
                                 <option  v-for="(budget ,index) in budgets.data " :value="budget.id" v-bind:key="index" >
      {{ budget.ligne_budgetaire}}
    </option>
                             
                            </select>
                        </div>
                          <div
                                v-if="allerros.budget_id"
                                class="alert alert-danger"
                                role="alert"
                            >
                                {{ allerros.budget_id[0] }}
                            </div>



               

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">dz</span>
                            </div>
                            <input
                                type="text"
                                class="form-control"
                                aria-label="Amount (to the nearest dollar)"
                                v-model="unit_price"
                            />
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                        

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label
                                    class="input-group-text"
                                    for="inputGroupSelect01"
                                    >Prix total</label
                                >
                            </div>
                            

                            <div class="input-group-append">
                                <span class="input-group-text">{{
                                    total
                                }}</span>
                            </div>
                            <div class="input-group-prepend">
                                <span class="input-group-text">DA</span>
                            </div>
                        </div>
                           <div
                                v-if="allerros.unit_price"
                                class="alert alert-danger"
                                role="alert"
                            >
                                {{ allerros.unit_price[0] }}
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
                        <button type="button" class="btn btn-primary" @click="addpruduct">
                            Save 
                        </button>
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
            code:"",
            date: "",
            code_budget:'',
            description: "",
        
            unit_price: "00",
            id_facture: this.$route.params.id,
            budgets:'',
            allerros: [],
            type:'',
            type_id:'',
            outofrange:'',
           
            
        };
    },
    computed: {
        total: function() {
            return  this.unit_price;
        }
    },

    methods: {
        addpruduct(){
            axios.post('/api/produit', {
            date:this.date,
            code:this.code,
            budget_id:this.code_budget,
            description:this.description,
      
            unit_price: this.unit_price,
            id_facture: this.$route.params.id,
            materiel_id:this.type_id,
            
            })
            .then(response=> {
               // console.log('information'+response.data.facture);
            this.$emit('add-prod',response.data);
            this.date="";
            this.description="",
            this.code_budget="",
           
           
            this.unit_price="",
            this.id_facture=""
            })
             .catch(error => {
                    this.allerros = error.response.data.errors;
                    this.outofrange = error.response.data.exception;
   if(this.outofrange=="Illuminate\\Database\\QueryException")
   { 
                  Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'Something went wrong ! THE Budget is insufficient',
  footer: '<a href>Why do I have this issue?</a>'
})

   }
                   // this.$emit("add-fac");
                   // $("#addFacture").modal("hide");
                 
                  
                });
        },

  getBudget(){
                axios.get('/api/budget')
                .then( response=> {

                    console.log(response);
                    this.budgets=response.data;

                })
                .catch(error=> {
                    console.log(error);
                })
            },

              getTypemateriel() {
            axios
                .get("/api/materiel")
                .then(response => {
                    console.log(response.data);
                    this.type = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
    },

       created() {
             // alert("qsdqsdqs");
             this.getBudget();
             this.getTypemateriel();
            
            
        },


};
</script>
