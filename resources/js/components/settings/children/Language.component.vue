<template>
    <li :class="cssClass" @click="onClick(false)">
        {{ main_language }} -> {{ language }}
    </li>
</template>

<script lang="ts">
import { defineComponent, computed, PropType} from "vue";
import { TranslationInterface } from "@/models/settings/translation.interface";

export default defineComponent({
    name: "Language",
    props: {
        language: {
            type: String,
            required: true
        },
        main_language: {
            type: String,
            required: true
        }
    },
    emits: ['select'],
    setup(props, { emit }) {
        const cssClass = computed(() => {
            let css = 'item';
            return css.trim();
        })
        const onClick = (is_reversed:boolean = false) => {
            const result: TranslationInterface = {
                translated: props.language,
                main_language: props.main_language,
                reverse_direction: is_reversed
            }
            emit('select', result);
        }
        return {
            cssClass,
            onClick
        }
    }
})
</script>

<style scoped>

</style>
