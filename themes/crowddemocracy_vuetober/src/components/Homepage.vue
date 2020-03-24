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
        <p class="com-desc">{{communitie.description}}</p>
        <p class="com-create">{{communitie.created_at}}</p>
        <p class="com-moderators">IN DEVELOPMENT</p>
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
        path: `/community/${index + 1}` //Datebase table starts at 1
      });
    }
  }
};
</script>
<style scoped>
.wrap {
  background-color: #d6dbe0;
  height: 100vh;
}
.list {
  width: 150px;
}
.communitie {
  height: 250px;
  width: 250px;
  justify-content: space-evenly;
  background-color: white;
  border-radius: 15px;
  cursor: pointer;
}
.com-name {
  text-align: center;
  font-size: 15px;
  font-weight: bold;
}
.com-count {
  text-align: center;
  font-size: 11px;
}
</style>