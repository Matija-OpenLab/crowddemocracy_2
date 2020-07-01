<template>
  <div class="a-registration m-0">
    <b-container fluid class="wrap-content">
      <b-row class="navbar">
        <b-col>
          <img class="logo" src="../assets/logo.png" @click="toIntro()" />
        </b-col>
        <b-col>
          <b-button class="login mt-1 z-bold" to="/login">Prihlás sa</b-button>
          <p class="question">Už máš účet?</p>
        </b-col>
      </b-row>
      <!-- navbar koniec -->
      <div class="content-wrap">
        <b-row>
          <b-col lg="6">
            <h1 class="header">Registrácia</h1>
            <ValidationObserver v-slot="{ passes }">
              <form class="form mt-3" @submit.prevent="passes(register)">
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
            <img class="z-background" src="../assets/bg.png" />
          </b-col>
        </b-row>
      </div>
    </b-container>
  </div>
</template>
<script>
/*eslint-disable*/
import Footer from "../components/a-footer.vue";
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

<style lang="scss" scoped>
.a-registration {
  height: 100vh;
  position: absolute;
  width: 100%;

  .login {
    border-color: #48486e;
    color: #48486e;
    background-color: white;
    width: 140px;
    font-size: 14px;
    float: right;
  }

  .form {
    margin-left: 130px;
    color: black;
    input {
      width: 100%;
      margin-top: 15px;
      height: 50px;
      border: none;
      color: black;
      border-bottom: 1px solid #d7d7c1;
    }
    input:focus {
      outline: none;
    }
  }
  .registration {
    background-color: #24154b;
    color: white;
    width: 215px;
    height: 60px;
    margin-top: 20px;
    line-height: 43px;
  }
}

@media only screen and (max-width: 990px) {
  .a-registration {
    .logo {
      width: 7em;
      margin-left: 0px;
    }
    .login {
      border-color: #48486e;
      color: #48486e;
      background-color: white;
      width: 10em;
      padding: 1em;
    }
    .question {
      display: none;
    }
    .form {
      margin: 0px;
      color: black;
      text-align: center;
      input {
        width: 95%;
        margin-top: 2em;
        height: 3em;
        border: none;
        color: black;
        border-bottom: 1px solid #a0a09f;
      }
    }
    .registration {
      margin: 0px;
      margin-top: 3em;
    }
    .a-footer {
      display: none;
    }
  }
}
@media only screen and (max-width: 400px) {
  .login {
    font-size: 0.7em;
    width: 8em;
  }
}
</style>
