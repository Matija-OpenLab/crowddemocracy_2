<template>
  <div class="wrap">
    <img class="background" src="../assets-dominika/bg.png" />
    <b-row class="navbar">
      <b-col>
        <img class="logo" src="../assets-dominika/logo.png" />
      </b-col>
      <b-col class="question">Ešte nemáš účet?</b-col>
      <b-col class="button">
        <b-button class="registration" to="/registration">Registruj sa</b-button>
      </b-col>
    </b-row>
    <h1 class="title">Prihlásenie</h1>
    <form class="form" @submit.prevent="login">
      <input type="text" placeholder="Prezývka / Email" v-model="email" />
      <input type="password" placeholder="Heslo" v-model="password" />
      <span class="error">{{error}}</span>
      <b-button class="login" type="submit">Prihlásiť</b-button>
    </form>
    <b-row class="footer">
      <b-col class="footer-col1">
        &reg; 2020 všetky práva vyhradené
        <span class="footer-logo">CROWD</span>DEMOCRACY
      </b-col>
      <b-col class="footer-col2">Sledujte nás na sociálnych sieťach</b-col>
      <b-col class="footer-col3">social media</b-col>
    </b-row>
  </div>
</template>
<script>
export default {
  data() {
    return {
      email: "",
      password: "",
      error: ""
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
        .catch(() => {
          this.error = "Invalid credencials";
        });
    }
  }
};
</script>
<style scoped>
.error {
  display: block;
  color: red;
  font-size: 20px;
  margin-top: 1em;
}
.form input {
  display: block;
}
.login_text {
  display: inline;
}

.registration {
  border-color: #48486e;
  color: #48486e;
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
  width: 120px;
  margin-left: 2em;
}
.check {
  display: flex;
  margin-top: 30px;
}
.check-text {
  margin: 0px;
}
.navbar {
  width: 97vw;
}
.question {
  width: 100vw;
  margin-left: 600px;
  padding: 0px;
  font-size: 14px;
  text-align: right;
  margin-top: 4px;
  color: #48486e;
}
.title {
  margin-top: 300px;
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

.login {
  background-color: #24154b;
  color: white;
  width: 215px;
  height: 60px;
  margin-top: 20px;
  line-height: 43px;
}
.footer {
  margin-top: 400px;
}
.footer-col1 {
  font-size: 14px;
  color: #48486e;
  margin-left: 40px;
  white-space: nowrap;
}
.footer-col2 {
  font-size: 14px;
  color: #48486e;
  margin-left: 115px;
  text-align: right;
}
.footer-col3 {
  color: white;
}
.footer-logo {
  font-weight: 900;
}
.login {
  background-color: #330066;
  color: white;
  width: 215px;
  height: 60px;
  margin-top: 40px;
  line-height: 43px;
}
.login-text {
  margin-top: 300px;
  margin-left: 130px;
  font-size: 55px;
  font-weight: 50;
}
.form {
  margin-left: 130px;
  margin-top: 25px;
  color: black;
}
.placeholder {
  width: 500px;
  margin-top: 15px;
  height: 50px;
  border: white;
  color: black;
  border-bottom: 1px solid #d7d7c1;
}

.footer-logo {
  font-weight: 900;
}
.background {
  max-width: 50%;
  height: auto;
  position: absolute;
  align-items: right;
  background-repeat: no-repeat;
  right: 5px;
  margin-top: 90px;
}
</style>
