<template>
  <div class="registration">
    <Registration></Registration>
    <Footer></Footer>
  </div>
</template>

<script>
// @ is an alias to /src

import Registration from "../components/Registration.vue";
import Footer from "../components/Footer.vue";
export default {
  name: "Registrationpage",
  components: {
    Footer,
    Registration
  }
};
</script>
