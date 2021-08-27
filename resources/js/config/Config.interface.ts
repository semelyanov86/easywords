import { SettingsApiClientUrlsInterface } from '../models/api-client/settings'
import { AuthApiClientUrlsInterface } from '../models/api-client/auth'
import { LocaleInfoInterface } from '@/models/localization/LocaleInfo.interface'

/**
 * @Name ConfigInterface
 * @description
 *
 */
export interface ConfigInterface {
  global: {
    // ... things that are not specific to a single app domain
  }

  locales: LocaleInfoInterface[]

  httpClient: {
    tokenKey: string
  }

  apiClient: {
    type: string
  }

  settings: {
    apiUrls: SettingsApiClientUrlsInterface
  }
    auth: {
        apiUrls: AuthApiClientUrlsInterface
    }
}
