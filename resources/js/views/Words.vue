<template>
    <div class="container mx-auto px-6 py-8">
        <loader :loading="isLoading"></loader>
        <h3 class="text-3xl font-semibold text-gray-700">{{ i18n.t('languageList.header') }}</h3>
        <div class="mt-4 mb-3">
            <h4 class="text-gray-700">{{ i18n.t('languageList.intro') }}</h4>
            <div class="max-w-sm mt-6 overflow-hidden bg-white rounded shadow-lg" v-if="word">
                <transition name="slide-fade" mode="out-in">
                    <div :key="word.id">
                        <transition name="flip">
                            <div class="card" :key="getWordKeyTranslation">
                                <div class="px-6 py-4">
                                    <div class="mb-2 text-2xl font-bold text-gray-900 text-left">{{ word[getWordKeyTranslation] }}</div>
                                </div>
                                <card-buttons :word="word"></card-buttons>
                            </div>
                        </transition>

                    </div>
                </transition>
            </div>
            <div v-else>
                <no-words-found :target="target"></no-words-found>
            </div>
        </div>
        <footer class="text-gray-600 body-font">
            <div class="border-t border-gray-200">
                <div class="container px-5 py-8 flex flex-wrap mx-auto items-center">
                    <div class="flex md:flex-nowrap flex-wrap justify-center items-end md:justify-start">
                        <el-button
                            :label="word && word.done_at ? i18n.t('languageList.unknow') : i18n.t('languageList.know')"
                            @click="markKnown"
                            add-css="inline-flex text-white bg-red-500 border-0 py-3 px-6 focus:outline-none hover:bg-indigo-600 rounded mt-3">
                        </el-button>
                        <el-button
                            :label="i18n.t('languageList.show')"
                            @click="showTranslation"
                            add-css="inline-flex text-white bg-yellow-500 border-0 py-3 px-6 focus:outline-none hover:bg-indigo-600 rounded mt-3">
                        </el-button>
                        <el-button
                            :label="i18n.t('languageList.next')"
                            @click="showNext"
                            add-css="inline-flex text-white bg-indigo-500 border-0 py-3 px-6 focus:outline-none hover:bg-indigo-600 rounded mt-3">
                        </el-button>
                    </div>
                    <span class="inline-flex lg:ml-auto lg:mt-0 mt-6 w-full justify-center md:justify-start md:w-auto">
      </span>
                </div>
            </div>
            <div class="bg-gray-100">
                <div class="container mx-auto py-4 px-5 flex flex-wrap flex-col sm:flex-row">
                    <p class="text-gray-500 text-sm text-center sm:text-left">© 2021 EasyWords —
                        <a href="https://sergeyem.ru" class="text-gray-600 ml-1" target="_blank" rel="noopener noreferrer">Sergey Emelyanov</a>
                    </p>
                    <span class="sm:ml-auto sm:mt-0 mt-2 sm:w-auto w-full sm:text-left text-center text-gray-500 text-sm">Learn words faster!</span>
                </div>
            </div>
        </footer>
    </div>
</template>

<script lang="ts">
import {computed, defineComponent, onMounted, ref, reactive} from 'vue'
import {useSettingsStore} from "../store/settings";
import {useI18n} from 'vue-i18n';
import Loader from '../components/shared/Loader.component.vue'
import {useWordsStore} from "../store/words";
import ElButton from "../components/primitives/buttons/ElButton.vue"
import { WordInterface } from "../models/words/Word.interface";
import VueFlip from 'vue-flip';
import CardButtons from '../components/words/CardButtons.vue'
import NoWordsFound from '../components/words/NoWordsFound.vue'

export default defineComponent({
    name: "Words",
    components: {
        Loader, ElButton, VueFlip, CardButtons, NoWordsFound
    },
    props: {
        parent: {
            type: String,
            required: true
        },
        target: {
            type: String,
            required: true
        },
        rev: {
            type: String,
            required: true
        }
    },
    setup(props) {
        const settingsStore = useSettingsStore()
        const wordsStore = useWordsStore()
        const showTranslate = ref<boolean>(false);
        const flipped = ref<boolean>(false)

        let current = ref<number>(0);

        function showNext() {
            flipped.value = false
            showTranslate.value = false
            current.value++;
        }

        const settings = computed(() => {
            return settingsStore.state.settings
        })

        const words = computed(() => {
            return wordsStore.state.words
        })

        const isLoading = computed(() => {
            return wordsStore.state.loading
        })

        const word = computed(() => {
            if (current.value > words.value.length-1) {
                const curIndex = Math.floor(Math.random() * (words.value.length));
                return words.value[curIndex]
            }
            return words.value[current.value]
        })

        const getWordKeyTranslation = computed(() => {
            if (showTranslate.value) {
                if (props.rev === 'right') {
                    return 'translated'
                } else {
                    return 'original'
                }
            } else {
                if (props.rev === 'right') {
                    return 'original'
                } else {
                    return 'translated'
                }
            }
        })

        const i18n = useI18n()

        function receiveWords() {
            wordsStore.action('loadWords', {
                language: props.target
            })
        }

        function showTranslation() {
            flipped.value = !flipped.value
            showTranslate.value = !showTranslate.value
            if (showTranslate.value) {
                wordsStore.action('markViewed', word.value.id)
            }
        }

        function markKnown() {
            wordsStore.action('markKnown', {
                id: word.value.id,
                value: word.value.done_at ? 0 : 1
            })
        }

        onMounted(() => {
            receiveWords();
        });

        return {
            i18n, isLoading, word, showTranslate, getWordKeyTranslation, showTranslation, flipped, showNext,
            markKnown
        }
    }
})
</script>

<style>
.front {
    margin-left: 20%;
}
.slide-fade-enter-active {
    transition: all .1s ease;
}
.slide-fade-leave-active {
    transition: all .4s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}
.slide-fade-enter, .slide-fade-leave-to
    /* .slide-fade-leave-active for <2.1.8 */ {
    transform: translateX(10px);
    opacity: 0;
}
.card {
    text-align: center;
    will-change: transform;
}
.flip-enter-active {
    transition: all 0.4s ease;
}

.flip-leave-active {
    display: none;
}

.flip-enter-from, .flip-leave-to {
    transform: rotateY(180deg);
    opacity: 0;

}
</style>
