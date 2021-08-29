<template>
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-3xl font-semibold text-gray-700">{{ i18n.t('password.header') }}</h3>
        <div class="mt-8">
            <h4 class="text-gray-600">{{ i18n.t('password.short')}}</h4>

            <div class="mt-4">
                <div class="p-6 bg-white rounded-md shadow-md">
                    <h2 class="text-lg font-semibold text-gray-700 capitalize">
                        {{ i18n.t('password.fill-data') }}
                    </h2>

                    <form @submit.prevent="register">
                        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                            <div>
                                <label class="text-gray-700" for="current_password">{{ i18n.t('password.current_password') }}</label>
                                <input
                                    id="current_password"
                                    class="w-full mt-2 border-gray-200 rounded-md focus:border-indigo-600 focus:ring focus:ring-opacity-40 focus:ring-indigo-500"
                                    type="password"
                                    v-model="password.current_password"
                                />
                            </div>

                            <div>
                                <label class="text-gray-700" for="password"
                                >{{ i18n.t('password.password') }}</label
                                >
                                <input
                                    id="password"
                                    class="w-full mt-2 border-gray-200 rounded-md focus:border-indigo-600 focus:ring focus:ring-opacity-40 focus:ring-indigo-500"
                                    type="password"
                                    v-model="password.password"
                                />
                            </div>
                            <div>
                                <label class="text-gray-700" for="password_confirmation"
                                >{{ i18n.t('password.password_confirmation') }}</label
                                >
                                <input
                                    id="password_confirmation"
                                    class="w-full mt-2 border-gray-200 rounded-md focus:border-indigo-600 focus:ring focus:ring-opacity-40 focus:ring-indigo-500"
                                    type="password"
                                    v-model="password.password_confirmation"
                                />
                            </div>
                        </div>

                        <div class="flex justify-end mt-4">
                            <el-button
                                :label="i18n.t('create.save')"
                                @click="register"
                                add-css="px-4 py-2 text-gray-200 bg-gray-800 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">
                            </el-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import {computed, defineComponent, onMounted, ref, reactive, toRefs} from 'vue'
import {UpdatePasswordInterface} from '../models/user/updatePassword.interface'
import {useI18n} from 'vue-i18n';
import apiClient from "../api-client";
import ElButton from "../components/primitives/buttons/ElButton.vue";
import {UserInterface} from "@/models/user/user.interface";
import {MutationType} from "@/models/store";
import {AxiosError} from "axios";
import {ErrorHandler} from "../plugins/error-handler/ErrorHandler";
import {notify} from "../components/notifications";
import {NotifyTypes} from "../components/notifications/NotifyTypes";

export default defineComponent({
    name: "ChangePassword",
    components: {
        ElButton
    },
    setup() {
        const i18n = useI18n()
        const password:UpdatePasswordInterface = {
            current_password: "",
            password: "",
            password_confirmation: ""
        }

        function register() {
            apiClient.user.updatePassword(password).then((data) => {
                notify({
                    title: 'Password successfully updated!',
                    message: "You have successfully updated your password!",
                    type: NotifyTypes.success
                })
            }).catch((error: Error | AxiosError) => {
                ErrorHandler(error);
            })
        }

        return {
            i18n, password, register
        }
    }
})
</script>

<style scoped>

</style>
