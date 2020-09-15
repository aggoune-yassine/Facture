<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                <add-facture  @add-fac='refresh'>
                </add-facture> 
                    <div class="card-header">Liste des factures</div>

                    <div class="card-body">
                        <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Code facture</th>
      <th scope="col">Description</th>
      <th scope="col">date</th>
    </tr>
  </thead>
  <tbody>
  
    <tr v-for="(facture,index) in factures.data "  v-bind:key="index">
      <th scope="row"></th>
      <td>{{facture.facture_code}}</td>
      <td>{{facture.description}}</td>
      <td>{{facture.date}}</td>
    </tr>
    
  </tbody>
</table>
     </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {


        data(){

            return {
                factures:'',
            }
        },

     
        
       


        methods: {
            getfacture(){
                axios.get('api/facture')
                .then( response=> {

                    console.log(response);
                    this.factures=response.data;

                })
                .catch(error=> {
                    console.log(error);
                })
            },

            refresh(facture){

              
                this.factures=facture;

            }

            
        },

           created() {
             this.getfacture();
            
        },

    }
</script>

