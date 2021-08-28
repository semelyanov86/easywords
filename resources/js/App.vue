<template>
    <div>
        <Header v-if="!isLogin"></Header>
        <router-view></router-view>
    </div>
</template>

<script lang="ts">
import {computed, defineComponent, ref} from "vue"
import Home from "./views/Home.vue";
import {useI18n} from 'vue-i18n';
import Header from "./components/header/Header.vue";
import { useRouter, useRoute } from 'vue-router'

export default defineComponent({
    name: "App",
    components: {
        Home, Header
    },
    setup() {
        const i18n = useI18n()

        const route = useRoute()
        const isLogin = computed(() => {
            return route.name === 'Login'
        })

        return {
            i18n, isLogin
        }
    }
})
</script>

<style scoped>

</style>
