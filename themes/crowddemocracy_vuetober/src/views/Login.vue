<template>
  <div class="a-login m-0">
    <b-container fluid class="content-wrap">
      <Navbar></Navbar>
      <b-row>
        <b-col lg="6">
          <h1 class="a-header">Prihlásenie</h1>
          <ValidationObserver v-slot="{ passes }">
            <form class="form" @submit.prevent="passes(login)">
              <ValidationProvider rules="required|email" v-slot="{ errors }">
                <input type="text" placeholder="Email" v-model="email" />
                <span class="z-error">{{ errors[0] }}</span>
              </ValidationProvider>

              <ValidationProvider rules="required|password_verification:8,16" v-slot="{ errors }">
                <input type="password" placeholder="Heslo" v-model="password" />
                <span class="z-error">{{ errors[0] }}</span>
              </ValidationProvider>
              <span v-if="error.length" class="z-error">Uživateľ nebol najdeny</span>
              <b-button class="login mt-2" type="submit">Prihlásiť</b-button>
            </form>
          </ValidationObserver>
        </b-col>
        <b-col>
          <img class="z-background-image" src="../assets/bg.png" />
        </b-col>
      </b-row>
      <Footer></Footer>
    </b-container>
  </div>
</template>
<script>
import { ValidationProvider, ValidationObserver } from "vee-validate";

import Footer from "../components/a-footer.vue";
import Navbar from "../components/a-navbar.vue";

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
  methods: {
    async login() {
      let email = this.email;
      let password = this.password;
      try {
        await this.$store.dispatch("login", { email, password });
        this.$router.push("/home");
      } catch {
        this.error = "Invalid credencials";
      }
    }
  }
};
</script>
<style lang="scss" scoped>
.a-login {
  overflow-x: hidden;

  .content-wrap {
    position: relative;
  }
  .logo {
    width: 140px;
    margin-left: 2em;
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
  .login {
    background-color: #24154b;
    color: white;
    width: 215px;
    height: 60px;
    line-height: 43px;
  }
}

@media only screen and (max-width: 990px) {
  .a-login {
    .form {
      .logo {
        width: 7em;
        margin-left: 0px;
      }
      color: black;
      text-align: center;
      margin: 0px;
      input {
        width: 95%;
        margin-top: 2em;
        height: 3em;
        border: none;
        color: black;
        border-bottom: 1px solid #a0a09f;
      }
    }
    .a-footer {
      display: none;
    }
  }
}
@media only screen and (max-width: 400px) {
  .registration {
    font-size: 0.7em;
    width: 8em;
  }
}
</style>
