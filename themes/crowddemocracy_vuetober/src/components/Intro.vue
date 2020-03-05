<template>
  <div class="wrap">
    <h1 class="text-center header">CrowdDemocracy</h1>
    <b-container class="content">
      <b-row>
        <b-col>
          <h3>
            Na crowd democracy mozte dat svoj hlas novym navrhom alebo ho
            odovzdat ludom ktorym doverujete
          </h3>
        </b-col>

        <b-col class="buttons">
          <router-link to="/registration" tag="b-button">Registrovať sa</router-link>
          <b-button>Prihlásiť sa</b-button>
        </b-col>
      </b-row>
    </b-container>
    <!-- sekcia na zobrazovanie aktualnych hlasovani -->
    <section>
      <p>Post..</p>
    </section>
  </div>
</template>
<script>
export default {};
</script>
<style scoped>
.wrap {
  /* background-image: url(../../../../assets/camera.jpg); */
  background-image: url(../assets/backg.jpg);
  background-repeat: no-repeat;
  background-size: cover;
  height: 100vh;
}
.content {
  height: 75vh;
  display: flex;
  align-items: center;
  justify-content: center;
}
.buttons {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
.header {
  line-height: 1em;
  font-size: 5em;
  padding-top: 1em;
}
</style>
