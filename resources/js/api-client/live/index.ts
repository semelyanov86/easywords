import { ApiClientInterface } from '@/models/api-client/ApiClient.interface'
import settingsApiClient from './settings'
import authApiClient from './auth'

// create an instance of our main ApiClient that wraps the live child clients
const apiLiveClient: ApiClientInterface = {
  settings: settingsApiClient,
    auth: authApiClient
}
// export our instance
export default apiLiveClient
