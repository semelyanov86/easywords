<template>
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-3xl font-medium text-gray-700">{{ i18n.t('Profile page') }}</h3>
        <div class="mt-4">
            <h4 class="text-gray-600">{{ i18n.t('Profile Detail Info') }}</h4>

            <div class="mt-6">
                <div class="my-6 overflow-hidden bg-white rounded-md shadow">
                    <table class="w-full text-left border-collapse">
                        <thead class="border-b">
                            <tr>
                                <th class="px-5 py-3 text-sm font-medium text-gray-100 uppercase bg-indigo-800">
                                    {{ i18n.t('field') }}
                                </th>
                                <th class="px-5 py-3 text-sm font-medium text-gray-100 uppercase bg-indigo-800">
                                    {{ i18n.t('value') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="hover:bg-gray-200">
                                <td class="px-6 py-4 text-lg text-gray-700 border-b">
                                    {{ i18n.t('user.id') }}
                                </td>
                                <td class="px-6 py-4 text-gray-500 border-b">
                                    {{ user.id }}
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-200">
                                <td class="px-6 py-4 text-lg text-gray-700 border-b">
                                    {{ i18n.t('user.name') }}
                                </td>
                                <td class="px-6 py-4 text-gray-500 border-b">
                                    {{ user.name }}
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-200">
                                <td class="px-6 py-4 text-lg text-gray-700 border-b">
                                    {{ i18n.t('user.email') }}
                                </td>
                                <td class="px-6 py-4 text-gray-500 border-b">
                                    {{ user.email }}
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-200">
                                <td class="px-6 py-4 text-lg text-gray-700 border-b">
                                    {{ i18n.t('user.created_at') }}
                                </td>
                                <td class="px-6 py-4 text-gray-500 border-b">
                                    {{ dateFormatter(user.created_at) }}
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-200">
                                <td class="px-6 py-4 text-lg text-gray-700 border-b">
                                    {{ i18n.t('user.updated_at') }}
                                </td>
                                <td class="px-6 py-4 text-gray-500 border-b">
                                    {{ dateFormatter(user.updated_at) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <receive-token></receive-token>
    </div>
</template>

<script>
    import { computed, defineComponent, onMounted, ref } from 'vue';
    import { useUserStore } from '../store/user';
    import { useI18n } from 'vue-i18n';
    import { dateFormatter } from '../services/date-formatter';
    import ReceiveToken from '@/components/settings/ReceiveToken.vue';

    export default defineComponent({
        name: 'Profile',
        components: { ReceiveToken },
        setup() {
            const userStore = useUserStore();
            const user = computed(() => {
                return userStore.state.user;
            });
            const i18n = useI18n();
            return {
                user,
                i18n,
                dateFormatter,
            };
        },
    });
</script>

<style scoped></style>
