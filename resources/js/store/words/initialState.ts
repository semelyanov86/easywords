import { WordsStateInterface } from '@/models/store';

/**
 * @name WordsStateInterface
 * @description
 * The Items state instance with the initial default values
 */
export const initialWordsState: WordsStateInterface = {
    loading: false,
    words: [],
};
