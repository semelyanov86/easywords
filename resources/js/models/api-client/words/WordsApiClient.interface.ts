import { LoadedWordsInterface } from '@/models/words/LoadedWords.interface'
import { WordInterface } from '@/models/words/Word.interface'
import { LoadedWordInterface } from '@/models/words/LoadedWord.interface'

/**
 * @Name WordsApiClientInterface
 * @description
 * Interface for the Words api client module
 */
export interface WordsApiClientInterface {
    fetchWords: () => Promise<LoadedWordsInterface>
    createWords: (word: WordInterface) => Promise<LoadedWordInterface>
    markViewed: (id: number) => Promise<LoadedWordInterface>
    markKnown: (id: number) => Promise<LoadedWordInterface>
}