<template>
  <div class="wrap">
    <h1>Crowddemocracy</h1>
    <b-button :to="'/'" variant="danger">Odhlásiť sa</b-button>
    <div class="communities" v-for="(communitie, index) in communities" :key="index">
      <!--TENTO DIV JE CELA KOMUNITA-->
      <div class="communitie" @click="redirectToComm(index)">
        <p class="com-name">{{communitie.name}}</p>
        <p class="com-count">{{communitie.user_count}}</p>
        <p class="com-owner">{{communitie.owner}}</p>
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
  },
  methods: {
    redirectToComm(index) {
      this.$router.push({
        path: `/communityInfo/${index + 1}` //Datebase table starts at 1
      });
    }
  }
};
</script>
<style scoped>
.wrap {
  background-color: lightgray;
  height: 100vh;
}
.communitie {
  display: flex;
  justify-content: space-evenly;
  background-color: white;
  border: 1px solid black;
  cursor: pointer;
}
</style>