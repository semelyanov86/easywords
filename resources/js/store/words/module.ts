import { Module, MutationTree, ActionTree, GetterTree } from 'vuex'

import { MutationType, RootStateInterface, WordsStateInterface } from '../../models/store'

import { initialWordsState } from './initialState'

import { WordInterface } from '../../models/words/Word.interface'
import apiClient from '../../api-client'

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
  loadWords({ commit }) {
    commit(MutationType.words.loadingWords)

    // let's pretend we called some API end-point
    // and it takes 1 second to return the data
    // by using javascript setTimeout with 1000 for the milliseconds option
      apiClient.words.fetchWords().then((data) => {
          const result = data.data
          commit(MutationType.words.loadedWords, data)
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
