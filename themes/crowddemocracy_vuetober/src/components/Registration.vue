<template>
    <div>
        <h1>Crowddemocracy</h1>
        <h3>Registrácia</h3>

        <div class="email">
            <div
                class="form-group"
                :class="{ 'form-group--error': $v.email.$error }"
            >
                <label class="form__label">Email</label>
                <input
                    type="email"
                    class="form__input"
                    v-model.trim="$v.email.$model"
                />
            </div>
        </div>

        <div for="username">
            <div
                class="form-group"
                :class="{ 'form-group--error': $v.username.$error }"
            >
                <label class="form__label">Používateľské meno</label>
                <input class="form__input" v-model.trim="$v.username.$model" />
            </div>
        </div>

        <div for="pass">
            <div
                class="form-group"
                :class="{ 'form-group--error': $v.pass.$error }"
            >
                <label class="form__label">Heslo</label>
                <input
                    type="password"
                    class="form__input"
                    v-model.trim="$v.pass.$model"
                />
            </div>
        </div>
        <div for="passCheck">
            <div
                class="form-group"
                :class="{ 'form-group--error': $v.passCheck.$error }"
            >
                <label class="form__label">Zopakujte heslo</label>
                <input
                    type="password"
                    class="form__input"
                    v-model.trim="$v.passCheck.$model"
                />
            </div>
        </div>
        <div
            class="error"
            v-if="
                !$v.username.required || !$v.email.required || !$v.pass.required
            "
        >
            All fields must be filled in
        </div>
        <b-button variant="success">Registrovať sa</b-button>
        <b-button to="home">Home</b-button>
    </div>
</template>
<script>
import { required, minLength } from "vuelidate/lib/validators";

export default {
    data() {
        return {
            email: "",
            username: ""
        };
    },
    validations: {
        email: {
            required,
            minLength: minLength(3)
        },
        username: {
            required,
            minLength: minLength(3)
        },
        pass: {
            required,
            minLength: minLength(8)
        },
        passCheck: {
            required
        }
    }
};
</script>
<style lang="css" scoped>
.error {
    color: red;
}
</style>
