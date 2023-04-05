// GEN-IMPORTS
import { SettingsStateInterface } from '../settings/SettingsState.interface';
import { WordsStateInterface } from '../words/WordsState.interface';
import { UserStateInterface } from '../user/UserState.interface';
import { LocalesStateInterface } from '../locales/LocalesState.interface';

/**
 * @name RootStoreInterface
 * @description
 * Wraps together each store module interface in one place
 */
export interface RootStoreInterface {
    // GEN-INTERFACE-PROPS
    settingsState: SettingsStateInterface;
    localesState: LocalesStateInterface;
    userState: UserStateInterface;
    wordsState: WordsStateInterface;
    // additional domain-specific module interfaces we’ll be added here in the next book chapters
}
