<template>
  <div class="wrap">
    <b-button to="/home" class="back-button">Späť</b-button>
    <b-row>
      <b-col lg="5" sm="12">
        <p class="letter z-bold">
          Ďakujeme, že podporujete našu stránku. Bohužiaľ, je stále vo
          fáze vývoja a nie je plne funkčná. Keby ste nám chceli
          pomôcť tým, že si vytvoríte komunitu na našej stránke a
          budete do nej pridávať hlasovania, alebo nájdete na nej
          nejakú chybu, prosím, kontaktujte nás na mail
          <span
            class="email"
          >crowddemoracy.help@gmail.com</span>
        </p>
      </b-col>
      <b-col>
        <img class="background" src="../assets/bg.png" />
      </b-col>
    </b-row>
  </div>
</template>
<script>
export default {
  created() {
    this.refreshUser();
  },
  methods: {
    refreshUser() {
      this.$store
        .dispatch("refresh")
        .then(() => {})
        .catch(err => {
          console.error(err);
        });
    }
  }
};
</script>
<style lang="css" scoped>
.letter {
  font-size: 1.5em;
  letter-spacing: 1.5px;
  margin-top: 10em;
  margin-left: 1em;
}
.email {
  color: #482997;
}
.back-button {
  width: 10%;
  border-color: #48486e;
  color: #48486e;
  margin: 2em;
  background-color: white;
}
@media only screen and (max-width: 990px) {
  .letter {
    margin-top: 8em;
    font-size: 1em;
    font-weight: 400;
    letter-spacing: 1px;
    width: 95%;
  }
}
</style>

