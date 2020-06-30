<template>
  <b-row class="navbar">
    <b-col>
      <img class="logo ml-3" src="../assets/logo.png" />
    </b-col>
    <b-col>
      <b-button class="registration" to="/registration">Registruj sa</b-button>
      <p class="question">Ešte nemáš účet?</p>
    </b-col>
  </b-row>
</template>
<script>
export default {
  methods: {
    logout() {
      this.$store.dispatch("logout").then(() => {
        this.$router.push("/");
      });
    }
  }
};
</script>
<style lang="css" scoped>
.logo {
  width: 140px;
}
.question {
  padding: 0px;
  font-size: 14px;
  float: right;
  margin-top: 0.73em;
  margin-right: 1em;
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
.navbar {
  margin: 0;
}
@media only screen and (max-width: 990px) {
  /*Navigation*/
  .question {
    display: none;
  }
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
}
</style>
