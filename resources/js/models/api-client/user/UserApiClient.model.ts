import { HttpClient, HttpRequestParamsInterface } from '../../../models/http-client';

import { UserApiClientUrlsInterface } from './UserApiClientUrls.interface';
import { UserApiClientInterface } from './UserApiClient.interface';
import { UserInterface } from '../../../models/user/user.interface';
import { LoadedUserInterface } from '../../../models/user/loadedUser.interface';
import { UpdatePasswordInterface } from '../../../models/user/updatePassword.interface';
import { ShortUserInterface } from '@/models/user/shortUser.interface';
import { LoadedShortUserInterface } from '@/models/user/loadedShortUser.interface';

/**
 * @Name UserApiClientModel
 * @description
 * Implements the SettingsApiClientInterface interface
 */
export class UserApiClientModel implements UserApiClientInterface {
    private readonly urls!: UserApiClientUrlsInterface;

    constructor(urls: UserApiClientUrlsInterface) {
        this.urls = urls;
    }

    fetchUser(): Promise<LoadedUserInterface> {
        const getParameters: HttpRequestParamsInterface = {
            url: this.urls.fetchUser,
            requiresToken: true,
        };

        return HttpClient.get<LoadedUserInterface>(getParameters);
    }

    fetchUsersShort(): Promise<LoadedShortUserInterface> {
        const getParameters: HttpRequestParamsInterface = {
            url: this.urls.fetchUsersShort,
            requiresToken: true,
        };

        return HttpClient.get<LoadedShortUserInterface>(getParameters);
    }

    updatePassword(data: UpdatePasswordInterface): Promise<LoadedUserInterface> {
        const getParameters: HttpRequestParamsInterface = {
            url: this.urls.updatePassword,
            requiresToken: true,
            payload: data,
        };

        return HttpClient.put<LoadedUserInterface>(getParameters);
    }
}
