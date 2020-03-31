<template>
  <div class="wrap">
    <b-row class="navbar">
      <b-col class="logo">logo</b-col>
      <b-col class="question">Ešte nemáš účet?</b-col>
      <b-col class="button">
        <b-button class="registration" to="/registration">Registruj sa</b-button>
      </b-col>
    </b-row>
    <h1 class="login-text">Prihlásenie</h1>
    <form class="form">
      <input class="placeholder" type="text" placeholder="Prezývka / Email" />
      <input class="placeholder" type="password" placeholder="Heslo" />
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
export default {};
</script>
<style scoped>
.form input {
  display: block;
}
.register_text {
  display: inline;
}

/*Dominikin code skopirovany z Intor.vue*/

.registration {
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
.question {
  width: 500px;
  margin-left: 700px;
  padding: 0px;
  font-size: 14px;
  text-align: right;
  margin-top: 4px;
  color: #330066;
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