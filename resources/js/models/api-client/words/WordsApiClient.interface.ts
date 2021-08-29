import { LoadedWordsInterface } from '@/models/words/LoadedWords.interface'
import { WordInterface } from '@/models/words/Word.interface'
import { LoadedWordInterface } from '@/models/words/LoadedWord.interface'
import {WordRequestInterface} from "@/models/words/WordRequest.interface";

/**
 * @Name WordsApiClientInterface
 * @description
 * Interface for the Words api client module
 */
export interface WordsApiClientInterface {
    fetchWords: (setting:WordRequestInterface) => Promise<LoadedWordsInterface>
    createWords: (word: WordInterface) => Promise<LoadedWordInterface>
    markViewed: (id: number) => Promise<LoadedWordInterface>
    markKnown: (id: number) => Promise<LoadedWordInterface>
    markStarred: (id: number) => Promise<LoadedWordInterface>
    deleteWord: (id: number) => Promise<void>
}
