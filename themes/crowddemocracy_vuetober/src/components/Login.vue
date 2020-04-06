<template>
  <div class="wrap">
    <b-row class="navbar">
      <b-col class="logo">logo</b-col>
      <b-col class="question">Ešte nemáš účet?</b-col>
      <b-col class="button">
        <b-button class="registration" to="/registration">Registruj sa</b-button>
      </b-col>
    </b-row>
    <h1>Prihlásenie</h1>
    <form class="login" @submit.prevent="login">
      <input type="text" placeholder="Prezývka / Email" v-model="email" />
      <input type="password" placeholder="Heslo" v-model="password" />
      <b-button type="submit">Prihlásiť</b-button>
    </form>
  </div>
</template>
<script>
export default {
  data() {
    return {
      email: "",
      password: ""
    };
  },
  created() {
    if (this.$store.getters.isLoggedIn) this.$router.push("/home");
  },
  methods: {
    login() {
      let email = this.email;
      let password = this.password;
      this.$store
        .dispatch("login", { email, password })
        .then(() => this.$router.push("/home"))
        .catch(err => console.log(err));
    }
  }
};
</script>
<style scoped>
.form input {
  display: block;
}
.login_text {
  display: inline;
}

.login {
  border-color: #330066;
  color: #330066;
  background-color: white;
  width: 140px;
  font-weight: bold;
  font-size: 14px;
  margin-top: 5px;
}

.button {
  width: 500px;
  margin-left: 0px;
}
.logo {
  width: 500px;
  color: white;
}
.check {
  display: flex;
  margin-top: 30px;
}
.check-text {
  margin: 0px;
}
.question {
  width: 500px;
  margin-left: 700px;
  padding: 0px;
  font-size: 14px;
  text-align: right;
  margin-top: 4px;
  color: #330066;
}
.title {
  margin-top: 150px;
  margin-left: 130px;
  font-size: 55px;
  font-weight: 50;
}
.form {
  margin-left: 130px;
  margin-top: 25px;
  color: black;
}
.form input {
  width: 500px;
  margin-top: 15px;
  height: 50px;
  border: none;
  color: black;
  border-bottom: 1px solid #d7d7c1;
}
.form input:focus {
  outline: none;
}
.form .checkbox {
  width: auto;
  margin: 0;
  height: auto;
}
.registration {
  background-color: #330066;
  color: white;
  width: 215px;
  height: 60px;
  margin-top: 20px;
  line-height: 43px;
}
.footer {
  margin-top: 180px;
}
.footer-col1 {
  font-size: 14px;
  color: #330066;
  margin-left: 40px;
  white-space: nowrap;
}
.footer-col2 {
  font-size: 14px;
  color: #330066;
  margin-left: 115px;
  text-align: right;
}
.footer-col3 {
  color: white;
}
.footer-logo {
  font-weight: 900;
}
</style>
