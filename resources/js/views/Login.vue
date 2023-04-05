<template>
    <div class="body-bg min-h-screen pt-12 md:pt-20 pb-6 px-2 md:px-0" style="font-family: 'Lato', sans-serif">
        <header class="max-w-lg mx-auto">
            <a href="#">
                <h1 class="text-4xl font-bold text-white text-center">EasyWords</h1>
            </a>
        </header>

        <main class="bg-white max-w-lg mx-auto p-8 md:p-12 my-10 rounded-lg shadow-2xl">
            <section>
                <h3 class="font-bold text-2xl">Easy application for quick learning new words</h3>
                <p class="text-gray-600 pt-2">Sign in to your account.</p>
            </section>

            <section class="mt-10">
                <form class="flex flex-col" v-on:submit.prevent="onLogin">
                    <div class="mb-6 pt-3 rounded bg-gray-200">
                        <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="email">Email</label>
                        <input
                            type="text"
                            id="email"
                            class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-purple-600 transition duration-500 px-3 pb-3"
                            v-model="email"
                        />
                    </div>
                    <div class="mb-6 pt-3 rounded bg-gray-200">
                        <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="password">Password</label>
                        <input
                            type="password"
                            id="password"
                            class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-purple-600 transition duration-500 px-3 pb-3"
                            v-model="password"
                        />
                    </div>
                    <div class="flex justify-end">
                        <a href="/admin" class="text-sm text-purple-600 hover:text-purple-700 hover:underline mb-6"
                            >Forgot your password?</a
                        >
                    </div>
                    <button
                        class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 rounded shadow-lg hover:shadow-xl transition duration-200"
                        type="submit"
                    >
                        Sign In
                    </button>
                </form>
            </section>
            <div class="mt-3 text-center">
                <span class="text-xs">Get the app. Currently support only APK.</span>
                <div class="flex mt-3 space-x-2 justify-center">
                    <a href="apps/flutter_apk/app.apk"
                        ><svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"
                            /></svg
                    ></a>
                </div>
            </div>
        </main>

        <footer class="max-w-lg mx-auto flex justify-center text-white">Author: Sergey Emelyanov</footer>
    </div>
</template>

<script lang="ts">
    import { defineComponent, ref } from 'vue';
    import apiClient from '../api-client';
    import router from '../router';
    import { TokenInterface } from '@/models/auth/TokenInterface';
    import { config } from '../config';
    import { notify } from '../components/notifications';
    import { NotifyTypes } from '../components/notifications/NotifyTypes';
    import { AxiosError } from 'axios';
    import axios from 'axios';
    // import the styling for the toast
    import 'mosha-vue-toastify/dist/style.css';

    export default defineComponent({
        name: 'Login',
        setup() {
            const email = ref('');
            const password = ref('');
            const onLogin = () => {
                const authData = {
                    email: email.value,
                    password: password.value,
                    device_name: 'Vue',
                };
                apiClient.auth
                    .doLogin(authData)
                    .then((data: TokenInterface) => {
                        const TOKEN_KEY = config.httpClient.tokenKey || 'myapp-token';
                        localStorage.setItem(TOKEN_KEY, data.token);
                        router.push({ name: 'Home' });
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
                            title: 'Error during login',
                            message: message,
                            type: NotifyTypes.danger,
                        });
                    });
            };
            return {
                email,
                password,
                onLogin,
            };
        },
    });
</script>

<style scoped>
    .body-bg {
        background-color: #9921e8;
        background-image: linear-gradient(315deg, #9921e8 0%, #5f72be 74%);
    }
</style>
