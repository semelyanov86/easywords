<template>
<div>
    <h4 class="text-2xl font-semibold text-gray-700">{{ i18n.t('languageList.no-items') }}</h4>
    <button
        @click="updateData"
        class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg"
    >
        {{ i18n.t('languageList.update-words') }}</button>
</div>
</template>

<script>
import {computed, defineComponent, onMounted, ref, reactive} from 'vue'
import {useI18n} from 'vue-i18n';
import {useWordsStore} from "../../store/words";

export default defineComponent({
    name: "NoWordsFound",
    props: {
        target: {
            type: String,
            required: true
        },
    },
    setup(props) {
        const i18n = useI18n()
        const wordsStore = useWordsStore()
        function updateData() {
            wordsStore.action('loadWords', {
                language: props.target
            })
        }
        return {
            i18n, updateData
        }
    }
})
</script>

<style scoped>

</style>
