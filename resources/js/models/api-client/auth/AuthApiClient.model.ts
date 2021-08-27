import { HttpClient, HttpRequestParamsInterface } from '../../../models/http-client'

import { AuthApiClientUrlsInterface } from './AuthApiClientUrls.interface'
import { AuthApiClientInterface } from './AuthApiClient.interface'
import { LoginInterface } from '../../../models/auth/LoginInterface'
import { TokenInterface } from '../../../models/auth/TokenInterface'

/**
 * @Name SettingsApiClientModel
 * @description
 * Implements the SettingsApiClientInterface interface
 */
export class AuthApiClientModel implements AuthApiClientInterface {
  private readonly urls!: AuthApiClientUrlsInterface

  constructor(urls: AuthApiClientUrlsInterface) {
    this.urls = urls
  }

  doLogin(data:LoginInterface): Promise<TokenInterface> {
    const getParameters: HttpRequestParamsInterface = {
      url: this.urls.login,
      requiresToken: false,
        payload: data
    }

    return HttpClient.post<TokenInterface>(getParameters)
  }
}
