import { rootStore, dispatchModuleAction } from '../root'
import { StoreModuleNames, SettingsStateInterface } from '../../models/store'

/**
 * @name settingsStore
 * @description
 * The items store wrapper that returns the itemsState and exposes a generic action<T> method
 */
const settingsStore = {
    get state(): SettingsStateInterface {
        return rootStore.state.settingsState
    },
    action<T>(actionName: string, params?: T): void {
        dispatchModuleAction(StoreModuleNames.settingsState, actionName, params)
    }
}
// export our wrapper using the composition API convention (i.e. useXYZ)
export const useSettingsStore = () => {
    return settingsStore
}
