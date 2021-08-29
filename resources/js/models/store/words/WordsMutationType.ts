// group our constants in a namespace
export namespace WordsMutationType {
  export const loadWords: string = 'loadItems'
  export const loadingWords: string = 'loadingItems'
  export const loadedWords: string = 'loadedItems'
    export const deleteItem: string = 'deleteItem'
  export const nextWord: string = 'nextWord'
  export const starWord: string = 'starWord'
  export const createWord: string = 'createWord'
  // as you add new mutations to the Words store module, keep adding their names here as above
}
