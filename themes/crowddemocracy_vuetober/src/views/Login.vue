<template>
  <div class="login">
    <Navbar></Navbar>
    <Footer></Footer>
  </div>
</template>

<script>
// @ is an alias to /src
import Footer from "../components/Footer.vue"
import Navbar from "../components/Navbar.vue"

export default {
  components:{
    Footer,
    Navbar
  },
  name: "Login"
};
</script>
