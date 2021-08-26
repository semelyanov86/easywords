<template>
<div>
    <h1>Select your language</h1>
    <h3>Current language: {{ selectedLanguage }}</h3>
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
        let selectedLanguage = ref('DE');
        const onLanguageSelect = (language: TranslationInterface) => {
            selectedLanguage.value = language.translated
        }
        return {
            onLanguageSelect, selectedLanguage
        }
    }
})
</script>

<style scoped>

</style>
