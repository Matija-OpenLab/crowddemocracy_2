<template>
  <div class="wrap">
    <b-container fluid class="content-wrap">
      <Navbar></Navbar>
      <b-row>
        <b-col lg="6">
          <h1 class="header">Prihlásenie</h1>
          <ValidationObserver v-slot="{ passes }">
            <form class="form" @submit.prevent="passes(login)">
              <ValidationProvider rules="required|email" v-slot="{ errors }">
                <input type="text" placeholder="Email" v-model="email" />
                <span class="error">{{ errors[0] }}</span>
              </ValidationProvider>

              <ValidationProvider rules="required|password_verification:8,16" v-slot="{ errors }">
                <input type="password" placeholder="Heslo" v-model="password" />
                <span class="error">{{ errors[0] }}</span>
              </ValidationProvider>
              <span v-if="error.length" class="error">Uživateľ nebol najdeny</span>
              <b-button class="login" type="submit">Prihlásiť</b-button>
            </form>
          </ValidationObserver>
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
import {
  ValidationProvider,
  ValidationObserver,
  setInteractionMode,
  extend
} from "vee-validate";
import { required, email } from "vee-validate/dist/rules";
setInteractionMode("eager");
import Footer from "../components/Footer.vue";
import Navbar from "../components/Navbar.vue";

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
  validate(value, { min, max }) {
    const passRegex = new RegExp(
      `^(?=.*)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{${min},${max}}`
    );
    return passRegex.test(value);
  },
  params: ["min", "max"],
  message:
    "Heslo musí obsahovať minimálne {min} znakov, najviac {max} znakov, obsahovať aspoň jedno veľké písmeno a jedno číslo."
});

export default {
  components: {
    ValidationProvider,
    ValidationObserver,
    Footer,
    Navbar
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
    },
    toIntro() {
      this.$router.push("/");
    }
  }
};
</script>
<style scoped>
.wrap {
  margin: 0px;
  overflow-x: hidden;
}
/* navbar items */
.content-wrap {
  position: relative;
}
.logo {
  width: 140px;
  margin-left: 2em;
  cursor: pointer;
}
.question {
  padding: 0px;
  font-size: 14px;
  float: right;
  margin-top: 0.73em;
  color: #48486e;
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

.form {
  margin-left: 130px;
  margin-top: 25px;
  color: black;
}
.form input {
  width: 100%;
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
  .login {
    margin: 0px;
    margin-top: 3em;
  }
  /*Form */
  .form {
    margin: 0px;
    color: black;
    text-align: center;
  }
  .form input {
    width: 95%;
    margin-top: 2em;
    height: 3em;
    border: none;
    color: black;
    border-bottom: 1px solid #a0a09f;
  }
}
@media only screen and (max-width: 400px) {
  .registration {
    font-size: 0.7em;
    width: 8em;
  }
}
</style>
