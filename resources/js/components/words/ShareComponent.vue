<template>
    <div>
        <div class="share grid justify-items-end" @click="doShare">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
        </div>
        <choose-user-modal v-if="open" @closed="closeModal" @selectUser="runSharing"></choose-user-modal>
    </div>
</template>

<script>
import {computed, defineComponent, onMounted, ref, reactive} from 'vue'
import ChooseUserModal from "../users/ChooseUserModal.vue";
import {useI18n} from 'vue-i18n';
import {ShareWordInterface} from '../../models/words/ShareWord.interface'
import {useWordsStore} from "../../store/words";

export default defineComponent({
    name: "ShareComponent",
    components: {
        ChooseUserModal
    },
    props: {
        id: {
            type: Number,
            required: true
        }
    },
    setup(props) {
        const open = ref(false);
        const wordsStore = useWordsStore()

        function closeModal() {
            open.value = false
        }

        function doShare() {
            open.value = true
        }

        function runSharing(id) {
            open.value = false
            wordsStore.action('shareWord', {
                word: props.id,
                user: id
            })
        }
        return {
            open, doShare, closeModal, runSharing
        }
    }
})
</script>

<style scoped>
.share { cursor: pointer; }
</style>
