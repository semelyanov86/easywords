import { HttpClient, HttpRequestParamsInterface } from '../../../models/http-client';

import { SettingsApiClientUrlsInterface } from './SettingsApiClientUrls.interface';
import { SettingsApiClientInterface } from './SettingsApiClient.interface';
import { SettingInterface } from '../../../models/settings/setting.interface';
import { LoadedSettingsInterface } from '../../../models/settings/LoadedSettingsInterface';
import { UpdateSettingsInterface } from '../../../models/settings/updateSettings.interface';

/**
 * @Name SettingsApiClientModel
 * @description
 * Implements the SettingsApiClientInterface interface
 */
export class SettingsApiClientModel implements SettingsApiClientInterface {
    private readonly urls!: SettingsApiClientUrlsInterface;

    constructor(urls: SettingsApiClientUrlsInterface) {
        this.urls = urls;
    }

    fetchItems(): Promise<LoadedSettingsInterface> {
        const getParameters: HttpRequestParamsInterface = {
            url: this.urls.fetchSettings,
            requiresToken: true,
        };

        return HttpClient.get<LoadedSettingsInterface>(getParameters);
    }

    updateSetting(data: UpdateSettingsInterface): Promise<void> {
        const postParameters: HttpRequestParamsInterface = {
            url: this.urls.updateSetting,
            requiresToken: true,
            payload: data,
        };

        return HttpClient.post<void>(postParameters);
    }
}
