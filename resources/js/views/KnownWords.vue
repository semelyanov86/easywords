<template>
    <div class="container mx-auto px-6 py-8">
        <loader :loading="loading"></loader>
        <h3 class="text-3xl font-medium text-gray-700">{{ i18n.t('statistics.known_list') }}</h3>

        <div class="mt-8"></div>

        <div class="flex flex-col mt-8 mb-5">
            <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div
                    class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg"
                >
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50"
                                >
                                    {{ i18n.t('create.original') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50"
                                >
                                    {{ i18n.t('create.translated') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50"
                                >
                                    {{ i18n.t('create.views') }}
                                </th>
                            </tr>
                        </thead>

                        <tbody class="bg-white">
                            <tr v-for="word in words" :key="word.id">
                                <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium leading-5 text-gray-900">
                                                {{ word.original }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap">
                                    <div class="text-sm leading-5 text-gray-900">
                                        {{ word.translated }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap">
                                    <span
                                        class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full"
                                        >{{ word.views }}</span
                                    >
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <router-link
            class="font-bold py-1 px-2 border rounded text-white hover:bg-blue-400 inline-flex text-white bg-yellow-500 border-0 py-3 px-6 focus:outline-none hover:bg-indigo-600 rounded mt-3"
            :to="{ name: 'Statistics' }"
            >{{ i18n.t('statistics.go_back') }}</router-link
        >
    </div>
</template>

<script lang="ts">
    import { computed, defineComponent, onMounted, ref, reactive, Ref } from 'vue';
    import Loader from '../components/shared/Loader.component.vue';
    import { useI18n } from 'vue-i18n';
    import apiClient from '../api-client';
    import { AxiosError } from 'axios';
    import { ErrorHandler } from '../plugins/error-handler/ErrorHandler';
    import { WordInterface } from '../models/words/Word.interface';

    export default defineComponent({
        name: 'KnownWords',
        components: {
            Loader,
        },
        setup() {
            const i18n = useI18n();
            let loading = ref(false);
            let words = ref<WordInterface[]>([]);

            function receiveWords() {
                loading.value = true;
                apiClient.words
                    .knownWords()
                    .then((data) => {
                        words.value = data.data;
                    })
                    .catch((error: Error | AxiosError) => {
                        ErrorHandler(error);
                    })
                    .finally(() => {
                        loading.value = false;
                    });
            }

            onMounted(() => {
                receiveWords();
            });

            return {
                i18n,
                loading,
                words,
            };
        },
    });
</script>

<style scoped></style>
