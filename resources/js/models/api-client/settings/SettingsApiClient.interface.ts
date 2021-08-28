import { SettingInterface } from '@/models/settings/setting.interface'
import {LoadedSettingsInterface} from "@/models/settings/LoadedSettingsInterface";
import {UpdateSettingsInterface} from "@/models/settings/updateSettings.interface";

/**
 * @Name SettingsApiClientInterface
 * @description
 * Interface for the Items api client module
 */
export interface SettingsApiClientInterface {
    fetchItems: () => Promise<LoadedSettingsInterface>,
    updateSetting: (data:UpdateSettingsInterface) => Promise<void>
}
