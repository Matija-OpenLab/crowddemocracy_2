<template>
  <div class="wrap">
    <b-row class="text-center">
      <b-col cols="1">
        <b-button to="/home" variant="danger" class="back-button">Späť</b-button>
      </b-col>
      <b-col cols="11">
        <h1 class="title">Vytvor si komunitu</h1>
      </b-col>
    </b-row>

    <b-row>
      <b-col>
        <div class="inputs">
          <ValidationObserver v-slot="{ passes }">
            <form @submit.prevent="passes(createCommunity)">
              <label for="meno">Meno komunity</label>

              <ValidationProvider rules="required" v-slot="{ errors }">
                <input type="text" name="meno" autocomplete="off" v-model="name" />
                <span class="error">{{errors[0]}}</span>
              </ValidationProvider>

              <label for="opis">Opis komunity (max 100 znakov)</label>

              <ValidationProvider rules="required|max:100" v-slot="{ errors }">
                <textarea type="text" name="opis" v-model="desc" />
                <span class="error">{{errors[0]}}</span>
              </ValidationProvider>

              <b-button variant="success" type="submit">Vytvoriť</b-button>
              <b-button to="/manage">Pozrieť moje komunity</b-button>
            </form>
          </ValidationObserver>
        </div>
      </b-col>
      <b-col>
        <img class="background" src="../assets/bg.png" />
      </b-col>
    </b-row>
  </div>
</template>
<script>
import { ValidationProvider } from "vee-validate";
import { ValidationObserver } from "vee-validate";
import { extend } from "vee-validate";
import { required, max } from "vee-validate/dist/rules";
import { setInteractionMode } from "vee-validate";

setInteractionMode("eager");

extend("required", {
  ...required,
  message: "Pole nesmie byť prázdne!"
});

extend("max", {
  ...max,
  message: "Užívateľské meno nesmie byť dlhšie ako 100 znakov"
});
export default {
  components: {
    ValidationProvider,
    ValidationObserver
  },
  data() {
    return {
      name: "",
      desc: ""
    };
  },
  methods: {
    createCommunity() {}
  }
};
</script>
<style lang="css" scoped>
.wrap {
  overflow-x: hidden;
}
.back-button {
  width: 100%;
  margin: 1em;
}
.title {
  margin: 0.3em;
}
.inputs {
  margin-left: 15%;
  margin-top: 20%;
}
.inputs form label,
button {
  display: block;
  font-size: 20px;
  margin: 1em 0em;
  font-weight: 600;
}
.inputs form textarea {
  resize: none;
  width: 500px;
  height: 200px;
  background-color: rgba(225, 228, 225, 0.801);
}
.inputs form input {
  width: 500px;
}
.inputs form input:hover,
textarea:hover {
  border: black 2px solid;
}
.background {
  max-width: 100%;
  height: auto;
  background-repeat: no-repeat;
  right: 0;
}
.error {
  display: block;
  color: red;
  font-weight: 500;
}
</style>