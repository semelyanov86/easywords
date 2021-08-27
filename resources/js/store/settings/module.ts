import { Module, MutationTree, ActionTree, GetterTree } from 'vuex'

import { MutationType, RootStateInterface, SettingsStateInterface } from '../../models/store'

import { initialSettingsState } from './initialState'

import { SettingInterface } from '../../models/settings/setting.interface'
import {SettingsMutationType} from "@/models/store/settings/SettingsMutationType";
// import apiClient from '@/api-client'

/**
 * @name mutations
 * @description
 * Vuex Items mutations
 */
export const mutations: MutationTree<SettingsStateInterface> = {
    loadingSettings(state: SettingsStateInterface) {
        state.loading = true
    },
    loadedSettings(state: SettingsStateInterface, settings: SettingInterface[]) {
        state.settings = settings
        state.loading = false
    },
    selectSetting(
        state: SettingsStateInterface,
        params: {
            id: number
            selected: boolean
        }
    ) {
        const { id, selected } = params

    }
}

/**
 * @name actions
 * @description
 * Vuex Items actions
 */
export const actions: ActionTree<SettingsStateInterface, RootStateInterface> = {
    loadSettings({ commit }) {
        commit(MutationType.settings.loadingSettings)

        // let's pretend we called some API end-point
        // and it takes 1 second to return the data
        // by using javascript setTimeout with 1000 for the milliseconds option
        setTimeout(() => {
            commit(MutationType.settings.loadedSettings, {
                "paginate": "40",
                "default_language": "EN",
                "starred_enabled": false,
                "known_enabled": false,
                "fresh_first": false,
                "languages_list": [
                    "DE",
                    "EN"
                ],
                "main_language": "RU"
            })
        }, 1000)
    },
    selectSetting(
        { commit },
        params: {
            id: number
            selected: boolean
        }
    ) {
        commit(MutationType.settings.selectSetting, params)
    }
}

/**
 * @name getters
 * @description
 * Vuex Items getters
 */
export const getters: GetterTree<SettingsStateInterface, RootStateInterface> = {}

// create our Items store instance
const namespaced: boolean = true
const state: SettingsStateInterface = initialSettingsState

/**
 * @name settingsState
 * @description
 * Vuex Items store
 */
export const settingsState: Module<SettingsStateInterface, RootStateInterface> = {
    namespaced,
    state,
    getters,
    actions,
    mutations
}
