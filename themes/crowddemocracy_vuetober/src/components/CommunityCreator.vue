<template>
    <div class="wrap">
        <!-- navbar - nazov, back button -->
        <b-row class="nav">
            <b-col cols="8">
                <p class="title">Vytvor si komunitu</p>
            </b-col>
            <b-col cols="4">
                <b-button to="/home" class="back-button">Späť</b-button>
            </b-col>
        </b-row>
        <!-- navbar koniec -->

        <b-row>
            <b-col lg="6" sm="12">
                <div class="inputs">
                    <ValidationObserver v-slot="{ passes }">
                        <form @submit.prevent="passes(createCommunity)">
                            <p for="meno">Meno komunity</p>

                            <ValidationProvider
                                rules="required"
                                v-slot="{ errors }"
                            >
                                <input
                                    type="text"
                                    name="meno"
                                    autocomplete="off"
                                    v-model="name"
                                />
                                <span class="error">{{ errors[0] }}</span>
                            </ValidationProvider>

                            <p for="opis">
                                Opis komunity (max 60 znakov) {{ desc.length }}
                            </p>

                            <ValidationProvider
                                :customMessages="messages"
                                rules="required|max:60"
                                v-slot="{ errors }"
                            >
                                <textarea
                                    type="text"
                                    name="opis"
                                    v-model="desc"
                                />
                                <span class="error">{{ errors[0] }}</span>
                            </ValidationProvider>
                            <span class="error" v-bind="error">
                                {{ error }}
                            </span>
                            <b-button
                                class="community-buttons"
                                variant="success"
                                type="submit"
                                >Vytvoriť</b-button
                            >

                            <b-button class="community-buttons" to="/manage"
                                >Pozrieť moje komunity</b-button
                            >
                        </form>
                    </ValidationObserver>
                </div>
            </b-col>
            <b-col lg="6" sm="0">
                <img class="background" src="../assets/bg.png" />
            </b-col>
        </b-row>
    </div>
</template>
<script>
import { mapGetters } from "vuex";
import { ValidationProvider } from "vee-validate";
import { ValidationObserver } from "vee-validate";
import { extend } from "vee-validate";
import { required } from "vee-validate/dist/rules";
import { setInteractionMode } from "vee-validate";

setInteractionMode("eager");

extend("required", {
    ...required,
    message: "Pole nesmie byť prázdne!"
});

// extend("max", {
//   ...max,
//   message: "Opis komunity nesmie byť dlhší ako 60 znakov"
// });
export default {
    components: {
        ValidationProvider,
        ValidationObserver
    },
    data() {
        return {
            name: "",
            desc: "",
            error: "",
            messages: { max: "Opis komunity nesmie byť dlhší ako 60 znakov" }
        };
    },
    created() {
        if (!this.$store.getters.isLoggedIn || !this.user.is_activated) {
            this.$router.push("/support");
        } else {
            this.refreshUser();
        }
    },
    methods: {
        createCommunity() {
            let data = {
                name: this.name,
                desc: this.desc
            };
            this.$store
                .dispatch("createCommunity", data)
                .then(() => this.$router.push("/manage"))
                .catch(() => (this.error = "Nepodarilo sa vytvorit komunitu"));
        },
        refreshUser() {
            this.$store
                .dispatch("refresh")
                .then(() => {})
                .catch(err => {
                    console.error(err);
                });
        }
    },
    computed: {
        ...mapGetters({
            user: "getUserData"
        })
    }
};
</script>
<style lang="css" scoped>
.wrap {
    overflow-x: hidden;
}
/* navbar */
.nav {
    line-height: 5em;
}
.back-button {
    width: 50%;
    border-color: #48486e;
    color: #48486e;
    background-color: white;
}
/* kontent */
.title {
    font-size: 4em;
    margin-left: 10%;
    font-weight: 50;
    color: #48486e;
}
.inputs {
    margin-left: 15%;
    margin-top: 14%;
}
.inputs form p {
    display: block;
    font-size: 1.5em;
    margin: 1em 0em;
    width: 100%;
    font-weight: 50;
}
.inputs form {
    display: block;
    margin: 1em 0em;
}
.inputs form textarea {
    resize: none;
    width: 100%;
    height: 10em;
    border-radius: 8px;
    border: 1px solid black;
}
.inputs form input {
    width: 100%;
    border-radius: 8px;
    border: 1px solid black;
}

.inputs form input:focus {
    outline: none;
}
.inputs form textarea:focus {
    outline: none;
}
.background {
    max-width: 100%;
    min-height: 100%;
    background-repeat: no-repeat;
}
.error {
    display: block;
    color: #ff3333;
    font-size: 14px;
}
.community-buttons {
    display: block;
    width: 100%;
    margin-top: 1em;
}

@media only screen and (max-width: 990px) {
    .inputs form textarea {
        width: 95%;
    }
    .inputs form input {
        width: 95%;
    }
    .inputs form p {
        width: 95%;
    }
    .community-buttons {
        width: 95%;
    }
    .back-button {
        width: 5em;
    }
    .background {
        display: none;
    }
    .title {
        font-size: 3em;
        margin-left: 3%;
    }
    .inputs {
        margin-left: 5%;
        margin-top: 14%;
    }
}
@media only screen and (max-width: 591px) {
    .back-button {
        margin-top: 4em;
    }
}
@media only screen and (max-width: 310px) {
    .title {
        font-size: 2em;
    }
}
</style>
