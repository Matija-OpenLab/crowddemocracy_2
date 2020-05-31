<template>
  <div class="wrap">
    <h1>This page is protected by auth</h1>
    <b-button class="link-button" to="/">BACK TO MAIN SCREEN</b-button>
  </div>
</template>
<script>
export default {
  created() {
    this.refreshUser();
  },
  methods: {
    refreshUser() {
      this.$store
        .dispatch("refresh")
        .then(() => {})
        .catch(err => {
          console.error(err);
        });
    }
  }
};
</script>
<style lang="css" scoped>
.wrap {
  text-align: center;
}
</style>