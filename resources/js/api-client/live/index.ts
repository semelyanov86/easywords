import { ApiClientInterface } from '@/models/api-client/ApiClient.interface'
import settingsApiClient from './settings'
import userApiClient from './user'
import authApiClient from './auth'

// create an instance of our main ApiClient that wraps the live child clients
const apiLiveClient: ApiClientInterface = {
  settings: settingsApiClient,
    auth: authApiClient,
    user: userApiClient
}
// export our instance
export default apiLiveClient
