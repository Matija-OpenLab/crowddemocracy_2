<template>
  <div class="wrap">
    <p class="register_text">Ešte nemáš účet?</p>
    <b-button to="/registration">Registruj sa</b-button>
    <h1>Prihlásenie</h1>
    <form class="form">
      <input type="text" placeholder="Prezývka / Email" />
      <input type="password" placeholder="Heslo" />
      <b-button type="submit">Prihlásiť</b-button>
    </form>
  </div>
</template>
<script>
export default {};
</script>
<style scoped>
.form input {
  display: block;
}
.register_text {
  display: inline;
}
</style>