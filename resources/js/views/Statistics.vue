<template>
    <div class="container mx-auto px-6 py-8">
        <loader :loading="loading"></loader>
        <h3 class="text-3xl font-medium text-gray-700">{{ i18n.t('statistics.header') }}</h3>

        <div class="mt-4">
            <div class="flex flex-wrap -mx-6">
                <div class="w-full px-6 sm:w-1/2 xl:w-1/3">
                    <div
                        class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm"
                    >
                        <div class="p-3 bg-indigo-600 bg-opacity-75 rounded-full">
                            <svg
                                class="w-8 h-8 text-white"
                                viewBox="0 0 28 30"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M18.2 9.08889C18.2 11.5373 16.3196 13.5222 14 13.5222C11.6804 13.5222 9.79999 11.5373 9.79999 9.08889C9.79999 6.64043 11.6804 4.65556 14 4.65556C16.3196 4.65556 18.2 6.64043 18.2 9.08889Z"
                                    fill="currentColor"
                                />
                                <path
                                    d="M25.2 12.0444C25.2 13.6768 23.9464 15 22.4 15C20.8536 15 19.6 13.6768 19.6 12.0444C19.6 10.4121 20.8536 9.08889 22.4 9.08889C23.9464 9.08889 25.2 10.4121 25.2 12.0444Z"
                                    fill="currentColor"
                                />
                                <path
                                    d="M19.6 22.3889C19.6 19.1243 17.0927 16.4778 14 16.4778C10.9072 16.4778 8.39999 19.1243 8.39999 22.3889V26.8222H19.6V22.3889Z"
                                    fill="currentColor"
                                />
                                <path
                                    d="M8.39999 12.0444C8.39999 13.6768 7.14639 15 5.59999 15C4.05359 15 2.79999 13.6768 2.79999 12.0444C2.79999 10.4121 4.05359 9.08889 5.59999 9.08889C7.14639 9.08889 8.39999 10.4121 8.39999 12.0444Z"
                                    fill="currentColor"
                                />
                                <path
                                    d="M22.4 26.8222V22.3889C22.4 20.8312 22.0195 19.3671 21.351 18.0949C21.6863 18.0039 22.0378 17.9556 22.4 17.9556C24.7197 17.9556 26.6 19.9404 26.6 22.3889V26.8222H22.4Z"
                                    fill="currentColor"
                                />
                                <path
                                    d="M6.64896 18.0949C5.98058 19.3671 5.59999 20.8312 5.59999 22.3889V26.8222H1.39999V22.3889C1.39999 19.9404 3.2804 17.9556 5.59999 17.9556C5.96219 17.9556 6.31367 18.0039 6.64896 18.0949Z"
                                    fill="currentColor"
                                />
                            </svg>
                        </div>

                        <div class="mx-5">
                            <h4 class="text-2xl font-semibold text-gray-700">{{ statistics.users_count }}</h4>
                            <div class="text-gray-500">{{ i18n.t('statistics.users_count')}}</div>
                        </div>
                    </div>
                </div>

                <div class="w-full px-6 mt-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
                    <div
                        class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm"
                    >
                        <div class="p-3 bg-blue-600 bg-opacity-75 rounded-full">
                            <svg
                                class="w-8 h-8 text-white"
                                viewBox="0 0 28 28"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </svg>
                        </div>

                        <div class="mx-5">
                            <h4 class="text-2xl font-semibold text-gray-700">{{ statistics.all }}</h4>
                            <div class="text-gray-500">{{ i18n.t('statistics.all')}}</div>
                        </div>
                    </div>
                </div>

                <div class="w-full px-6 mt-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
                    <div
                        class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm"
                    >
                        <div class="p-3 bg-pink-600 bg-opacity-75 rounded-full">
                            <svg
                                class="w-8 h-8 text-white"
                                viewBox="0 0 28 28"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                            </svg>
                        </div>

                        <div class="mx-5">
                            <h4 class="text-2xl font-semibold text-gray-700">{{ statistics.not_dones }}</h4>
                            <div class="text-gray-500">{{ i18n.t('statistics.not_dones')}}</div>
                        </div>
                    </div>
                </div>

                <div class="w-full px-6 mt-6 sm:w-1/2 xl:w-1/3 xl:mt-0" @click="showKnown">
                    <div
                        class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm"
                    >
                        <div class="p-3 bg-indigo-600 bg-opacity-75 rounded-full">
                            <svg
                                class="w-8 h-8 text-white"
                                viewBox="0 0 28 30"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 14l9-5-9-5-9 5 9 5z"></path><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path></svg>
                            </svg>
                        </div>

                        <div class="mx-5">
                            <h4 class="text-2xl font-semibold text-gray-700">{{ statistics.dones }}</h4>
                            <div class="text-gray-500">{{ i18n.t('statistics.dones')}}</div>
                        </div>
                    </div>
                </div>
                <div class="w-full px-6 mt-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
                    <div
                        class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm"
                    >
                        <div class="p-3 bg-blue-600 bg-opacity-75 rounded-full">
                            <svg
                                class="w-8 h-8 text-white"
                                viewBox="0 0 28 28"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </svg>
                        </div>

                        <div class="mx-5">
                            <h4 class="text-2xl font-semibold text-gray-700">{{ statistics.total_views }}</h4>
                            <div class="text-gray-500">{{ i18n.t('statistics.total_views')}}</div>
                        </div>
                    </div>
                </div>
                <div class="w-full px-6 mt-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
                    <div
                        class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm"
                    >
                        <div class="p-3 bg-pink-600 bg-opacity-75 rounded-full">
                            <svg
                                class="w-8 h-8 text-white"
                                viewBox="0 0 28 28"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                            </svg>
                        </div>

                        <div class="mx-5">
                            <h4 class="text-2xl font-semibold text-gray-700">{{ statistics.updated_this_month }}</h4>
                            <div class="text-gray-500">{{ i18n.t('statistics.updated_this_month')}}</div>
                        </div>
                    </div>
                </div>
                <div class="w-full px-6 mt-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
                    <div
                        class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm"
                    >
                        <div class="p-3 bg-blue-600 bg-opacity-75 rounded-full">
                            <svg
                                class="w-8 h-8 text-white"
                                viewBox="0 0 28 28"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            </svg>
                        </div>

                        <div class="mx-5">
                            <h4 class="text-2xl font-semibold text-gray-700">{{ statistics.updated_today }}</h4>
                            <div class="text-gray-500">{{ i18n.t('statistics.updated_today')}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8"></div>
        <h4 class="text-2xl font-medium text-gray-700">{{ i18n.t('statistics.most_viewed') }}</h4>

        <div class="flex flex-col mt-8">
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
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50"
                            >
                                {{ i18n.t('create.created_at') }}
                            </th>
                        </tr>
                        </thead>

                        <tbody class="bg-white">
                        <tr v-for="word in statistics.most_viewed" :key="word.id">
                            <td
                                class="px-6 py-4 border-b border-gray-200 whitespace-nowrap"
                            >
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium leading-5 text-gray-900">
                                            {{ word.original }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td
                                class="px-6 py-4 border-b border-gray-200 whitespace-nowrap"
                            >
                                <div class="text-sm leading-5 text-gray-900">
                                    {{ word.translated }}
                                </div>
                            </td>

                            <td
                                class="px-6 py-4 border-b border-gray-200 whitespace-nowrap"
                            >
                  <span
                      class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full"
                  >{{ word.views }}</span
                  >
                            </td>

                            <td
                                class="px-6 py-4 text-sm leading-5 text-gray-500 border-b border-gray-200 whitespace-nowrap"
                            >
                                {{ displayedDate(word.created_at) }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-8"></div>
        <h4 class="text-2xl font-medium text-gray-700">{{ i18n.t('statistics.added_today') }}</h4>

        <div class="flex flex-col mt-8">
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
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50"
                            >
                                {{ i18n.t('create.created_at') }}
                            </th>
                        </tr>
                        </thead>

                        <tbody class="bg-white">
                        <tr v-for="word in statistics.added_today" :key="word.id">
                            <td
                                class="px-6 py-4 border-b border-gray-200 whitespace-nowrap"
                            >
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium leading-5 text-gray-900">
                                            {{ word.original }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td
                                class="px-6 py-4 border-b border-gray-200 whitespace-nowrap"
                            >
                                <div class="text-sm leading-5 text-gray-900">
                                    {{ word.translated }}
                                </div>
                            </td>

                            <td
                                class="px-6 py-4 border-b border-gray-200 whitespace-nowrap"
                            >
                  <span
                      class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full"
                  >{{ word.views }}</span
                  >
                            </td>

                            <td
                                class="px-6 py-4 text-sm leading-5 text-gray-500 border-b border-gray-200 whitespace-nowrap"
                            >
                                {{ displayedDate(word.created_at) }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import {computed, defineComponent, onMounted, ref, reactive, Ref} from 'vue'
import {useI18n} from 'vue-i18n';
import apiClient from "../api-client";
import {AxiosError} from "axios";
import {ErrorHandler} from "../plugins/error-handler/ErrorHandler";
import {StatisticsDataInterface} from "../models/statistics/statisticsData.interface";
import Loader from '../components/shared/Loader.component.vue'
import router from "../router";

export default defineComponent({
    name: "Statistics",
    components: {
        Loader
    },
    setup() {
        const i18n = useI18n()
        let loading = ref(false)

        let statistics:Ref<StatisticsDataInterface> = ref({
            all: 0,
            starred: 0,
            not_dones: 0,
            dones: 0,
            total_views: 0,
            users_count: 0,
            updated_this_month: 0,
            updated_today: 0,
            most_viewed: [],
            added_today: []
        })

        function receiveStatistics() {
            loading.value = true
            apiClient.statistics.fetchStatistics().then((data) => {
                statistics.value = data
                console.log(statistics)
            }).catch((error: Error | AxiosError) => {
                ErrorHandler(error);
            }).finally(() => {
                loading.value = false
            })
        }

        function displayedDate(date:string) {
            return new Date(date).toLocaleDateString()
        }

        function showKnown() {
            router.push({
                name: 'KnownWords'
            })
        }

        onMounted(() => {
            receiveStatistics()
        })
        return {
            i18n, statistics, loading, displayedDate, showKnown
        }
    }
})
</script>

<style scoped>

</style>
