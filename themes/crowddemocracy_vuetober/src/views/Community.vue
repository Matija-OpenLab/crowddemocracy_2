<template>
  <div class="community">
    <NavbarPhones></NavbarPhones>
    <Community></Community>
  </div>
</template>

<script>
import NavbarPhones from "../components/NavbarPhones.vue";
import Community from "../components/Community.vue";

export default {
  name: "Community",
  components: {
    NavbarPhones,
    Community
  }
};
</script>
