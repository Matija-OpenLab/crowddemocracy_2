<template>
  <div class="community">
     
    <NavbarPhones></NavbarPhones>
    <Community :id="id"></Community>
  </div>
</template>

<script>
import NavbarPhones from "../components/NavbarPhones.vue";
import Community from "../components/Community.vue";

export default {
  props:{
    id:{
      type: String
    }
  },
  name: "Communitypage",
  components: {
    NavbarPhones,
    Community
  },
  methods:{
    getId(){
      return this.$props.id;
    }
  }
};
</script>
