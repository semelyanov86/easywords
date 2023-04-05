import {
    UserApiClientUrlsInterface,
    UserApiClientInterface,
    UserApiClientModel,
} from '../../../models/api-client/user';

import { config } from '../../../config';

// urls for this API client
const urls: UserApiClientUrlsInterface = config.user.apiUrls;

// instantiate the ItemsApiClient pointing at the url that returns the live data from an API server
const userApiClient: UserApiClientInterface = new UserApiClientModel(urls);
// export our instance
export default userApiClient;
