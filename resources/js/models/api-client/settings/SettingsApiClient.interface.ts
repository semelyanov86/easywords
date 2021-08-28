import { SettingInterface } from '@/models/settings/setting.interface'
import {LoadedSettingsInterface} from "@/models/settings/LoadedSettingsInterface";

/**
 * @Name SettingsApiClientInterface
 * @description
 * Interface for the Items api client module
 */
export interface SettingsApiClientInterface {
  fetchItems: () => Promise<LoadedSettingsInterface>
}
