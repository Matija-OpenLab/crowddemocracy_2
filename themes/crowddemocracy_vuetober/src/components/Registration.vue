<template>
  <div class="wrap">
    <b-row class="navbar">
      <b-col class="logo">
        <!--  <img src="url(logo.png/assets-dominka/menoAssetu.png)" alt /> -->
      </b-col>
      <b-col class="question">Už máš účet?</b-col>
      <b-col class="button">
        <b-button class="login" to="/login">Prihlás sa</b-button>
      </b-col>
    </b-row>

    <h1 class="title">Registrácia</h1>
    <form class="form">
      <input class="placeholder" type="email" placeholder="Email" />
      <input class="placeholder" type="text" placeholder="Používateľské meno" />
      <input class="placeholder" type="password" placeholder="Heslo" />
      <input class="placeholder" type="password" placeholder="Potvrdenie hesla" />
      <div class="check">
        <input class="checkbox" type="checkbox" />
        <p class="check-text">Súhlasím so spracovaním údajov</p>
      </div>

      <span class="error"></span>
      <b-button class="registration" type="submit">Registrácia</b-button>
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

<style lang="css" scoped>
.form input {
  display: block;
}
.login_text {
  display: inline;
}

/*Dominikin code skopirovany z Intor.vue*/

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
.placeholder {
  width: 500px;
  margin-top: 15px;
  height: 50px;
  border: white;
  color: black;
  border-bottom: 1px solid #d7d7c1;
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
