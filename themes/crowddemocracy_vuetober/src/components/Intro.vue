<template>
    <div class="wrap">
        <!-- navbar začiatok -->
        <b-row class="navbar">
            <b-col>
                <img class="logo" src="../assets/logo.png" />
            </b-col>
            <b-col>
                <b-button class="registration" to="/registration"
                    >Registruj sa</b-button
                >
                <p class="question">Ešte nemáš účet?</p>
            </b-col>
        </b-row>
        <!-- navbar koniec -->
        <div class="content-wrap">
            <b-row>
                <b-col lg="6">
                    <b-row>
                        <b-col lg="12">
                            <h4 class="header">Ako využijete svoj hlas?</h4>
                        </b-col>
                        <b-col class="content">
                            <h5 class="intro">
                                Na
                                <span class="intro-text">CROWD</span>DEMOCRACY
                                môžete dať svoj hlas novým návrhom alebo ho
                                odovzdať ľudom, ktorým dôverujete.
                            </h5>

                            <b-button class="login" to="/login"
                                >Prihlásiť sa</b-button
                            >
                        </b-col>
                    </b-row>
                </b-col>
                <b-col>
                    <img class="background" src="../assets/bg.png" />
                </b-col>
            </b-row>
        </div>
        <!-- footer začiatok -->
        <div class="footer">
            &reg; 2020 všetky práva vyhradené
            <span class="footer-logo">CROWD</span>DEMOCRACY
        </div>
        <!-- footer koniec -->
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
    overflow-x: hidden;
}
.background {
    max-width: 100%;
    min-height: 100vh;
    align-items: right;
    background-repeat: no-repeat;
}
.p,
h1,
h4 {
    color: #48486e;
}
/* navbar item */
.logo {
    width: 140px;
    margin-left: 2em;
}
.question {
    padding: 0px;
    font-size: 14px;
    float: right;
    margin-top: 0.73em;
    margin-right: 1em;
}
.registration {
    border-color: #48486e;
    color: #48486e;
    background-color: white;
    width: 140px;
    font-weight: bold;
    font-size: 14px;
    margin-top: 5px;
    float: right;
}
.header {
    margin-top: 3em;
    font-size: 50px;
    font-weight: 50;
    margin-left: 115px;
}
.intro {
    width: 500px;
    font-weight: 50;
    margin-left: 100px;
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

.content-wrap {
    position: relative;
    min-height: 100%;
}
.footer {
    position: relative;
    padding: 1rem;
    width: 100%;
}
.footer-logo {
    font-weight: 900;
}
@media only screen and (max-width: 990px) {
    /*Navigation*/
    body {
        margin: 0;
        padding: 0;
    }
    .question {
        display: none;
    }
    .registration {
        border-color: #48486e;
        color: #48486e;
        background-color: white;
        width: 10em;
        padding: 1em;
        font-weight: bold;
    }
    .logo {
        width: 7em;
        margin-left: 0px;
    }
    .background {
        display: none;
    }
    /*Content*/
    .content {
        margin: 0px;
        text-align: center;
    }
    .header {
        margin-top: 2em;
        font-size: 2em;
        margin-left: 0px;
        text-align: center;
    }
    .login {
        margin: 0px;
        margin-top: 3em;
    }
    .intro {
        margin: 0px;
        width: 100%;
        margin-top: 4em;
    }
    .footer {
        font-size: 0.9em;
    }
}
@media only screen and (max-width: 400px) {
    .footer {
        bottom: -10%;
    }
    .registration {
        font-size: 0.7em;
    }
}
</style>
