<template>
  <div class="container mx-auto px-6 py-8">
      <h4 class="text-gray-600">Settings</h4>
      <div class="mt-4">
          <div class="p-6 bg-white rounded-md shadow-md">
              <h2 class="text-lg font-semibold text-gray-700 capitalize">
                  Account settings
              </h2>
                  <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                      <div>
                          <label class="text-gray-700" for="paginate">{{ i18n.t('setting.paginate') }}</label>
                          <input
                              id="paginate"
                              class="w-full mt-2 border-gray-200 rounded-md focus:border-indigo-600 focus:ring focus:ring-opacity-40 focus:ring-indigo-500"
                              type="number"
                              v-model="setting.paginate"
                              v-on:change="register('paginate')"
                          />
                      </div>

                      <div>
                          <label class="text-gray-700" for="default_language"
                          >{{ i18n.t('setting.default_language') }}</label
                          >
                          <select
                              id="default_language"
                              class="w-full mt-2 border-gray-200 rounded-md focus:border-indigo-600 focus:ring focus:ring-opacity-40 focus:ring-indigo-500"
                              v-on:change="register('default_language')"
                              v-model="setting.default_language">
                              <option v-for="language in setting.languages_list" :key="language">{{ language }}</option>
                          </select>
                      </div>

                      <div>
                          <label class="text-gray-700" for="starred_enabled">{{ i18n.t('setting.starred_enabled') }}</label>
                          <input
                              id="starred_enabled"
                              class="rounded text-pink-500"
                              type="checkbox"
                              v-on:change="register('starred_enabled')"
                              v-model="setting.starred_enabled"
                          />
                      </div>

                      <div>
                          <label class="text-gray-700" for="starred_enabled">{{ i18n.t('setting.known_enabled') }}</label>
                          <input
                              id="known_enabled"
                              class="rounded text-pink-500"
                              type="checkbox"
                              v-on:change="register('known_enabled')"
                              v-model="setting.known_enabled"
                          />
                      </div>
                      <div>
                          <label class="text-gray-700" for="fresh_first">{{ i18n.t('setting.fresh_first') }}</label>
                          <input
                              id="fresh_first"
                              class="rounded text-pink-500"
                              type="checkbox"
                              v-on:change="register('fresh_first')"
                              v-model="setting.fresh_first"
                          />
                      </div>
                  </div>

                  <div class="flex justify-end mt-4">
                      <button
                          v-on:click.prevent="close"
                          class="px-4 py-2 text-gray-200 bg-gray-800 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700"
                      >
                          Save
                      </button>
                  </div>
          </div>
      </div>
  </div>
</template>

<script lang="ts">
import {computed, defineComponent, onMounted, ref, reactive} from 'vue'
import {SettingInterface} from "../models/settings/setting.interface";
import {initialSettingsState} from "../store/settings/initialState";
import {useSettingsStore} from "../store/settings";
import {UpdateSettingsInterface} from "../models/settings/updateSettings.interface";
import {useI18n} from 'vue-i18n';
import router from "../router";
import {MutationType} from "../models/store";

export default defineComponent({
    name: "Settings",
    setup() {
        const settingsStore = useSettingsStore()
        const settings = computed(() => {
            return settingsStore.state.settings
        })
        let setting = reactive<SettingInterface>(initialSettingsState.settings)
        onMounted(() => {
            setting = settings.value
        })
        const close = () => {
            router.back()
        }
        const register = (field:string) => {
            const updateData:UpdateSettingsInterface = {
                name: field,
                value: setting[field]
            }
            settingsStore.action('updateSetting', updateData)
        };
        const i18n = useI18n()
        return {
            setting, register, i18n, close, settings
        }
    }
})
</script>

<style scoped>

</style>
