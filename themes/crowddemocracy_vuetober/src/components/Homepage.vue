<template>
  <div class="wrap">
    <h1>Crowddemocracy</h1>
    <b-button :to="'/'" variant="danger">Odhlásiť sa</b-button>
    <div class="communities" v-for="(communitie, index) in communities" :key="index">
      <div class="communitie">
        <h1>{{communitie.name}}</h1>
        <p>{{communitie.description}}</p>
      </div>
    </div>
    <div class="tops">
      <h2>Top Komunity</h2>
      <div class="names" v-for="(communitie, index) in communities" :key="index">
        <h4>{{communitie.name}}</h4>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      communities: null
    };
  },
  mounted() {
    fetch("http://crowddemocracy.test/api/communities")
      .then(res => res.json())
      .then(json => {
        this.communities = json.data;
      });
  }
};
</script>
<style scoped>
.wrap {
  background-color: lightgray;
  height: 100vh;
}
</style>