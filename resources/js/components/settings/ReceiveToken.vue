<template>
    <section class="text-gray-600 body-font relative mt-2">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col text-center w-full mb-12" v-if="accessToken == ''">
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">
                    {{ $t('user.generate_personal_token') }}
                </h1>
                <p class="lg:w-2/3 mx-auto leading-relaxed text-base">{{ $t('user.token_description') }}</p>
            </div>
            <div class="flex flex-col text-center w-full mb-12" v-if="accessToken != ''">
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">
                    {{ $t('user.token_exists') }}
                </h1>
                <p class="lg:w-2/3 mx-auto leading-relaxed text-base">
                    <code>{{ accessToken }}</code>
                </p>
            </div>
            <div class="lg:w-1/2 md:w-2/3 mx-auto" v-if="accessToken == ''">
                <div class="flex flex-wrap -m-2">
                    <div class="p-2 w-1/2">
                        <div class="relative">
                            <label for="email" class="leading-7 text-sm text-gray-600">{{ $t('user.email') }}</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                v-model="email"
                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            />
                        </div>
                    </div>
                    <div class="p-2 w-1/2">
                        <div class="relative">
                            <label for="password" class="leading-7 text-sm text-gray-600">{{
                                $t('user.password')
                            }}</label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                v-model="password"
                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            />
                        </div>
                    </div>
                    <div class="p-2 w-full">
                        <div class="relative">
                            <label for="device_name" class="leading-7 text-sm text-gray-600">{{
                                $t('user.device_name')
                            }}</label>
                            <input
                                id="device_name"
                                name="device_name"
                                v-model="deviceName"
                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"
                            />
                        </div>
                    </div>
                    <div class="p-2 w-full">
                        <button
                            class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg"
                            @click="onAskToken()"
                        >
                            {{ $t('user.generate_token') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script lang="ts">
    import { defineComponent, ref } from 'vue';
    import apiClient from '@/api-client';
    import { TokenInterface } from '@/models/auth/TokenInterface';
    import axios, { AxiosError } from 'axios';
    import { notify } from '@/components/notifications';
    import { NotifyTypes } from '@/components/notifications/NotifyTypes';

    export default defineComponent({
        name: 'ReceiveToken',
        setup() {
            const email = ref('');
            const password = ref('');
            const deviceName = ref('chat_bot');
            const accessToken = ref('');

            const onAskToken = () => {
                const authData = {
                    email: email.value,
                    password: password.value,
                    device_name: deviceName.value,
                };
                if (deviceName.value.length < 3 || deviceName.value.length > 30) {
                    notify({
                        title: 'Wrong device name',
                        message: 'Please enter correct device name',
                        type: NotifyTypes.danger,
                    });
                    return;
                }
                apiClient.auth
                    .doLogin(authData)
                    .then((data: TokenInterface) => {
                        accessToken.value = data.token;
                    })
                    .catch((error: Error | AxiosError) => {
                        let message: string;
                        if (axios.isAxiosError(error)) {
                            if (error.response) {
                                /*
                                 * The request was made and the server responded with a
                                 * status code that falls out of the range of 2xx
                                 */
                                message = error.response.data.message;
                            } else if (error.request) {
                                /*
                                 * The request was made but no response was received, `error.request`
                                 * is an instance of XMLHttpRequest in the browser and an instance
                                 * of http.ClientRequest in Node.js
                                 */
                                message = error.request;
                            } else {
                                // Something happened in setting up the request and triggered an Error
                                message = 'Error: ' + error.message;
                            }
                        } else {
                            message = 'Error: ' + error.message;
                        }

                        console.log(error);
                        notify({
                            title: 'Error during getting token',
                            message: message,
                            type: NotifyTypes.danger,
                        });
                    });
            };

            return { email, password, deviceName, accessToken, onAskToken };
        },
    });
</script>

<style scoped></style>
