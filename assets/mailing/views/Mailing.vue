<!-- @format -->

<template>
    <div>
        <navbar />
        <v-container>
            <v-layout align-content-end class="login" fill-height justify-center>
                <v-flex align-self-center col-7 offset-3>
                    <v-card class="px-4" max-height="500" max-width="650px" rounded="0">
                        <v-card-text>
                            <v-form ref="registerForm" autocomplete="off" lazy-validation>
                                <v-row>
                                    <v-col cols="12" md="6" sm="6">
                                        <v-text-field
                                            v-model="user.first_name"
                                            v-validate="user.rules.first_name"
                                            :error-messages="errors.collect('first_name')"
                                            label="First Name"
                                            maxlength="25"
                                            name="first_name"
                                            required
                                        />
                                    </v-col>
                                    <v-col cols="12" md="6" sm="6">
                                        <v-text-field
                                            v-model="user.last_name"
                                            v-validate="user.rules.last_name"
                                            :error-messages="errors.collect('last_name')"
                                            label="Last Name"
                                            maxlength="25"
                                            name="last_name"
                                            required
                                        />
                                    </v-col>
                                    <v-col cols="12">
                                        <v-text-field
                                            v-model="user.email"
                                            v-validate="user.rules.email"
                                            :error-messages="errors.collect('email')"
                                            label="E-mail"
                                            name="email"
                                            required
                                        />
                                    </v-col>
                                    <v-spacer />
                                    <v-col class="d-flex ml-auto" cols="12" sm="12" xsm="12">
                                        <v-btn
                                            :disabled="errors.any() || !user.first_name || !user.last_name || !user.email"
                                            block
                                            color="success"
                                            large
                                            tile
                                            @click="addUser"
                                            >Add User
                                        </v-btn>
                                    </v-col>
                                </v-row>
                            </v-form>
                        </v-card-text>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>

<script>
import UserModel from '../models/UserModel';

export default {
    name: 'Mailing',

    data() {
        return {
            user: new UserModel(),
        };
    },

    methods: {
        addUser() {
            this.$validator.validateAll().then(valid => {
                if (valid) {
                    this.user.store().then(response => {
                        if (response.status < 400) {
                            this.user.first_name = '';
                            this.user.last_name = '';
                            this.user.email = '';
                        }
                    }).catch(error => {
                        UserModel.errors(error.response).forEach(error => this.errors.add(error));
                    });
                }
            });
        },
    },

    created() {
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
