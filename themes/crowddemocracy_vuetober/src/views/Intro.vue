<template>
  <div class="wrap">
    <b-container fluid class="content-wrap">
      <Navbar></Navbar>
      <b-row>
        <b-col lg="6">
          <b-row>
            <b-col lg="12">
              <h4 class="header">Ako využijete svoj hlas?</h4>
            </b-col>
            <b-col class="content">
              <h5 class="intro mt-5">
                Na
                <span class="intro-text">CROWD</span>DEMOCRACY
                môžete dať svoj hlas novým návrhom alebo ho
                odovzdať ľudom, ktorým dôverujete.
              </h5>

              <b-button class="login mt-5" to="/login">Prihlásiť sa</b-button>
            </b-col>
          </b-row>
        </b-col>
        <b-col>
          <img class="background" src="../assets/bg.png" />
        </b-col>
      </b-row>
      <Footer></Footer>
    </b-container>
  </div>
</template>
<script>
import Navbar from "../components/Navbar.vue";
import Footer from "../components/Footer";

export default {
  created() {
    if (this.$store.getters.isLoggedIn) this.$router.push("/home");
  },
  components: {
    Footer,
    Navbar
  }
};
</script>
<style lang="css" scoped>
.wrap {
  height: calc(100vh - 63px);
  margin: 0px;
  /* position: absolute; */
}
.p,
h4 {
  color: #48486e;
}
.registration {
  border-color: #48486e;
  color: #48486e;
  background-color: white;
  width: 140px;
  font-weight: bold;
  font-size: 14px;
  margin-top: 5px;
  float: right;
}
.intro {
  width: 500px;
  font-weight: 50;
  margin-left: 100px;
  text-align: center;
}
.intro-text {
  font-weight: bold;
}
.button {
  width: 500px;
}
.login {
  background-color: #24154b;
  color: white;
  width: 215px;
  height: 60px;
  margin-left: 115px;
  line-height: 43px;
  font-weight: bold;
}

.content-wrap {
  position: relative;
  min-height: 100%;
}
@media only screen and (max-width: 990px) {
  /*Content*/
  .content {
    margin: 0px;
    text-align: center;
  }
  .login {
    margin: 0px;
    margin-top: 3em;
  }
  .intro {
    margin: 0px;
    width: 100%;
    margin-top: 4em;
  }
}
@media only screen and (max-width: 400px) {
  .footer {
    bottom: -10%;
  }
  .registration {
    font-size: 0.7em;
  }
}
</style>

