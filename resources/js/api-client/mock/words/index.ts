import {
  WordsApiClientUrlsInterface,
  WordsApiClientInterface,
  WordsApiClientModel
} from '../../../models/api-client/words'

import { config } from '../../../config'

// urls for this API client
const urls: WordsApiClientUrlsInterface = config.words.apiUrls

// instantiate the ItemsApiClient pointing at the url that returns static json mock data
const wordsApiClient: WordsApiClientInterface = new WordsApiClientModel(urls)
// export our instance
export default wordsApiClient
