import { ApiClientInterface } from '@/models/api-client/ApiClient.interface';
import settingsApiClient from './settings';
import wordsApiClient from './words';
import userApiClient from './user';
import authApiClient from './auth';
import statisticsApiClient from './statistics';

// create an instance of our main ApiClient that wraps the live child clients
const apiLiveClient: ApiClientInterface = {
    settings: settingsApiClient,
    auth: authApiClient,
    user: userApiClient,
    words: wordsApiClient,
    statistics: statisticsApiClient,
};
// export our instance
export default apiLiveClient;
