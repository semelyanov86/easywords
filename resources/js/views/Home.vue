<template>
<div class="home">
    <div v-if="settings">
        <language-list :languages="settings.languages_list" :main_language="settings.main_language"></language-list>
    </div>
    <div v-else>
        <loader :show="true"></loader>
    </div>
    <footer class="mt-10 text-gray-600 body-font">
        <div class="text-center">
            <img src="images/easywords-full.png" alt="EasyWords">
        </div>
    </footer>
</div>
</template>

<script lang="ts">
import {defineComponent, reactive, computed, onMounted} from "vue";
import { MutationType, StoreModuleNames } from '../models/store'
import LanguageList from "../components/settings/LanguageList.vue";
import {useSettingsStore} from "../store/settings";
import {useUserStore} from "../store/user";
import { SettingInterface } from '../models/settings/setting.interface'
import Loader from '../components/shared/Loader.component.vue'
import { SettingsMutationType } from "../models/store/settings/SettingsMutationType";
import {useI18n} from 'vue-i18n';

export default defineComponent({
    name: "Home",
    components: {
        LanguageList, Loader
    },
    setup() {
        // private:
        const settingsStore = useSettingsStore()
        const userStore = useUserStore()

        const settings = computed(() => {
            return settingsStore.state.settings
        })
        const user = computed(() => {
            return userStore.state.user
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
            userStore.action(MutationType.user.loadUser)
        })
        const i18n = useI18n()

        return {
            settings, i18n, user
        }
    }
})
</script>

<style scoped>

</style>
