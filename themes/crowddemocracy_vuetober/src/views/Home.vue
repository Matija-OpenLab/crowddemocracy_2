<template>
  <div class="home">
    <NavbarPhones></NavbarPhones>
    <Homepage></Homepage>
  </div>
</template>

<script>
import NavbarPhones from "../components/NavbarPhones.vue";
import Homepage from "../components/Homepage.vue";

export default {
  name: "Home",
  components: {
    NavbarPhones,
    Homepage
  }
};
</script>
