<template>
  <div class="wrap">
    <div class="content-wrap">
      <b-row>
        <b-col lg="6">
          <b-row>
            <b-col lg="12">
              <h4 class="header">Ako využijete svoj hlas?</h4>
            </b-col>
            <b-col class="content">
              <h5 class="intro">
                Na
                <span class="intro-text">CROWD</span>DEMOCRACY
                môžete dať svoj hlas novým návrhom alebo ho
                odovzdať ľudom, ktorým dôverujete.
              </h5>

              <b-button class="login" to="/login">Prihlásiť sa</b-button>
            </b-col>
          </b-row>
        </b-col>
        <b-col>
          <img class="background" src="../assets/bg.png" />
        </b-col>
      </b-row>
    </div> 
    <h5>Hello</h5>
  </div> 
</template>
<script>
export default {
  created() {
    if (this.$store.getters.isLoggedIn) this.$router.push("/home");
}
};
</script>
<style lang="css" scoped>
.wrap {
  height: 100vh;
  margin: 0px;
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
  margin-top: 50px;
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
  margin-top: 40px;
  margin-left: 115px;
  line-height: 43px;
  font-weight: bold;
}

.content-wrap {
  position: relative;
  min-height: 100%;
}
@media only screen and (max-width: 990px) {
  /*Navigation*/
  .registration {
    border-color: #48486e;
    color: #48486e;
    background-color: white;
    width: 10em;
    padding: 1em;
    font-weight: bold;
  }
  .logo {
    width: 7em;
    margin-left: 0px;
  }
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
