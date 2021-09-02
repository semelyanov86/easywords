import {
  StatisticsApiClientUrlsInterface,
  StatisticsApiClientInterface,
  StatisticsApiClientModel
} from '../../../models/api-client/statistics'

import { config } from '../../../config'

// urls for this API client
const urls: StatisticsApiClientUrlsInterface = config.statistics.apiUrls

// instantiate the ItemsApiClient pointing at the url that returns the live data from an API server
const statisticsApiClient: StatisticsApiClientInterface = new StatisticsApiClientModel(urls)
// export our instance
export default statisticsApiClient
