import { HttpClient, HttpRequestParamsInterface } from '../../../models/http-client';

import { WordsApiClientUrlsInterface } from './WordsApiClientUrls.interface';
import { WordsApiClientInterface } from './WordsApiClient.interface';
import { WordInterface } from '../../../models/words/Word.interface';
import { LoadedWordsInterface } from '../../../models/words/LoadedWords.interface';
import { LoadedWordInterface } from '../../../models/words/LoadedWord.interface';
import { WordRequestInterface } from '../../../models/words/WordRequest.interface';
import { ShareWordInterface } from '@/models/words/ShareWord.interface';

/**
 * @Name WordsApiClientModel
 * @description
 * Implements the WordsApiClientInterface interface
 */
export class WordsApiClientModel implements WordsApiClientInterface {
    private readonly urls!: WordsApiClientUrlsInterface;

    constructor(urls: WordsApiClientUrlsInterface) {
        this.urls = urls;
    }

    fetchWords(setting: WordRequestInterface): Promise<LoadedWordsInterface> {
        const getParameters: HttpRequestParamsInterface = {
            url: this.urls.fetchWords,
            requiresToken: true,
            payload: setting,
        };

        return HttpClient.get<LoadedWordsInterface>(getParameters);
    }

    knownWords(): Promise<LoadedWordsInterface> {
        const getParameters: HttpRequestParamsInterface = {
            url: this.urls.knownWords,
            requiresToken: true,
        };

        return HttpClient.get<LoadedWordsInterface>(getParameters);
    }

    createWords(word: WordInterface): Promise<LoadedWordInterface> {
        const getParameters: HttpRequestParamsInterface = {
            url: this.urls.createWords,
            requiresToken: true,
            payload: word,
        };

        return HttpClient.post<LoadedWordInterface>(getParameters);
    }

    markViewed(id: number): Promise<LoadedWordInterface> {
        const url = this.urls.markViewed;
        const getParameters: HttpRequestParamsInterface = {
            url: url.replace('{id}', id.toString()),
            requiresToken: true,
        };
        return HttpClient.get<LoadedWordInterface>(getParameters);
    }

    markKnown(id: number, value: number): Promise<LoadedWordInterface> {
        const url = this.urls.markKnown;
        const getParameters: HttpRequestParamsInterface = {
            url: url.replace('{id}', id.toString()) + '/' + value,
            requiresToken: true,
        };

        return HttpClient.get<LoadedWordInterface>(getParameters);
    }

    markStarred(id: number, value: number): Promise<LoadedWordInterface> {
        const url = this.urls.markStarred;
        const getParameters: HttpRequestParamsInterface = {
            url: url.replace('{id}', id.toString()) + '/' + value,
            requiresToken: true,
        };

        return HttpClient.get<LoadedWordInterface>(getParameters);
    }

    shareWord(word: ShareWordInterface): Promise<LoadedWordInterface> {
        const url = this.urls.shareWord;
        const wordId = word.word;
        const getParameters: HttpRequestParamsInterface = {
            url: url.replace('{id}', wordId.toString()) + '/' + word.user.toString(),
            requiresToken: true,
        };

        return HttpClient.get<LoadedWordInterface>(getParameters);
    }

    deleteWord(id: number): Promise<void> {
        const url = this.urls.deleteWord;
        const getParameters: HttpRequestParamsInterface = {
            url: url.replace('{id}', id.toString()),
            requiresToken: true,
        };

        return HttpClient.delete<void>(getParameters);
    }

    importWords(language: string): Promise<void> {
        const url = this.urls.importWords;
        const getParameters: HttpRequestParamsInterface = {
            url: url.replace('{language}', language),
            requiresToken: true,
        };
        return HttpClient.get<void>(getParameters);
    }
}
