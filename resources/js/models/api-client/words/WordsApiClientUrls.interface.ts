/**
 * @Name WordsApiClientUrlsInterface
 * @description
 * Interface for the Words urls used to avoid hard-coded strings
 */
export interface WordsApiClientUrlsInterface {
    fetchWords: string;
    createWords: string;
    markViewed: string;
    markKnown: string;
    markStarred: string;
    shareWord: string;
    deleteWord: string;
    importWords: string;
    knownWords: string;
}
