<template>
  <div class="community">
    <Community :id="id"></Community>
  </div>
</template>

<script>
import Community from "../components/Community.vue";

export default {
  props: {
    id: {
      type: String
    }
  },
  name: "Communitypage",
  components: {
    Community
  },
  methods: {
    getId() {
      return this.$props.id;
    }
  }
};
</script>
