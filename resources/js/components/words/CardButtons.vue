<template>
    <div class="flex items-center justify-between px-5 py-3">
        <el-button
            :label="i18n.t('languageList.delete')"
            add-css="px-3 py-1 text-sm text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none">
        </el-button>
        <el-button
            :label="i18n.t('languageList.star')"
            @click="makeStar"
            add-css="px-3 py-1 text-sm text-white bg-indigo-600 rounded-md hover:bg-indigo-500 focus:outline-none">
        </el-button>
    </div>
</template>

<script lang="ts">
import {computed, defineComponent, onMounted, ref, reactive} from 'vue'
import ElButton from "../primitives/buttons/ElButton.vue"
import {useI18n} from 'vue-i18n';
import {useWordsStore} from "../../store/words";

export default defineComponent({
    name: "CardButtons",
    props: {
        id: {
            type: Number,
            required: true
        }
    },
    components: {
        ElButton
    },
    setup(props) {
        const i18n = useI18n()
        const wordsStore = useWordsStore()

        function makeStar() {
            wordsStore.action('markStarred', props.id)
        }
        function deleteWord() {
            wordsStore.action('deleteWord', props.id)
        }
        return {
            i18n, makeStar
        }
    }
})
</script>

<style scoped>

</style>
