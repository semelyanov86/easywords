import { Module, MutationTree, ActionTree, GetterTree } from 'vuex'

import { MutationType, RootStateInterface, WordsStateInterface } from '../../models/store'

import { initialWordsState } from './initialState'

import { WordInterface } from '../../models/words/Word.interface'
import {SettingInterface} from "../../models/settings/setting.interface";
import apiClient from '../../api-client'
import {WordRequestInterface} from "@/models/words/WordRequest.interface";

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
            state.words.filter((word) => word.id === id)
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
