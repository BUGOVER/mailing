<!-- @format -->

<template>
    <div>
        <navbar />
        <v-container>
            <v-layout class="login" fill-height justify-center align-content-end>
                <v-flex col-6 offset-3 align-self-center>
                    <v-card elevation="6" tile max-width="520px">
                        <v-card-text>
                            <v-form :action="auth" method="post" autocomplete="off">
                                <input :value="$csrf" name="_token" type="hidden" />
                                <v-text-field
                                    append-icon="mdi-account"
                                    name="email"
                                    label="Login"
                                    type="text"
                                    v-model="email"
                                    v-validate="rules.email"
                                    :error_messages="errors.collect('email')"
                                />
                                <v-text-field
                                    append-icon="mdi-lock"
                                    name="password"
                                    label="Passwoard"
                                    id="password"
                                    type="password"
                                    v-model="password"
                                    v-validate="rules.password"
                                    :error_messages="errors.collect('password')"
                                />
                                <v-card-actions>
                                    <v-spacer />
                                    <v-btn
                                        block
                                        :disabled="errors.any() || !password || !email"
                                        tile
                                        type="submit"
                                        color="purple lighten-1"
                                        v-text="'Login'"
                                    />
                                </v-card-actions>
                            </v-form>
                        </v-card-text>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>

<script>
export default {
    name: 'Auth',

    props: ['auth'],

    data() {
        return {
            email: '',
            password: '',
            rules: {
                email: {
                    required: true,
                    max: 64,
                    min: 5,
                },
                password: {
                    required: true,
                    max: 64,
                    min: 5,
                },
            },
        };
    },
};
</script>

<style scoped>
.login {
    height: 100%;
    width: 100%;
    left: 0;
    content: '';
    z-index: 0;
    position: fixed;
    top: -12px !important;
}
</style>
