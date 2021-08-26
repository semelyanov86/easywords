<template>
<div class="home">
    <h1>HOME</h1>
    <language-list :languages="settings.languages_list" :main_language="settings.main_language"></language-list>
</div>
</template>

<script lang="ts">
import {defineComponent} from "vue";
import LanguageList from "../components/settings/LanguageList.vue";
import {SettingInterface} from "../models/settings/setting.interface";

export default defineComponent({
    name: "Home",
    components: {
        LanguageList
    },
    setup() {
        const settings: SettingInterface = {
            "paginate": "40",
            "default_language": "EN",
            "starred_enabled": false,
            "known_enabled": false,
            "fresh_first": false,
            "languages_list": [
                "DE",
                "EN"
            ],
            "main_language": "RU"
        }
        return {
            settings
        }
    }
})
</script>

<style scoped>

</style>
