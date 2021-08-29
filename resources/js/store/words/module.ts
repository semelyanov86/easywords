import { Module, MutationTree, ActionTree, GetterTree } from 'vuex'

import { MutationType, RootStateInterface, WordsStateInterface } from '../../models/store'

import { initialWordsState } from './initialState'

import { WordInterface } from '../../models/words/Word.interface'
import {SettingInterface} from "../../models/settings/setting.interface";
import apiClient from '../../api-client'
import {WordRequestInterface} from "@/models/words/WordRequest.interface";
import {AxiosError} from "axios";
import {ErrorHandler} from "../../plugins/error-handler/ErrorHandler";
import {notify} from "../../components/notifications";
// import the styling for the toast
import 'mosha-vue-toastify/dist/style.css'
import {NotifyTypes} from "../../components/notifications/NotifyTypes";
import {LoadedWordInterface} from "@/models/words/LoadedWord.interface";

/**
 * @name mutations
 * @description
 * Vuex Items mutations
 */
export const mutations: MutationTree<WordsStateInterface> = {
  loadingItems(state: WordsStateInterface) {
    state.loading = true
  },
  loadedItems(state: WordsStateInterface, words: WordInterface[]) {
    state.words = words
    state.loading = false
  },
    deleteItem(state: WordsStateInterface, id: number) {
        state.words = state.words.filter((word) => word.id !== id)
    }

}

/**
 * @name actions
 * @description
 * Vuex Items actions
 */
export const actions: ActionTree<WordsStateInterface, RootStateInterface> = {
  loadWords({ commit }, setting:WordRequestInterface) {
    commit(MutationType.words.loadingWords)

      apiClient.words.fetchWords(setting).then((data) => {
          const result = data.data
          commit(MutationType.words.loadedWords, result)
      })
  },
  markViewed({commit}, id:number) {
      apiClient.words.markViewed(id).then((data) => {

      })
  },
    markKnown({commit}, id:number) {
        apiClient.words.markKnown(id).then((data) => {
            commit(MutationType.words.deleteItem, id)
            // state.words.filter((word) => word.id === id)
        })
    },
    createWord({commit}, word:WordInterface): void {
        apiClient.words.createWords(word).then((data) => {
            notify({
                title: 'Word created with id: ' + data.data.id,
                message: 'Word successfully created with id: ' + data.data.id,
                type: NotifyTypes.success
            })
        }).catch((error: Error | AxiosError) => {
            ErrorHandler(error);
        })
    },
    markStarred({commit}, id:number) {
      apiClient.words.markStarred(id).then((data) => {
          notify({
              title: 'Word ' + data.data.original + ' is starred',
              message: 'Later you can learn only starred words',
              type: NotifyTypes.success
          })
      }).catch((error: Error | AxiosError) => {
          ErrorHandler(error);
      })
    },
    deleteWord({commit}, id:number) {
        apiClient.words.deleteWord(id).then((data) => {
            commit(MutationType.words.deleteItem, id)
            notify({
                title: 'Word has been deleted starred',
                message: 'You can not restore it anymore',
                type: NotifyTypes.success
            })
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
export const getters: GetterTree<WordsStateInterface, RootStateInterface> = {}

// create our Items store instance
const namespaced: boolean = true
const state: WordsStateInterface = initialWordsState

/**
 * @name wordsState
 * @description
 * Vuex Words store
 */
export const wordsState: Module<WordsStateInterface, RootStateInterface> = {
  namespaced,
  state,
  getters,
  actions,
  mutations
}
