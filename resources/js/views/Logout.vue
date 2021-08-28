<template>
    <h2>Logging Out...</h2>
</template>

<script lang="ts">
import {defineComponent, onMounted, ref} from "vue";
import {config} from "../config";
import router from "../router";

export default defineComponent({
    name: "Logout",
    setup() {
        onMounted(() => {
            const TOKEN_KEY = config.httpClient.tokenKey || 'myapp-token'
            localStorage.removeItem(TOKEN_KEY)
            router.push({ name: 'Login'})
        })
    }
})
</script>

<style scoped>

</style>
