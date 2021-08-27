import { HttpClient, HttpRequestParamsInterface } from '../../../models/http-client'

import { SettingsApiClientUrlsInterface } from './SettingsApiClientUrls.interface'
import { SettingsApiClientInterface } from './SettingsApiClient.interface'
import { SettingInterface } from '../../../models/settings/setting.interface'

/**
 * @Name SettingsApiClientModel
 * @description
 * Implements the SettingsApiClientInterface interface
 */
export class SettingsApiClientModel implements SettingsApiClientInterface {
  private readonly urls!: SettingsApiClientUrlsInterface

  constructor(urls: SettingsApiClientUrlsInterface) {
    this.urls = urls
  }

  fetchItems(): Promise<SettingInterface[]> {
    const getParameters: HttpRequestParamsInterface = {
      url: this.urls.fetchSettings,
      requiresToken: true
    }

    return HttpClient.get<SettingInterface[]>(getParameters)
  }
}
