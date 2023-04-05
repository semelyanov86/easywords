import { SettingsApiClientUrlsInterface } from '../models/api-client/settings';
import { WordsApiClientUrlsInterface } from '../models/api-client/words';
import { UserApiClientUrlsInterface } from '../models/api-client/user';
import { AuthApiClientUrlsInterface } from '../models/api-client/auth';
import { LocaleInfoInterface } from '@/models/localization/LocaleInfo.interface';
import { StatisticsApiClientUrlsInterface } from '../models/api-client/statistics';

/**
 * @Name ConfigInterface
 * @description
 *
 */
export interface ConfigInterface {
    global: {
        // ... things that are not specific to a single app domain
    };

    locales: LocaleInfoInterface[];

    httpClient: {
        tokenKey: string;
    };

    apiClient: {
        type: string;
    };

    settings: {
        apiUrls: SettingsApiClientUrlsInterface;
    };
    user: {
        apiUrls: UserApiClientUrlsInterface;
    };
    statistics: {
        apiUrls: StatisticsApiClientUrlsInterface;
    };
    auth: {
        apiUrls: AuthApiClientUrlsInterface;
    };
    words: {
        apiUrls: WordsApiClientUrlsInterface;
    };
}
