<template>
  <div class="wrap">
    <b-container fluid class="wrap-content">
      <b-row class="navbar">
        <b-col>
          <img class="logo" src="../assets/logo.png" @click="toIntro()" />
        </b-col>
        <b-col>
          <b-button class="login" to="/login">Prihlás sa</b-button>
          <p class="question">Už máš účet?</p>
        </b-col>
      </b-row>
      <!-- navbar koniec -->
      <div class="content-wrap">
        <b-row>
          <b-col lg="6">
            <h1 class="header">Registrácia</h1>
            <ValidationObserver v-slot="{ passes }">
              <form class="form" @submit.prevent="passes(register)">
                <ValidationProvider rules="required|email" v-slot="{ errors }">
                  <input class="placeholder" type="email" placeholder="Email" v-model="email" />
                  <span class="error">{{ errors[0] }}</span>
                </ValidationProvider>

                <ValidationProvider rules="required|max:16" v-slot="{ errors }">
                  <input
                    class="placeholder"
                    type="text"
                    placeholder="Používateľské meno"
                    v-model="username"
                  />
                  <span class="error">{{ errors[0] }}</span>
                </ValidationProvider>

                <ValidationProvider
                  vid="password"
                  rules="required|password_verification:8,16"
                  v-slot="{ errors }"
                >
                  <input class="placeholder" type="password" placeholder="Heslo" v-model="password" />
                  <span class="error">{{ errors[0] }}</span>
                </ValidationProvider>

                <ValidationProvider
                  rules="required|password_verification:8,16|confirmed:password"
                  v-slot="{ errors }"
                >
                  <input
                    class="password"
                    type="password"
                    placeholder="Potvrdenie hesla"
                    v-model="password_confirmation"
                  />
                  <span class="error">{{ errors[0] }}</span>
                </ValidationProvider>

                <span class="error">{{ error }}</span>
                <b-button class="registration" type="submit">Registrácia</b-button>
              </form>
            </ValidationObserver>
            <Footer></Footer>
          </b-col>
          <b-col>
            <img class="background" src="../assets/bg.png" />
          </b-col>
        </b-row>
      </div>
    </b-container>
  </div>
</template>
<script>
/*eslint-disable*/
import Footer from "../components/Footer.vue";
import {
  ValidationProvider,
  ValidationObserver,
  setInteractionMode,
  extend
} from "vee-validate";
import { required, email, max, confirmed } from "vee-validate/dist/rules";
setInteractionMode("eager");

extend("required", {
  ...required,
  message: "Pole nesmie byť prázdne!"
});
extend("email", {
  ...email,
  message: "Nesprávny formát emailu!"
});
extend("max", {
  ...max,
  message: "Užívateľské meno nesmie byť dlhšie ako 16 znakov"
});
extend("confirmed", {
  ...confirmed,
  message: "Heslo sa musí zhodovať"
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
    Footer
  },
  data() {
    return {
      email: "",
      username: "",
      password: "",
      password_confirmation: "",
      error: ""
    };
  },
  created() {
    if (this.$store.getters.isLoggedIn) this.$router.push("/home");
  },
  methods: {
    register() {
      let data = {
        email: this.email,
        password: this.password,
        password_confirmation: this.password_confirmation,
        name: this.username
      };
      this.$store
        .dispatch("register", data)
        .then(() => this.$router.push("/home"))
        .catch(() => (this.error = "Invalid credencials"));
    },
    toIntro() {
      this.$router.push("/");
    }
  },
  watch: {}
};
</script>

<style lang="css" scoped>
.wrap {
  height: 100vh;
  margin: 0px;
  position: absolute;
  width: 100%;
}
/* navbar items */
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
.login {
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
.registration {
  background-color: #24154b;
  color: white;
  width: 215px;
  height: 60px;
  margin-top: 20px;
  line-height: 43px;
}
@media only screen and (max-width: 990px) {
  /*Navigation*/
  .login {
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
  .registration {
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
  .footer {
    margin-top: 5%;
  }
}
@media only screen and (max-width: 400px) {
  .login {
    font-size: 0.7em;
    width: 8em;
  }
}
</style>
