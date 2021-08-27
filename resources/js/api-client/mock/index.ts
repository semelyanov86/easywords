import { ApiClientInterface } from '../../models/api-client/ApiClient.interface'
import settingsApiClient from './settings'
// @ts-ignore
import authApiClient from './auth'

// create an instance of our main ApiClient that wraps the mock child clients
const apiMockClient: ApiClientInterface = {
  settings: settingsApiClient,
    auth: authApiClient
}
// export our instance
export default apiMockClient
