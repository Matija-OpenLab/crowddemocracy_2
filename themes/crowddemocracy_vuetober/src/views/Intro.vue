<template>
  <div class="a-intro">
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
                <span class="z-bold">CROWD</span>DEMOCRACY
                môžete dať svoj hlas novým návrhom alebo ho
                odovzdať ľudom, ktorým dôverujete.
              </h5>

              <b-button class="login mt-5 z-bold" to="/login">Prihlásiť sa</b-button>
            </b-col>
          </b-row>
        </b-col>
        <b-col>
          <img class="z-background" src="../assets/bg.png" />
        </b-col>
      </b-row>
      <Footer></Footer>
    </b-container>
  </div>
</template>
<script>
import Navbar from "../components/a-navbar.vue";
import Footer from "../components/a-footer.vue";

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
<style lang="scss" scoped>
.a-intro {
  height: calc(100vh - 63px);
  margin: 0px;

  .content-wrap {
    position: relative;
    min-height: 100%;
  }
  .p,
  h4 {
    color: #48486e;
  }
  .intro {
    width: 500px;
    font-weight: 50;
    margin-left: 100px;
    text-align: center;
  }
  .login {
    background-color: #24154b;
    color: white;
    width: 215px;
    height: 60px;
    margin-left: 115px;
    line-height: 43px;
  }
}

@media only screen and (max-width: 990px) {
  .a-intro {
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

