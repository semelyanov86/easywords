// GEN-IMPORTS
import { SettingsApiClientInterface } from './settings'
import { WordsApiClientInterface } from './words'
import {AuthApiClientInterface} from "./auth";
import {UserApiClientInterface} from "./user";
import {StatisticsApiClientInterface} from "@/models/api-client/statistics";

/**
 * @Name ApiClientInterface
 * @description
 * Interface wraps all api client modules into one places for keeping code organized.
 */
export interface ApiClientInterface {
  // GEN-PROPERTIES
    settings: SettingsApiClientInterface,
    auth: AuthApiClientInterface,
    user: UserApiClientInterface,
    words: WordsApiClientInterface,
    statistics: StatisticsApiClientInterface
}
