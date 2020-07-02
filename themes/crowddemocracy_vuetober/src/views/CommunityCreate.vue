<template>
  <div class="a-community-create">
    <!-- navbar - nazov, back button -->
    <b-row class="nav">
      <b-col cols="8">
        <p class="title">Vytvor si komunitu</p>
      </b-col>
      <b-col cols="4">
        <b-button to="/home" class="back-button">Späť</b-button>
      </b-col>
    </b-row>
    <!-- navbar koniec -->

    <b-row>
      <b-col lg="6" sm="12">
        <div class="inputs">
          <ValidationObserver v-slot="{ passes }">
            <form @submit.prevent="passes(createCommunity)">
              <p for="meno">Meno komunity</p>

              <ValidationProvider rules="required" v-slot="{ errors }">
                <input type="text" name="meno" autocomplete="off" v-model="name" />
                <span class="z-error">{{ errors[0] }}</span>
              </ValidationProvider>

              <p for="opis">Opis komunity (max 60 znakov) {{ desc.length }}</p>

              <ValidationProvider
                :customMessages="messages"
                rules="required|max:60"
                v-slot="{ errors }"
              >
                <textarea type="text" name="opis" v-model="desc" />
                <span class="z-error">{{ errors[0] }}</span>
              </ValidationProvider>
              <span class="z-error" v-bind="error">
                {{
                error
                }}
              </span>
              <b-button class="community-buttons" variant="success" type="submit">Vytvoriť</b-button>

              <b-button class="community-buttons" to="/manage">Pozrieť moje komunity</b-button>
            </form>
          </ValidationObserver>
        </div>
      </b-col>
      <b-col lg="6" sm="0">
        <img class="z-background-image" src="../assets/bg.png" />
      </b-col>
    </b-row>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
import {
  ValidationProvider,
  ValidationObserver,
  setInteractionMode,
  extend
} from "vee-validate";
import { required } from "vee-validate/dist/rules";

setInteractionMode("eager");

extend("required", {
  ...required,
  message: "Pole nesmie byť prázdne!"
});

export default {
  components: {
    ValidationProvider,
    ValidationObserver
  },
  data() {
    return {
      name: "",
      desc: "",
      error: "",
      messages: { max: "Opis komunity nesmie byť dlhší ako 60 znakov" }
    };
  },

  computed: {
    ...mapGetters({
      user: "getUserData"
    })
  },

  created() {
    //maybe refresh user
  },
  methods: {
    createCommunity() {
      let data = {
        name: this.name,
        desc: this.desc
      };
      this.$store
        .dispatch("createCommunity", data)
        .then(() => this.$router.push("/manage"))
        .catch(() => (this.error = "Nepodarilo sa vytvorit komunitu"));
    }
  }
};
</script>
<style lang="scss" scoped>
.a-community-create {
  overflow-x: hidden;

  .community-buttons {
    display: block;
    width: 95%;
    margin-top: 1em;
  }
  .nav {
    line-height: 5em;
  }
  .back-button {
    width: 50%;
    border-color: #48486e;
    color: #48486e;
    background-color: white;
  }
  .title {
    font-size: 4em;
    margin-left: 10%;
    font-weight: 50;
    color: #48486e;
  }
}
.inputs {
  margin-left: 15%;
  margin-top: 14%;
  form p {
    display: block;
    font-size: 1.5em;
    margin: 1em 0em;
    width: 100%;
    font-weight: 50;
  }
  form {
    display: block;
    margin: 1em 0em;
  }
  form input {
    width: 100%;
    border-radius: 8px;
    border: 1px solid black;
    &:focus {
      outline: none;
    }
  }
  form textarea {
    resize: none;
    width: 100%;
    height: 10em;
    border-radius: 8px;
    border: 1px solid black;
    &:focus {
      outline: none;
    }
  }
}

@media only screen and (max-width: 990px) {
  .community-buttons {
    width: 95%;
  }
  .inputs {
    margin-left: 5%;
    margin-top: 14%;
    form textarea {
      width: 95%;
    }
    form input {
      width: 95%;
    }
    form p {
      width: 95%;
    }
  }
}
</style>
