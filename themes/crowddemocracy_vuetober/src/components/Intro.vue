<template>
    <div class="wrap">
        <h1>CrowdDemocracy</h1>
        <h3>
            Na crowd democracy mozte dat svoj hlas novym navrhom alebo ho
            odovzdat ludom ktorym doverujete
        </h3>
        <router-link to="/registration" tag="b-button"
            >Registrovať sa</router-link
        >
        <b-button>Prihlásiť sa</b-button>

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
    background-image: url(../../../../assets/camera.jpg);
    height: 100vh;
}
</style>
