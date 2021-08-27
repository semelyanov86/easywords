// group our constants in a namespace
// GEN-IMPORTS
import { SettingsMutationType } from '../settings/SettingsMutationType'
import { LocalesMutationType } from '../locales/LocalesMutationType'

export namespace MutationType {
  // GEN-NAMESPACE-CONSTS
  export const settings = SettingsMutationType
  export const locales = LocalesMutationType
  // as you add more domain-specific mutation types, add them here following the same convention
}
