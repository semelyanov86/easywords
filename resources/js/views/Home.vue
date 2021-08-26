<template>
<div class="home">
    <h1>HOME</h1>
</div>
</template>

<script lang="ts">
import {defineComponent} from "vue";
import LanguageList from "../components/settings/LanguageList.vue";

export default defineComponent({
    name: "Home",
    components: {
        LanguageList
    },
    setup() {
        const settings: any = {
            "paginate": "40",
            "default_language": "EN",
            "starred_enabled": false,
            "known_enabled": false,
            "fresh_first": false,
            "languages_list": [
                "DE",
                "EN"
            ]
        }
        return {
            settings
        }
    }
})
</script>

<style scoped>

</style>
