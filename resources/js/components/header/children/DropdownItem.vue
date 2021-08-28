<template>
    <router-link
        :to="{name: name}"
        class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white"
    >{{ i18n.t(name) }}</router-link
    >
</template>

<script>
import {computed, defineComponent, PropType, ref} from "vue";
import {useI18n} from 'vue-i18n';

export default defineComponent({
    name: "DropdownItem",
    props: {
        title: {
            type: String
        },
        name: {
            type: String
        }
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
