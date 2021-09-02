import { ApiClientInterface } from '../../models/api-client/ApiClient.interface'
import settingsApiClient from './settings'
import wordsApiClient from './words'
import userApiClient from './user'
// @ts-ignore
import authApiClient from './auth'
import statisticsApiClient from "./statistics";

// create an instance of our main ApiClient that wraps the mock child clients
const apiMockClient: ApiClientInterface = {
    settings: settingsApiClient,
    auth: authApiClient,
    user: userApiClient,
    words: wordsApiClient,
    statistics: statisticsApiClient
}
// export our instance
export default apiMockClient
