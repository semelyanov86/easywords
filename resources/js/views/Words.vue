<template>
    <h2>Words from {{ parent }} TO {{ target }}</h2>
</template>

<script lang="ts">
import {computed, defineComponent, onMounted, ref, reactive} from 'vue'
import {useSettingsStore} from "../store/settings";
import {useI18n} from 'vue-i18n';

export default defineComponent({
    name: "Words",
    props: {
        parent: {
            type: String,
            required: true
        },
        target: {
            type: String,
            required: true
        },
        rev: {
            type: String,
            required: true
        }
    },
    setup() {
        const settingsStore = useSettingsStore()
        const settings = computed(() => {
            return settingsStore.state.settings
        })

        const i18n = useI18n()

        return {
            i18n
        }
    }
})
</script>

<style scoped>

</style>
