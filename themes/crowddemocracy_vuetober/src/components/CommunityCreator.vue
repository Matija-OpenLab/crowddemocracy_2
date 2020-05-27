<template>
  <div class="wrap">
    <b-row>
      <b-col cols="10">
        <p class="title">Vytvor si komunitu</p>
      </b-col>
      <b-col cols="2">
        <b-button to="/home" class="back-button">Späť</b-button>
      </b-col>
    </b-row>

    <b-row>
      <b-col>
        <div class="inputs">
          <ValidationObserver v-slot="{ passes }">
            <form @submit.prevent="passes(createCommunity)">
              <p class="new-community-name" for="meno">Meno komunity</p>

              <ValidationProvider rules="required" v-slot="{ errors }">
                <input type="text" name="meno" autocomplete="off" v-model="name" />
                <span class="error">{{errors[0]}}</span>
              </ValidationProvider>

              <p class="new-community-info" for="opis">Opis komunity (max 100 znakov)</p>

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
  margin-top: 30px;
  margin-left: -80px;
  border-color: #48486e;
  color: #48486e;
  background-color: white;
}
.title {
  margin: 0.3em;
  margin-left: 110px;
  font-size: 50px;
  font-weight: 50;
  color: #48486e;
}
.inputs {
  margin-left: 15%;
  margin-top: 14%;
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
  border-radius: 8px;
}
.inputs form input {
  width: 500px;
  border-radius: 8px;
}
.inputs form input:hover,
textarea:hover {
  border: black 2px solid;
}
.inputs form input:focus {
  background-color: rgb(235, 235, 235);
  outline: none;
}
.inputs form textarea:focus {
  outline: none;
}
.background {
  max-width: 100%;
  height: auto;
  background-repeat: no-repeat;
  right: 0;
}
.error {
  display: block;
  color: #ff3333;
  font-size: 14px;
}
.new-community-name {
  font-weight: 50;
  font-size: 20px;
  color: #9a9eaa;
}
.new-community-info {
  font-weight: 50;
  font-size: 20px;
  color: #9a9eaa;
  margin-top: 15px;
}
@media only screen and (max-width: 990px) {
  .back-button {
    width: 5em;
    margin-top: 4em;
  }
  .background {
    display: none;
  }
  .title {
    font-size: 3em;
    margin-left: 0.5em;
  }
  .inputs {
    margin-left: 5%;
    margin-top: 14%;
  }
  .inputs form input {
    width: 95%;
  }
}
</style>