<template>
    <div class="container mx-auto px-6 py-8">
        <loader :loading="isLoading"></loader>
        <h3 class="text-3xl font-semibold text-gray-700">{{ i18n.t('languageList.header') }}</h3>
        <div class="mt-4 mb-3">
            <h4 class="text-gray-700">{{ i18n.t('languageList.intro') }}</h4>
            <div class="max-w-sm mt-6 overflow-hidden bg-white rounded shadow-lg" v-if="word">
                <transition name="slide-fade" mode="out-in">
                    <div :key="word.id">
                        <div class="flex">
                            <div class="flex-auto">
                                <div :title="i18n.t('from_sample')" class="ml-3 text-blue-800" v-if="word.from_sample">
                                    <svg
                                        class="w-6 h-6"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"
                                        ></path>
                                    </svg>
                                </div>
                                <div :title="i18n.t('from_user')" class="ml-3 text-blue-800" v-else-if="word.shared_by">
                                    <svg
                                        class="w-6 h-6"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"
                                        ></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-auto">
                                <div class="ml-3 text-blue-800">
                                    <p>#{{ word.id }}</p>
                                </div>
                            </div>
                            <div class="flex-auto">
                                <div class="ml-3 text-blue-800">
                                    <p v-if="words">{{ current + 1 }} / {{ words.length }}</p>
                                </div>
                            </div>
                            <div class="flex-auto text-blue-800">
                                <share-component :id="word.id"></share-component>
                            </div>
                        </div>
                        <transition name="flip">
                            <div class="card" :key="getWordKeyTranslation">
                                <div class="px-6 py-4 mt-2">
                                    <div class="mb-2 text-2xl font-bold text-gray-900 text-left">
                                        {{ word[getWordKeyTranslation] }}
                                    </div>
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
        <footer class="text-gray-600 body-font" v-if="word">
            <div class="border-t border-gray-200">
                <div class="container px-5 py-8 flex flex-wrap mx-auto items-center">
                    <div class="flex md:flex-nowrap flex-wrap justify-center items-end md:justify-start">
                        <el-button
                            :label="word && word.done_at ? i18n.t('languageList.unknow') : i18n.t('languageList.know')"
                            @click="markKnown"
                            add-css="inline-flex text-white bg-red-500 border-0 py-3 px-6 focus:outline-none hover:bg-indigo-600 rounded mt-3"
                        >
                        </el-button>
                        <el-button
                            :label="i18n.t('languageList.show')"
                            @click="showTranslation"
                            add-css="inline-flex text-white bg-yellow-500 border-0 py-3 px-6 focus:outline-none hover:bg-indigo-600 rounded mt-3"
                        >
                        </el-button>
                        <el-button
                            :label="i18n.t('languageList.prev')"
                            @click="showPrev"
                            :disabled="prev === null"
                            add-css="inline-flex text-white bg-blue-600 border-0 py-3 px-6 focus:outline-none hover:bg-indigo-600 rounded mt-3"
                        >
                        </el-button>
                        <el-button
                            :label="i18n.t('languageList.next')"
                            @click="showNext"
                            add-css="inline-flex text-white bg-indigo-500 border-0 py-3 px-6 focus:outline-none hover:bg-indigo-600 rounded mt-3"
                        >
                        </el-button>
                    </div>
                    <span class="inline-flex lg:ml-auto lg:mt-0 mt-1 w-full justify-center md:justify-start md:w-auto">
                    </span>
                </div>
            </div>
            <div class="bg-gray-100">
                <div class="container mx-auto py-2 px-5 flex flex-wrap flex-col sm:flex-row">
                    <p class="text-gray-500 text-sm text-center sm:text-left">
                        © 2021 EasyWords —
                        <a
                            href="https://sergeyem.ru"
                            class="text-gray-600 ml-1"
                            target="_blank"
                            rel="noopener noreferrer"
                            >Sergey Emelyanov</a
                        >
                    </p>
                    <span
                        class="sm:ml-auto sm:mt-0 mt-2 sm:w-auto w-full sm:text-left text-center text-gray-500 text-sm"
                        >Learn words faster!</span
                    >
                </div>
            </div>
        </footer>
    </div>
</template>

