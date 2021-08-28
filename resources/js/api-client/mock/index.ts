import { ApiClientInterface } from '../../models/api-client/ApiClient.interface'
import settingsApiClient from './settings'
import userApiClient from './user'
// @ts-ignore
import authApiClient from './auth'

// create an instance of our main ApiClient that wraps the mock child clients
const apiMockClient: ApiClientInterface = {
  settings: settingsApiClient,
    auth: authApiClient,
    user: userApiClient
}
// export our instance
export default apiMockClient
