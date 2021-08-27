<template>
    <div>
        <router-view></router-view>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref } from "vue"
import Home from "./views/Home.vue";
import {useI18n} from 'vue-i18n';

export default defineComponent({
    name: "App",
    components: {
        Home
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
