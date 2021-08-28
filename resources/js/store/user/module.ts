import { Module, MutationTree, ActionTree, GetterTree } from 'vuex'

import { MutationType, RootStateInterface, UserStateInterface } from '../../models/store'

import { initialUserState } from './initialState'

import {UserInterface} from "../../models/user/user.interface";
import {UserMutationType} from "../../models/store/user/UserMutationType";
import {ErrorHandler} from "../../plugins/error-handler/ErrorHandler";
import apiClient from "../../api-client";
import {AxiosError} from "axios";

/**
 * @name mutations
 * @description
 * Vuex Items mutations
 */
export const mutations: MutationTree<UserStateInterface> = {
    loadingUser(state: UserStateInterface) {
        state.loading = true
    },
    loadedUser(state: UserStateInterface, user: UserInterface) {
        state.user = user
        state.loading = false
    }
}

/**
 * @name actions
 * @description
 * Vuex Items actions
 */
export const actions: ActionTree<UserStateInterface, RootStateInterface> = {
    loadUser({ commit }) {
        commit(MutationType.user.loadingUser)

        // let's pretend we called some API end-point
        // and it takes 1 second to return the data
        // by using javascript setTimeout with 1000 for the milliseconds option
        apiClient.user.fetchUser().then((data) => {
            const result:UserInterface = data.data;
            commit(MutationType.user.loadedUser, result)
        }).catch((error: Error | AxiosError) => {
            ErrorHandler(error);
        })
    }
}

/**
 * @name getters
 * @description
 * Vuex Items getters
 */
export const getters: GetterTree<UserStateInterface, RootStateInterface> = {}

// create our Items store instance
const namespaced: boolean = true
const state: UserStateInterface = initialUserState

/**
 * @name userState
 * @description
 * Vuex Items store
 */
export const userState: Module<UserStateInterface, RootStateInterface> = {
    namespaced,
    state,
    getters,
    actions,
    mutations
}
