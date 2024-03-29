import { UserInterface } from '@/models/user/user.interface';
import { LoadedUserInterface } from '@/models/user/loadedUser.interface';
import { UpdatePasswordInterface } from '@/models/user/updatePassword.interface';
import { ShortUserInterface } from '@/models/user/shortUser.interface';
import { LoadedShortUserInterface } from '@/models/user/loadedShortUser.interface';

/**
 * @Name UserApiClientInterface
 * @description
 * Interface for the User api client module
 */
export interface UserApiClientInterface {
    fetchUser: () => Promise<LoadedUserInterface>;
    updatePassword: (data: UpdatePasswordInterface) => Promise<LoadedUserInterface>;
    fetchUsersShort: () => Promise<LoadedShortUserInterface>;
}
