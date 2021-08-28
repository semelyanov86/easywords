import { rootStore, dispatchModuleAction } from '../root'
import { StoreModuleNames, UserStateInterface } from '../../models/store'

/**
 * @name userStore
 * @description
 * The items store wrapper that returns the itemsState and exposes a generic action<T> method
 */
const userStore = {
    get state(): UserStateInterface {
        return rootStore.state.userState
    },
    action<T>(actionName: string, params?: T): void {
        dispatchModuleAction(StoreModuleNames.userState, actionName, params)
    }
}
// export our wrapper using the composition API convention (i.e. useXYZ)
export const useUserStore = () => {
    return userStore
}
