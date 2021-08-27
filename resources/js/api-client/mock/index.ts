import { ApiClientInterface } from '../../models/api-client/ApiClient.interface'
import settingsApiClient from './settings'

// create an instance of our main ApiClient that wraps the mock child clients
const apiMockClient: ApiClientInterface = {
  settings: settingsApiClient
}
// export our instance
export default apiMockClient
