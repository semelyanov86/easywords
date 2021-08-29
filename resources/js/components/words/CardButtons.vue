<template>
    <div class="flex items-center justify-between px-5 py-3">
        <el-button
            :label="i18n.t('languageList.delete')"
            add-css="px-3 py-1 text-sm text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none">
        </el-button>
        <el-button
            :label="i18n.t('languageList.star')"
            add-css="px-3 py-1 text-sm text-white bg-indigo-600 rounded-md hover:bg-indigo-500 focus:outline-none">
        </el-button>
    </div>
</template>

<script lang="ts">
import {computed, defineComponent, onMounted, ref, reactive} from 'vue'
import ElButton from "../primitives/buttons/ElButton.vue"
import {useI18n} from 'vue-i18n';

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
    setup() {
        const i18n = useI18n()
        return {
            i18n
        }
    }
})
</script>

<style scoped>

</style>
