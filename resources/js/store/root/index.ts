import { createStore, StoreOptions } from 'vuex';

import { RootStateInterface, RootStoreModel } from '@/models/store';

import { initialRootState } from './initialState';

// import each Vuex module
// GEN-IMPORTS-STATE
import { settingsState } from '../settings/module';
import { wordsState } from '../words/module';
import { userState } from '../user/module';
import { localesState } from '../locales/module';
import { WordInterface } from '@/models/words/Word.interface';

/**
 * @name storeOptions
 * @description
 * Vuex store options to build our modularized namespaced store
 */
const storeOptions: StoreOptions<RootStateInterface> = {
    state: initialRootState,

    modules: {
        // GEN-MODULES
        settingsState,
        localesState,
        userState,
        wordsState,
        // as you create additional modules, you'll add them here similar to the itemsState
    },
};

// Vuex Root store instance
export const rootStore: RootStoreModel<RootStateInterface> = <any>createStore(storeOptions);

/**
 * @name dispatchModuleAction
 * @description
 * Private helper to dispatch an action to a Vuex module from one place
 * So we keep the string interpolation for `${moduleName}/${actionName}` in one place only
 * and be able to dispatch action with less code in a strongly-type way
 * @param moduleName
 * @param actionName
 * @param params
 */
export function dispatchModuleAction<T>(moduleName: string, actionName: string, params?: T): void {
    rootStore.dispatch(`${moduleName}/${actionName}`, params);
}
