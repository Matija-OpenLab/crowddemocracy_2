<template>
  <div class="intro">
    <Navbar></Navbar>
    <Intro></Intro>
  </div>
</template>

<script>
/*eslint-disable*/

import Navbar from "../components/Navbar.vue";
import Intro from "../components/Intro.vue";

export default {
  name: "Intropage",
  components: {
    Navbar,
    Intro
  }
};
</script>
<style lang="css" scoped>
.intro {
  position: absolute;
}
</style>
