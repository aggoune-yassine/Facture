<template>
    <div>
        <div class="container ">
            <div class="row my-5">
                <div class="col-md-12">
                   
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">code produit</th>
                                 <th scope="col">description</th>

                                <th scope="col"> Prix </th>
                                <th scope="col">Date achat</th>
                                <th scope="col">Date Facture</th>
                                <th scope="col">Ajoutée par</th>
                                <th scope="col">Ajoutée depuis</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                         <tbody>

                       
                           

                          
                            
                             
                              <tr  v-for="(p,index) in produits.data" v-bind:key="index" >
                           
                               <th scope="row"> <router-link :to="'Produit/'+p.id ">{{p.id}}</router-link> </th>
                               <td >{{index}}</td>
                                <td >{{p.code}}</td>
                                <td >{{p.description}}</td>
                                <td >{{p.unit_price}}</td>
                                <td >{{p.description}}</td>
                                <td >{{p.date_achat}}</td>
                                <td >{{p.created}}</td>
                                <td >{{p.created}}</td>
                                <td >{{p.date_achat}}</td>
                             
                              </tr>
                          
                                

                      
                         
                            
                        </tbody>
                    </table>
                  
                   

                      <div class="card-footer d-flex justify-content-center">
                         <pagination :data="produits" @pagination-change-page="getproduit"></pagination>
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
          
            produits:{}
        };
    },

    methods: {
   
          getproduit(page) {
               if(typeof page === 'undefined'){
                    page = 1;
                }
            axios
                .get("api/produit?page="+page)
                .then(response => {
                    console.log(response);
                    this.produits = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },


        
    
    },

   


    created() {
      
        this.getproduit();
    }
};
</script>
