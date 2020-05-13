<template>
  <div class="wrap">
    <img class="background" src="../assets/bg.png" />
    <b-row class="navbar">
      <b-col class="logo">
        <img class="logo" src="../assets/logo.png" />
      </b-col>
      <b-col class="question">Ešte nemáš účet?</b-col>
      <b-col class="button">
        <b-button class="registration" to="/registration">Registruj sa</b-button>
      </b-col>
    </b-row>
    <h1 class="title">Prihlásenie</h1>
    <form class="form" @submit.prevent="login">
      <ValidationProvider rules="required|email" v-slot="{ errors }">
        <input type="text" placeholder="Email" v-model="email" />
        <span class="error">{{ errors[0] }}</span>
      </ValidationProvider>

      <ValidationProvider rules="required|password_verification:8" v-slot="{ errors }">
        <input type="password" placeholder="Heslo" v-model="password" />
        <span class="error">{{ errors[0] }}</span>
      </ValidationProvider>
      <span v-if="error.length" class="error">Uživateľ nebol najdeny</span>
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
import { ValidationProvider } from "vee-validate";
import { extend } from "vee-validate";
import { required, email } from "vee-validate/dist/rules";
import { setInteractionMode } from "vee-validate";
setInteractionMode("aggressive");

extend("required", {
  ...required,
  message: "Pole nesmie byť prázdne!"
});
extend("email", {
  ...email,
  message: "Nesprávny formát emailu!"
});

//Custom validation rules

extend("password_verification", {
  validate(value, { min }) {
    const passRegex = new RegExp(
      `^(?=.*)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{${min}}`
    );
    return passRegex.test(value);
  },
  params: ["min"],
  message:
    "Heslo musí obsahovať minimálne {min} znakov, obsahovať aspoň jedno veľké písmeno a jedno číslo."
});

export default {
  components: {
    ValidationProvider
  },
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
.wrap {
  overflow-x: hidden;
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
.error {
  display: block;
  color: red;
  font-size: 20px;
  margin-top: 1em;
}
.form input {
  display: block;
}
.navbar {
  width: 97vw;
}
.logo {
  width: 120px;
  margin-left: 2em;
}
.question {
  width: 500px;
  margin-left: 700px;
  padding: 0px;
  font-size: 14px;
  text-align: right;
  margin-top: 4px;
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
.placeholder {
  width: 500px;
  margin-top: 15px;
  height: 50px;
  border: white;
  color: black;
  border-bottom: 1px solid #d7d7c1;
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
</style>
