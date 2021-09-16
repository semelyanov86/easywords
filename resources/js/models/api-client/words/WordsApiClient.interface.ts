import { LoadedWordsInterface } from '@/models/words/LoadedWords.interface'
import { WordInterface } from '@/models/words/Word.interface'
import { LoadedWordInterface } from '@/models/words/LoadedWord.interface'
import {WordRequestInterface} from "@/models/words/WordRequest.interface";
import {ShareWordInterface} from "@/models/words/ShareWord.interface";

/**
 * @Name WordsApiClientInterface
 * @description
 * Interface for the Words api client module
 */
export interface WordsApiClientInterface {
    fetchWords: (setting:WordRequestInterface) => Promise<LoadedWordsInterface>
    createWords: (word: WordInterface) => Promise<LoadedWordInterface>
    markViewed: (id: number) => Promise<LoadedWordInterface>
    markKnown: (id: number, value: number) => Promise<LoadedWordInterface>
    markStarred: (id: number, value: number) => Promise<LoadedWordInterface>
    shareWord: (word:ShareWordInterface) => Promise<LoadedWordInterface>
    deleteWord: (id: number) => Promise<void>
    importWords: (language: string) => Promise<void>
    knownWords: () => Promise<LoadedWordsInterface>
}
