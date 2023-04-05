<template>
    <header class="flex items-center justify-between px-6 py-4 bg-white border-b-4 border-indigo-600">
        <div class="flex items-center">
            <router-link
                :to="{ name: 'Home' }"
                class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0"
            >
                <img src="images/easywords.png" alt="EasyWords" class="logo" />
                <span class="ml-3 text-xl">EasyWords</span>
            </router-link>
        </div>
        <div class="flex items-center">
            <LocaleSelector :availableLocales="availableLocales" @clicked="onLocaleClicked" />
            <router-link :to="{ name: 'Create' }" class="flex mx-4 text-gray-600 focus:outline-none">
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
                        d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"
                    ></path>
                </svg>
            </router-link>

            <div class="relative">
                <button
                    @click="dropdownOpen = !dropdownOpen"
                    class="relative z-10 block w-8 h-8 overflow-hidden rounded-full shadow focus:outline-none"
                >
                    <img
                        class="object-cover w-full h-full"
                        :src="user.profile_photo_path"
                        :alt="user.name"
                        v-if="user.profile_photo_path"
                    />
                    <svg
                        v-else
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
                            d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                        ></path>
                    </svg>
                </button>

                <div v-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 z-10 w-full h-full"></div>

                <transition
                    enter-active-class="transition duration-150 ease-out transform"
                    enter-from-class="scale-95 opacity-0"
                    enter-to-class="scale-100 opacity-100"
                    leave-active-class="transition duration-150 ease-in transform"
                    leave-from-class="scale-100 opacity-100"
                    leave-to-class="scale-95 opacity-0"
                >
                    <div
                        v-show="dropdownOpen"
                        class="absolute right-0 z-20 w-48 py-2 mt-2 bg-white rounded-md shadow-xl"
                    >
                        <dropdown-item
                            v-for="item in dropdowns"
                            :key="item.name"
                            :title="item.title"
                            :name="item.name"
                        ></dropdown-item>
                    </div>
                </transition>
            </div>
        </div>
    </header>
</template>

<script lang="ts">
    import { computed, defineComponent, PropType, ref } from 'vue';
    import { useUserStore } from '../../store/user';
    import DropdownItem from './children/DropdownItem.vue';
    import { useI18n } from 'vue-i18n';
    import { MutationType } from '../../models/store';
    import { useLocalesStore } from '../../store/locales';
    import { LocaleInfoInterface } from '../../models/localization/LocaleInfo.interface';
    import LocaleSelector from '../../components/locale-selector/LocaleSelector.component.vue';

    export default defineComponent({
        components: {
            DropdownItem,
            LocaleSelector,
        },
        setup(_, { emit }) {
            const dropdownOpen = ref(false);
            const userStore = useUserStore();
            const localesStore = useLocalesStore();
            const user = computed(() => {
                return userStore.state.user;
            });

            const dropdowns = [
                {
                    title: 'Profile',
                    name: 'Profile',
                },
                {
                    title: 'Settings',
                    name: 'Settings',
                },
                {
                    title: 'Statistics',
                    name: 'Statistics',
                },
                {
                    title: 'Change Password',
                    name: 'ChangePassword',
                },
                {
                    title: 'Logout',
                    name: 'Logout',
                },
            ];

            const i18n = useI18n();

            const availableLocales = computed(() => {
                return localesStore.state.availableLocales;
            });
            // methods:
            const onLocaleClicked = (localeInfo: LocaleInfoInterface) => {
                localesStore.action(MutationType.locales.selectLocale, localeInfo.locale);
            };
            return {
                dropdownOpen,
                user,
                dropdowns,
                i18n,
                availableLocales,
                onLocaleClicked,
            };
        },
    });
</script>

<style scoped>
    .logo {
        width: 29px;
    }
</style>
