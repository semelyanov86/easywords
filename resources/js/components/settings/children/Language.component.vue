<template>
    <div class="mt-4">
        <div class="flex flex-wrap -mx-6">
            <div class="w-full px-6 sm:w-1/2 xl:w-1/3" @click="onClick(false)">
                <div
                    class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm"
                >
                    <div class="p-3 bg-indigo-600 bg-opacity-75 rounded-full">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </div>

                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-gray-700">{{ main_language }} -> {{ language }}</h4>
                    </div>
                </div>
            </div>

            <div class="w-full px-6 mt-6 sm:w-1/2 xl:w-1/3 sm:mt-0" @click="onClick(true)">
                <div
                    class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm"
                >
                    <div class="p-3 bg-blue-600 bg-opacity-75 rounded-full">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path></svg>
                    </div>

                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-gray-700">{{ language }} -> {{ main_language }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent, computed, PropType} from "vue";
import { TranslationInterface } from "@/models/settings/translation.interface";
import router from "../../../router";

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
            router.push({
                name: 'Words',
                params: {
                    parent: props.main_language,
                    target: props.language,
                    rev: is_reversed ? 'left' : 'right'
                }
            })
        }
        return {
            cssClass,
            onClick
        }
    }
})
</script>

<style scoped>
.w-full {
    cursor: pointer;
}
</style>
