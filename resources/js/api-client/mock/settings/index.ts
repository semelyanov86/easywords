import {
    SettingsApiClientUrlsInterface,
    SettingsApiClientInterface,
    SettingsApiClientModel,
} from '../../../models/api-client/settings';

import { config } from '../../../config';

// urls for this API client
const urls: SettingsApiClientUrlsInterface = config.settings.apiUrls;

// instantiate the ItemsApiClient pointing at the url that returns static json mock data
const settingsApiClient: SettingsApiClientInterface = new SettingsApiClientModel(urls);
// export our instance
export default settingsApiClient;
