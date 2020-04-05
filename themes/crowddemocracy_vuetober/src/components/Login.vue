<template>
    <div class="wrap">
        <b-row class="navbar">
            <b-col class="logo">logo</b-col>
            <b-col class="question">Ešte nemáš účet?</b-col>
            <b-col class="button">
                <b-button class="registration" to="/registration"
                    >Registruj sa</b-button
                >
            </b-col>
        </b-row>
        <h1>Prihlásenie</h1>
        <form class="form" @submit.prevent="login">
            <input type="text" placeholder="Prezývka / Email" v-model="email" />
            <input type="password" placeholder="Heslo" v-model="password" />
            <b-button type="submit">Prihlásiť</b-button>
        </form>
    </div>
</template>
<script>
export default {
    data() {
        return {
            email: "",
            password: ""
        };
    },
    methods: {
        login() {
            let email = this.email;
            let password = this.password;
            this.$store
                .dispatch("login", { email, password })
                .then(() => this.$router.push("/"))
                .catch(err => console.log(err));
        }
    }
};
</script>
<style scoped>
.form input {
    display: block;
}
.register_text {
    display: inline;
}

/*Dominikin code skopirovany z Intor.vue*/

.registration {
    border-color: #330066;
    color: #330066;
    background-color: white;
    width: 140px;
    font-weight: bold;
    font-size: 14px;
    margin-top: 5px;
}

.button {
    width: 500px;
    margin-left: 0px;
}
.logo {
    width: 500px;
    color: white;
}

.question {
    width: 500px;
    margin-left: 700px;
    padding: 0px;
    font-size: 14px;
    text-align: right;
    margin-top: 4px;
    color: #330066;
}
</style>
