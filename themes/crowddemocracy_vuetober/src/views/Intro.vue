<template>
  <div class="intro">
    <Navbar></Navbar>
    <Intro></Intro>
    <Footer></Footer>
  </div>
</template>

<script>
/*eslint-disable*/ 
import Navbar from "../components/Navbar.vue";
import Footer from "../components/Footer.vue";
import Intro from "../components/Intro.vue";

export default {
  name: "Intropage",
  components: {
    Navbar,
    Intro,
    Footer
  }
};
</script>
