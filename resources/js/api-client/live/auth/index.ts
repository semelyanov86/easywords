import {
    AuthApiClientUrlsInterface,
    AuthApiClientInterface,
    AuthApiClientModel
} from '../../../models/api-client/auth'

import { config } from '../../../config'

// urls for this API client
const urls: AuthApiClientUrlsInterface = config.auth.apiUrls

// instantiate the ItemsApiClient pointing at the url that returns the live data from an API server
const authApiClient: AuthApiClientInterface = new AuthApiClientModel(urls)
// export our instance
export default authApiClient