<script lang="ts">
    import { computed, defineComponent, onMounted, ref, reactive } from 'vue';
    import { useSettingsStore } from '../store/settings';
    import { useI18n } from 'vue-i18n';
    import Loader from '../components/shared/Loader.component.vue';
    import { useWordsStore } from '../store/words';
    import ElButton from '../components/primitives/buttons/ElButton.vue';
    import { WordInterface } from '../models/words/Word.interface';
    import VueFlip from 'vue-flip';
    import CardButtons from '../components/words/CardButtons.vue';
    import NoWordsFound from '../components/words/NoWordsFound.vue';
    import ShareComponent from '../components/words/ShareComponent.vue';
    import getNextWord from '../services/getNextWord';
    import { WordsMutationType } from '@/models/store/words/WordsMutationType';
    import nextWord = WordsMutationType.nextWord;

    export default defineComponent({
        name: 'Words',
        components: {
            Loader,
            ElButton,
            VueFlip,
            CardButtons,
            NoWordsFound,
            ShareComponent,
        },
        props: {
            parent: {
                type: String,
                required: true,
            },
            target: {
                type: String,
                required: true,
            },
            rev: {
                type: String,
                required: true,
            },
        },
        setup(props) {
            const settingsStore = useSettingsStore();
            const wordsStore = useWordsStore();
            const showTranslate = ref<boolean>(false);
            const flipped = ref<boolean>(false);
            const index = ref<number>(1);
            let prev = ref<number | null>(null);
            let word = ref<WordInterface | null>(null);

            function showNext() {
                setNulls();
                prev.value = current.value;
                index.value++;
                generateWord();
            }

            const current = computed<number>(() => {
                if (!word || !word.value) {
                    return 0;
                }
                return wordsStore.state.words.findIndex((wordFound) => {
                    if (!word.value) {
                        return false;
                    }
                    return wordFound.original === word.value.original;
                });
            });

            function setNulls() {
                flipped.value = false;
                showTranslate.value = false;
            }

            function showPrev() {
                setNulls();
                if (prev.value) {
                    word.value = words.value[prev.value];
                    index.value--;
                }
                prev.value = null;
            }

            const settings = computed(() => {
                return settingsStore.state.settings;
            });

            const words = computed(() => {
                return wordsStore.state.words;
            });

            const isLoading = computed(() => {
                return wordsStore.state.loading;
            });

            function generateWord() {
                word.value = getNextWord(current.value, prev.value, index.value);
            }

            const getWordKeyTranslation = computed(() => {
                if (showTranslate.value) {
                    if (props.rev === 'right') {
                        return 'translated';
                    } else {
                        return 'original';
                    }
                } else {
                    if (props.rev === 'right') {
                        return 'original';
                    } else {
                        return 'translated';
                    }
                }
            });

            const i18n = useI18n();

            function receiveWords() {
                wordsStore
                    .actionAsync('loadWords', {
                        language: props.target,
                    })
                    .then((words) => (word.value = words[0]));
            }

            function showTranslation() {
                if (!word.value) {
                    return;
                }
                flipped.value = !flipped.value;
                showTranslate.value = !showTranslate.value;
                if (showTranslate.value) {
                    wordsStore.action('markViewed', word.value.id);
                }
            }

            function markKnown() {
                setNulls();
                if (!word.value) {
                    return;
                }
                wordsStore.action('markKnown', {
                    id: word.value.id,
                    value: word.value.done_at ? 0 : 1,
                });
                prev.value = null;
                showNext();
            }

            onMounted(() => {
                receiveWords();
            });

            return {
                i18n,
                isLoading,
                word,
                showTranslate,
                getWordKeyTranslation,
                showTranslation,
                flipped,
                showNext,
                markKnown,
                index,
                words,
                showPrev,
                prev,
                current,
            };
        },
    });
</script>

<style>
    .front {
        margin-left: 20%;
    }
    .slide-fade-enter-active {
        transition: all 0.1s ease;
    }
    .slide-fade-leave-active {
        transition: all 0.4s cubic-bezier(1, 0.5, 0.8, 1);
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

    .flip-enter-from,
    .flip-leave-to {
        transform: rotateY(180deg);
        opacity: 0;
    }
</style>
