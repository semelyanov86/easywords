import { ApiClientInterface } from '@/models/api-client/ApiClient.interface'
import settingsApiClient from './settings'

// create an instance of our main ApiClient that wraps the live child clients
const apiLiveClient: ApiClientInterface = {
  settings: settingsApiClient
}
// export our instance
export default apiLiveClient
