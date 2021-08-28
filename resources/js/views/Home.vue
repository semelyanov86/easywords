<template>
<div class="home">
    <h1>{{ i18n.t('welcome') }}</h1>
    <h1>HOME</h1>
    <div v-if="settings">
        <language-list :languages="settings.languages_list" :main_language="settings.main_language"></language-list>
    </div>
    <div v-else>
        <p>loading...</p>
    </div>
</div>
</template>

<script lang="ts">
import {defineComponent, reactive, computed, onMounted} from "vue";
import { MutationType, StoreModuleNames } from '../models/store'
import LanguageList from "../components/settings/LanguageList.vue";
import {useSettingsStore} from "../store/settings";
import { SettingInterface } from '../models/settings/setting.interface'
import { SettingsMutationType } from "../models/store/settings/SettingsMutationType";
import {useI18n} from 'vue-i18n';

export default defineComponent({
    name: "Home",
    components: {
        LanguageList
    },
    setup() {
        // private:
        const settingsStore = useSettingsStore()

        const settings = computed(() => {
            return settingsStore.state.settings
        })
        const loading = computed(() => {
            return settingsStore.state.loading
        })
        // methods:
        const onSelectSetting = (item: SettingInterface) => {
            console.log(item)
            /*settingsStore.action(MutationType.settings.selectItem, {
                id: item.id,
                selected: !item.selected
            })*/
        }
        // lifecycle event handlers:
        onMounted(() => {
            settingsStore.action(MutationType.settings.loadSettings)
        })
        const i18n = useI18n()

        return {
            settings, i18n
        }
    }
})
</script>

<style scoped>

</style>
