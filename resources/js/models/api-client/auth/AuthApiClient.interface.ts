import { LoginInterface } from '@/models/auth/LoginInterface';
import { TokenInterface } from '@/models/auth/TokenInterface';

/**
 * @Name AuthApiClientInterface
 * @description
 * Interface for the Auth api client module
 */
export interface AuthApiClientInterface {
    doLogin: (data: LoginInterface) => Promise<TokenInterface>;
}
