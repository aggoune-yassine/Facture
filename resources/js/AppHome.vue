<template>
    <div>
        <Navbar></Navbar>
        <router-view></router-view>
    </div>
</template>


<script>
import Navbar from'./NavBar.vue'

export default {

    components :{
        Navbar
    }
    
}
</script>