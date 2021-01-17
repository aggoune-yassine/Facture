<template>
    <div>
        <div class="container mt-4">
            <div class="row my-5">
                <div class="col-md-12 mt-4">
                    <div class="card">
                        <div class="card-header text-center">
                            <h5 class="card-title">Budget</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-dark">
                                <thead>
                                    <tr>
                                        <th scope="col">id</th>
                                        <th scope="col">code</th>
                                        <th scope="col">Ligne Budgetaire</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Montant initial</th>

                                        <th scope="col">Montant restant</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr   v-for="(budget, index) in Budget.data"
                                          
                                            v-bind:key="index">
                                        <th scope="row">{{index}}</th>
                                        <th scope="row">{{budget.code}}</th>
                                        <th scope="row">{{budget.ligne_budgetaire}}</th>
                                        <th scope="row">{{budget.date}}</th>
                                        <th scope="row">{{budget.montant_initial}}DA</th>

                                        <th scope="row">{{budget.montant}}DA</th>
                                        
                                       
                                    </tr>
                                </tbody>
                            </table>
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
            Budget:''
        }
    },

    methods: {
        getBudget(){

            axios.get('api/budget'
            )
            .then(response=> {
                console.log(response.data);
                this.Budget=response.data;
            })
            .catch(error=> {
                console.log(error);
            })

        },
        
    },

    created() {
        this.getBudget();
    },
};


</script>
