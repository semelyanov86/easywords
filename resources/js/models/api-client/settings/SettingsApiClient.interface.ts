import { SettingInterface } from '@/models/settings/setting.interface'

/**
 * @Name SettingsApiClientInterface
 * @description
 * Interface for the Items api client module
 */
export interface SettingsApiClientInterface {
  fetchItems: () => Promise<SettingInterface[]>
}
