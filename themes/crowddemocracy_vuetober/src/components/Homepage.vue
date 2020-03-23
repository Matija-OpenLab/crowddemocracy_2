<template>
  <div class="wrap">
    <b-row>
      <b-col cols="6" class="list">
        <div class="tops">
          <p>Zoznam komunít, kde si členom</p>
          <div class="names" v-for="(communitie, index) in communities" :key="index">
            <h4>{{communitie.name}}</h4>
          </div>
        </div>
      </b-col>
      <b-col>
        <b-button :to="'/'" variant="danger">Odhlásiť sa</b-button>
        <h1>Crowddemocracy</h1>
        <b-row>
          <b-col>
            <div class="communities" v-for="(communitie, index) in communities" :key="index">
              <!--TENTO DIV JE CELA KOMUNITA-->
              <div class="communitie" @click="redirectToComm(index)">
                <p class="com-count">{{communitie.user_count}}</p>
                <p class="com-name">{{communitie.name}}</p>
                <p class="com-owner">{{communitie.owner}}</p>
              </div>
            </div>
          </b-col>
          <b-col>2 of 3</b-col>
          <b-col>3 of 3</b-col>
        </b-row>
      </b-col>
    </b-row>
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
        path: `/communityInfo/:${index}`
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