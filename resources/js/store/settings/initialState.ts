import { SettingsStateInterface } from '@/models/store'

/**
 * @name initialSettingsState
 * @description
 * The Items state instance with the initial default values
 */
export const initialSettingsState: SettingsStateInterface = {
    loading: false,
    settings: {
        "paginate": "20",
        "default_language": "DE",
        "starred_enabled": false,
        "known_enabled": false,
        "fresh_first": false,
        "languages_list": [
            "DE",
            "EN"
        ],
        "main_language": "RU"
    }
}
