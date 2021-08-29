import { rootStore, dispatchModuleAction } from '../root'
import { StoreModuleNames, WordsStateInterface } from '../../models/store'

/**
 * @name wordsStore
 * @description
 * The words store wrapper that returns the itemsState and exposes a generic action<T> method
 */
const wordsStore = {
  get state(): WordsStateInterface {
    return rootStore.state.wordsState
  },
  action<T>(actionName: string, params?: T): void {
    dispatchModuleAction(StoreModuleNames.wordsState, actionName, params)
  }
}
// export our wrapper using the composition API convention (i.e. useXYZ)
export const useWordsStore = () => {
  return wordsStore
}
