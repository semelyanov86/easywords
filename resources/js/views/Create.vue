<template>
<div class="container mx-auto px-6 py-8">
    <h3 class="text-3xl font-semibold text-gray-700">{{ i18n.t('create.header') }}</h3>
    <div class="mt-8">
        <h4 class="text-gray-600">{{ i18n.t('create.short')}}</h4>

        <div class="mt-4">
            <div class="p-6 bg-white rounded-md shadow-md">
                <h2 class="text-lg font-semibold text-gray-700 capitalize">
                    {{ i18n.t('create.fill-data') }}
                </h2>

                <form @submit.prevent="register">
                    <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                        <div>
                            <label class="text-gray-700" for="original">{{ i18n.t('create.original') }}</label>
                            <input
                                id="original"
                                class="w-full mt-2 border-gray-200 rounded-md focus:border-indigo-600 focus:ring focus:ring-opacity-40 focus:ring-indigo-500"
                                type="text"
                                v-model="word.original"
                            />
                        </div>

                        <div>
                            <label class="text-gray-700" for="translated"
                            >{{ i18n.t('create.translated') }}</label
                            >
                            <input
                                id="translated"
                                class="w-full mt-2 border-gray-200 rounded-md focus:border-indigo-600 focus:ring focus:ring-opacity-40 focus:ring-indigo-500"
                                type="text"
                                v-model="word.translated"
                            />
                        </div>
                        <div>
                            <label class="text-gray-700" for="language"
                            >{{ i18n.t('create.language') }}</label
                            >
                            <select
                                id="language"
                                class="w-full mt-2 border-gray-200 rounded-md focus:border-indigo-600 focus:ring focus:ring-opacity-40 focus:ring-indigo-500"
                                v-model="word.language">
                                <option :value="language" v-for="language in settings.languages_list" :key="language">{{ language }}</option>
                            </select>
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
import {useI18n} from 'vue-i18n';
import {WordInterface} from "@/models/words/Word.interface";
import {useWordsStore} from "../store/words";
import {useSettingsStore} from "../store/settings";
import {useUserStore} from "../store/user";
import ElButton from "../components/primitives/buttons/ElButton.vue"
import {LoadedWordInterface} from "@/models/words/LoadedWord.interface";

export default defineComponent({
    name: "Create",
    components: {
        ElButton
    },
    setup() {
        const i18n = useI18n()
        const settingsStore = useSettingsStore()
        const userStore = useUserStore()
        const wordsStore = useWordsStore()

        const settings = computed(() => {
            return settingsStore.state.settings
        })
        const user = computed(() => {
            return userStore.state.user
        })

        const word:WordInterface = reactive({
            id: 1,
            user_id: user.value.id,
            original: "",
            translated: "",
            done_at: null,
            starred: false,
            language: settings.value.default_language,
            views: 0,
            created_at: new Date().toISOString(),
        })

        function register() {
            wordsStore.action('createWord', word)
            word.original = '';
            word.translated = '';
        }

        return {
            i18n, word, settings, register
        }
    }
})
</script>

<style scoped>

</style>
