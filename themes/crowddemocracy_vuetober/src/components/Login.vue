<template>
    <div class="wrap">
        <b-row class="navbar">
            <b-col>
                <img class="logo" @click="toIntro()" src="../assets/logo.png" />
            </b-col>
            <b-col>
                <b-button class="registration" to="/registration"
                    >Registruj sa</b-button
                >
                <p class="question">Ešte nemáš účet?</p>
            </b-col>
        </b-row>
        <div class="content-wrap">
            <b-row>
                <b-col sm="12">
                    <h1 class="header">Prihlásenie</h1>
                    <form class="form" @submit.prevent="login">
                        <ValidationProvider
                            rules="required|email"
                            v-slot="{ errors }"
                        >
                            <input
                                type="text"
                                placeholder="Email"
                                v-model="email"
                            />
                            <span class="error">{{ errors[0] }}</span>
                        </ValidationProvider>

                        <ValidationProvider
                            rules="required|password_verification:8,16"
                            v-slot="{ errors }"
                        >
                            <input
                                type="password"
                                placeholder="Heslo"
                                v-model="password"
                            />
                            <span class="error">{{ errors[0] }}</span>
                        </ValidationProvider>
                        <span v-if="error.length" class="error"
                            >Uživateľ nebol najdeny</span
                        >
                        <b-button class="login" type="submit"
                            >Prihlásiť</b-button
                        >
                    </form>
                </b-col>
                <b-col>
                    <img class="background" src="../assets/bg.png" />
                </b-col>
            </b-row>
        </div>
        <div class="footer">
            &reg; 2020 všetky práva vyhradené
            <span class="footer-logo">CROWD</span>DEMOCRACY
        </div>
    </div>
</template>
<script>
import { ValidationProvider } from "vee-validate";
import { extend } from "vee-validate";
import { required, email } from "vee-validate/dist/rules";
import { setInteractionMode } from "vee-validate";
setInteractionMode("eager");

extend("required", {
    ...required,
    message: "Pole nesmie byť prázdne!"
});
extend("email", {
    ...email,
    message: "Nesprávny formát emailu!"
});

//Custom validation rules

extend("password_verification", {
    validate(value, { min, max }) {
        const passRegex = new RegExp(
            `^(?=.*)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{${min},${max}}`
        );
        return passRegex.test(value);
    },
    params: ["min", "max"],
    message:
        "Heslo musí obsahovať minimálne {min} znakov, najviac {max} znakov, obsahovať aspoň jedno veľké písmeno a jedno číslo."
});

export default {
    components: {
        ValidationProvider
    },
    data() {
        return {
            email: "",
            password: "",
            error: ""
        };
    },
    created() {
        if (this.$store.getters.isLoggedIn) this.$router.push("/home");
    },
    methods: {
        login() {
            let email = this.email;
            let password = this.password;
            this.$store
                .dispatch("login", { email, password })
                .then(() => this.$router.push("/home"))
                .catch(() => {
                    this.error = "Invalid credencials";
                });
        },
        toIntro() {
            this.$router.push("/");
        }
    }
};
</script>
<style scoped>
.wrap {
    overflow-x: hidden;
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
    margin-top: 1em;
}
.navbar {
    width: 97vw;
}
.logo {
    width: 140px;
    margin-left: 2em;
    cursor: pointer;
}
.question {
    padding: 0px;
    font-size: 14px;
    float: right;
    margin-top: 0.73em;
    color: #48486e;
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
    margin-top: 150px;
    margin-left: 130px;
    font-size: 55px;
    font-weight: 50;
}
.form {
    margin-left: 130px;
    margin-top: 25px;
    color: black;
}
.form input {
    width: 500px;
    margin-top: 15px;
    height: 50px;
    border: none;
    color: black;
    border-bottom: 1px solid #d7d7c1;
}
.form input:focus {
    outline: none;
}
.placeholder {
    width: 500px;
    margin-top: 15px;
    height: 50px;
    border: white;
    color: black;
    border-bottom: 1px solid #d7d7c1;
}
.login {
    background-color: #24154b;
    color: white;
    width: 215px;
    height: 60px;
    margin-top: 20px;
    line-height: 43px;
}
.content-wrap {
    position: relative;
    min-height: 100%;
}
.footer {
    position: absolute;
    bottom: 0;
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
    .background {
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
    .footer {
        font-size: 0.9em;
    }
    /*Form */
    .form {
        margin: 0px;
        color: black;
        text-align: center;
    }
    .form input {
        width: 95%;
        margin-top: 2em;
        height: 3em;
        border: none;
        color: black;
        border-bottom: 1px solid #a0a09f;
    }
}
@media only screen and (max-width: 400px) {
    .footer {
        bottom: -15%;
    }
    .registration {
        font-size: 0.7em;
        width: 8em;
    }
}
</style>
