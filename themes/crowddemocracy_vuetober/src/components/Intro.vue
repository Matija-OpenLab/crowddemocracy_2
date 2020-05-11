<template>
    <div class="wrap">
        <b-container class="content">
            <img class="background" src="../assets-dominika/bg.png" />
            <b-row class="navbar">
                <b-col class="logo">
                    <img class="logo" src="../assets-dominika/logo.png" />
                </b-col>
                <b-col class="question">Ešte nemáš účet?</b-col>
                <b-col class="button">
                    <b-button class="registration" to="/registration"
                        >Registruj sa</b-button
                    >
                </b-col>
            </b-row>
            <h4 class="header">Ako využijete svoj hlas?</h4>
            <h5 class="intro">
                Na
                <span class="intro-text">CROWD</span>DEMOCRACY môžete dať svoj
                hlas novým návrhom alebo ho odovzdať ľudom ktorým dôverujete.
            </h5>

            <b-button class="login" to="/login">Prihlásiť sa</b-button>
            <b-row class="footer">
                <b-col class="footer-col1">
                    &reg; 2020 všetky práva vyhradené
                    <span class="footer-logo">CROWD</span>DEMOCRACY
                </b-col>
                <b-col class="footer-col2"
                    >Sledujte nás na sociálnych sieťach</b-col
                >
                <b-col class="footer-col3"></b-col>
            </b-row>
        </b-container>
        <!-- sekcia na zobrazovanie aktualnych hlasovani -->
        <section>
            <p></p>
        </section>
    </div>
</template>
<script>
export default {
    created() {
        if (this.$store.getters.isLoggedIn) this.$router.push("/home");
    }
};
</script>
<style scoped>
.wrap {
    height: 100vh;
    margin: 0px;
    position: relative;
}
.background {
    max-width: 50%;
    height: auto;
    position: absolute;
    align-items: right;
    background-repeat: no-repeat;
    right: 5px;
    margin-top: 90px;
}
.navbar {
    width: 97vw;
}
.content {
    margin: 0px;
}
.logo {
    width: 120px;
    margin-left: 2em;
}
.question {
    width: 500px;
    margin-left: 700px;
    padding: 0px;
    font-size: 14px;
    text-align: right;
    margin-top: 4px;
    color: #48486e;
}
.registration {
    border-color: #48486e;
    color: #48486e;
    background-color: white;
    width: 140px;
    font-weight: bold;
    font-size: 14px;
    margin-top: 5px;
}
.header {
    margin-top: 280px;
    font-size: 50px;
    font-weight: 50;
    color: #48486e;
    margin-left: 115px;
}
.intro {
    width: 500px;
    font-weight: 50;
    color: #48486e;
    margin-left: 115px;
    margin-top: 50px;
    text-align: center;
}
.intro-text {
    font-weight: bold;
}
.button {
    width: 500px;
}
.login {
    background-color: #24154b;
    color: white;
    width: 215px;
    height: 60px;
    margin-top: 40px;
    margin-left: 115px;
    line-height: 43px;
    font-weight: bold;
}

.footer {
    margin-top: 490px;
}
.footer-col1 {
    font-size: 14px;
    color: #48486e;
    margin-left: 40px;
    white-space: nowrap;
}
.footer-col2 {
    font-size: 14px;
    color: #48486e;
    margin-left: 115px;
    text-align: right;
}
.footer-col3 {
    color: white;
}
.footer-logo {
    font-weight: 900;
}
</style>
