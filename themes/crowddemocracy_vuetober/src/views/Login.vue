<template>
  <div class="login">
    <Navbar></Navbar>
    <Login></Login>
    <Footer></Footer>
  </div>
</template>

<script>
// @ is an alias to /src
import Footer from "../components/Footer.vue";
import Navbar from "../components/Navbar.vue";
import Login from "../components/Login.vue";

export default {
  name: "Loginpage",
  components: {
    Footer,
    Login,
    Navbar
  },
 
};
</script>
