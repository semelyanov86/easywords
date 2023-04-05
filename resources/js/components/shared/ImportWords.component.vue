<template>
    <div>
        <loader :loading="loading"></loader>
        <div class="">
            {{ i18n.t('import.header') }}
            <div>
                <el-button
                    :label="i18n.t('import.button')"
                    @click="importWords"
                    add-css="inline-flex text-white bg-yellow-500 border-0 py-3 px-6 focus:outline-none hover:bg-indigo-600 rounded mt-3"
                >
                </el-button>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
    import { defineComponent, computed, ref } from 'vue';
    import Loader from './Loader.component.vue';
    import ElButton from '../primitives/buttons/ElButton.vue';
    import { useI18n } from 'vue-i18n';
    import apiClient from '../../api-client';
    import { AxiosError } from 'axios';
    import { ErrorHandler } from '../../plugins/error-handler/ErrorHandler';
    import { notify } from '../notifications';
    import { NotifyTypes } from '../notifications/NotifyTypes';

    export default defineComponent({
        name: 'ImportWords',
        props: {
            language: {
                type: String,
                default: 'DE',
            },
        },
        components: {
            Loader,
            ElButton,
        },
        setup(props) {
            const loading = ref(false);

            const importWords = () => {
                loading.value = true;
                apiClient.words
                    .importWords(props.language)
                    .then((data) => {
                        notify({
                            title: 'Words successfully imported for language ' + props.language,
                            message: 'Words successfully imported for language ' + props.language,
                            type: NotifyTypes.success,
                        });
                    })
                    .catch((error: Error | AxiosError) => {
                        ErrorHandler(error);
                    })
                    .finally(() => {
                        loading.value = false;
                    });
            };
            const i18n = useI18n();
            return {
                loading,
                importWords,
                i18n,
            };
        },
    });
</script>

<style scoped></style>
