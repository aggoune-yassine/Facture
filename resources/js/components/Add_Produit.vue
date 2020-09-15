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



                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label
                                    class="input-group-text"
                                    for="inputGroupSelect01"
                                    >Quantité</label
                                >
                            </div>
                           <input
                                type="number"
                                class="form-control"
                                aria-label="Amount (to the nearest dollar)"
                                v-model="qty"
                            />
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
                            Save changes
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
            date: "",
            code_budget:'',
            description: "",
          
            qty: "1",
            unit_price: "00",
            id_facture: this.$route.params.id,
            budgets:'',
           
            
        };
    },
    computed: {
        total: function() {
            return this.qty * this.unit_price;
        }
    },

    methods: {
        addpruduct(){
            axios.post('/api/produit', {
            date:this.date,
            code_budget:this.code_budget,
            description:this.description,
           
            qty:this.qty,
            unit_price: this.unit_price,
            id_facture: this.$route.params.id,
            
            })
            .then(response=> {
                console.log('information'+response.data.facture);
            this.$emit('add-prod',response.data);
            this.date_achat="";
            this.description="",
           
            this.qty="",
            this.unit_price="",
            this.id_facture=""
            })
            .catch(error=> {
                console.log(error);
            })
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
    },

       created() {
             // alert("qsdqsdqs");
             this.getBudget();
            
            
        },


};
</script>
