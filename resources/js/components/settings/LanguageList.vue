<template>
<div class="container mx-auto px-6 py-8">
    <h3 class="text-3xl font-medium text-gray-700">{{ i18n.t('languageList.chooseLanguage') }}</h3>
    <ul>
        <language v-for="language in languages" :key="language" :main_language="main_language" :language="language" @select="onLanguageSelect">

        </language>
    </ul>
</div>
</template>

<script lang="ts">
import {defineComponent, PropType, ref} from 'vue'
import Language from './children/Language.component.vue'
import {TranslationInterface} from "@/models/settings/translation.interface";
import {useI18n} from 'vue-i18n';

export default defineComponent({
    name: "LanguageList",
    components: {
        Language
    },
    props: {
        languages: {
            type: Array as PropType<string[]>
        },
        main_language: {
            type: String,
            default: 'RU'
        }
    },
    setup() {
        const i18n = useI18n()
        let selectedLanguage = ref('DE');
        const onLanguageSelect = (language: TranslationInterface) => {
            selectedLanguage.value = language.translated
        }
        return {
            onLanguageSelect, selectedLanguage, i18n
        }
    }
})
</script>

<style scoped>

</style>
