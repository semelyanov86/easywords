import { WordInterface } from '../../../models/words/Word.interface'

/**
 * @name WordsStateInterface
 * @description
 * Interface for the Words state
 */
export interface WordsStateInterface {
  loading: boolean
  words: WordInterface[]
}
