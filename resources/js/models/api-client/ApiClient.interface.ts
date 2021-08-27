// GEN-IMPORTS
import { SettingsApiClientInterface } from './settings'
import {AuthApiClientInterface} from "./auth";

/**
 * @Name ApiClientInterface
 * @description
 * Interface wraps all api client modules into one places for keeping code organized.
 */
export interface ApiClientInterface {
  // GEN-PROPERTIES
  settings: SettingsApiClientInterface,
    auth: AuthApiClientInterface
}
