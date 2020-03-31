<template>
  <div class="wrap">
    <p class="login_text">Už máte účet?</p>
    <b-button to="/login">Prihlásiť</b-button>

    <h1 class="title">Registrácia</h1>
    <form class="form">
      <input type="email" placeholder="Email" />
      <input type="text" placeholder="Používateľské meno" />
      <input type="password" placeholder="Heslo" />
      <input type="password" placeholder="Potvrdenie hesla" />
      <div class="check">
        <input type="checkbox" />
        Súhlasím so spracovaním údajov
      </div>

      <span class="error"></span>
      <b-button type="submit">Registrácia</b-button>
    </form>
  </div>
</template>
<script>
export default {};
</script>
<style lang="css" scoped>
.form input {
  display: block;
}
.login_text {
  display: inline;
}
</style>
