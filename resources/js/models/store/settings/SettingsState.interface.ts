import { SettingInterface } from '@/models/settings/setting.interface'

/**
 * @name SettingsStateInterface
 * @description
 * Interface for the Settings state
 */
export interface SettingsStateInterface {
  loading: boolean
  settings: SettingInterface[]
}
