<template>
  <div class="wrap">
    <b-button to="/home" class="back-button">Späť</b-button>
    <b-row>
      <b-col>
        <p class="letter">
          Ďakujeme, že podporujete našu stránku. Bohužiaľ, je stále vo fáze vývoja a nie je plne funkčná. Keby ste nám chceli pomôcť tým, že si vytvoríte komunitu na našej stránke a budete do nej pridávať hlasovania, alebo nájdete na nej nejakú chybu, prosím, kontaktujte nás na mail
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
<style lang="css" scoped>
.wrap {
  overflow-x: hidden;
}
.letter {
  font-size: 1.5em;
  font-weight: bold;
  letter-spacing: 1.5px;
  margin-top: 10em;
  margin-left: 1em;
}
.email {
  color: #482997;
}
.background {
  max-width: 100%;
  height: auto;
  background-repeat: no-repeat;
  right: 0;
}
.back-button {
  width: 10%;
  margin-top: 10px;
  margin-left: 10px;
  border-color: #48486e;
  color: #48486e;
  background-color: white;
}
</style>