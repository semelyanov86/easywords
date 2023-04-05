<template>
    <div :class="`modal z-50 fixed w-full h-full top-0 left-0 flex items-center justify-center`">
        <div @click="closeModal" class="absolute w-full h-full bg-gray-900 opacity-50 modal-overlay"></div>

        <div class="z-50 w-11/12 mx-auto overflow-y-auto bg-white rounded shadow-lg modal-container md:max-w-md">
            <div
                class="absolute top-0 right-0 z-50 flex flex-col items-center mt-4 mr-4 text-sm text-white cursor-pointer modal-close"
            >
                <svg
                    class="text-white fill-current"
                    xmlns="http://www.w3.org/2000/svg"
                    width="18"
                    height="18"
                    viewBox="0 0 18 18"
                >
                    <path
                        d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"
                    />
                </svg>
                <span class="text-sm">(Esc)</span>
            </div>

            <!-- Add margin if you want to see some of the overlay behind the modal-->
            <div class="px-6 py-4 text-left modal-content">
                <!--Title-->
                <div class="flex items-center justify-between pb-3">
                    <p class="text-2xl font-bold">{{ i18n.t('user.choose_user') }}</p>
                    <div class="z-50 cursor-pointer modal-close" @click="closeModal">
                        <svg
                            class="text-black fill-current"
                            xmlns="http://www.w3.org/2000/svg"
                            width="18"
                            height="18"
                            viewBox="0 0 18 18"
                        >
                            <path
                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"
                            />
                        </svg>
                    </div>
                </div>

                <!--Body-->
                <p>{{ i18n.t('user.choose_user_helper') }}</p>
                <div class="inline-block relative w-64 mt-3">
                    <select
                        v-model="user"
                        class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                        id="user-select"
                    >
                        <option :value="user.id" v-for="user in users" :key="user.id">{{ user.name }}</option>
                    </select>
                </div>

                <!--Footer-->
                <div class="flex justify-end pt-2">
                    <button
                        @click="closeModal"
                        class="p-3 px-6 py-3 mr-2 text-indigo-500 bg-transparent rounded-lg hover:bg-gray-100 hover:text-indigo-400 focus:outline-none"
                    >
                        Close
                    </button>
                    <button
                        @click="selectUser"
                        class="px-6 py-3 font-medium tracking-wide text-white bg-indigo-600 rounded-md hover:bg-indigo-500 focus:outline-none"
                    >
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
    import { computed, defineComponent, onMounted, ref, reactive } from 'vue';
    import { useI18n } from 'vue-i18n';
    import { useUserStore } from '../../store/user';

    export default defineComponent({
        name: 'ChooseUserModal',
        component: {},
        emits: ['closed', 'selectUser'],
        setup(props, { emit }) {
            const userStore = useUserStore();
            const i18n = useI18n();
            const user = ref(0);

            function closeModal() {
                emit('closed');
            }

            function selectUser() {
                emit('selectUser', user.value);
            }

            const users = computed(() => {
                return userStore.state.usersList;
            });

            onMounted(() => {
                userStore.action('loadShortUsers');
            });
            return {
                closeModal,
                i18n,
                users,
                user,
                selectUser,
            };
        },
    });
</script>

<style scoped></style>
