<template>
  <div>
    <div class="container mt-5">
      <div class="row my-5">
        <div class="col-md-12">
          <div class="card mt-4">
            <div class="card-header">
              Produit Details 333333
              <strong></strong>
              <span class="float-right">
                <strong>Etat mouvement produit :</strong>
                0</span
              >
            </div>

            <form @submit="addfacture" enctype="multipart/form-data">
              <div class="card-body">
                <h5 class="card-title">Code Produit</h5>
                <p class="card-text">code .</p>
                <p class="card-text">
                  <small class="text-muted">Last updated 3 mins ago</small>
                </p>
              </div>

              <div class="card-body">
                <h5 class="card-title">Code Produit</h5>
                <p class="card-text">code .</p>
                <p class="card-text">
                  <small class="text-muted">Last updated 3 mins agoooo</small>
                </p>
              </div>
            </form>
            <button
              type="button"
              class="btn btn-primary"
              data-toggle="modal"
              data-target="#affproduit"
            >
              Affecter Produit
            </button>
          </div>
        </div>
      </div>
    </div>
    <affProduit />
  </div>
</template>


 <script>
import affProduit from "./Aff_Produit.vue";
export default {
  data() {
    return {
      produit: {},
      p: "",
    };
  },

  created() {
    this.getProduit();
  },

  methods: {
    getProduit() {
      axios
        .get(`/api/produit/${this.$route.params.id}`)
        .then((response) => {
          console.log(response);
          this.produit = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },

  components: {
    affProduit,
  },
};
</script>

