import createI18n from "vue-i18n";
import VueMessageType from "vue-i18n";
import {
    LocaleMessages
    //DateTimeFormat, // TODO: see if vue-i18n@next alpha 13 has a type for this
    //NumberFormats // TODO: see if vue-i18n@next alpha 13 has a type for this
} from 'vue-i18n'

interface LocalesDataInterface {
    messages: LocaleMessages
}

/**
 * @name: getLocalesData
 * @description: Helper to load the locale json files with each locale data
 */
const getLocalesData = (): LocalesDataInterface => {
    // we use require.context to get all the .json files under the locales sub-directory
    const files = (require as any).context('./locales', true, /[A-Za-z0-9-_,\s]+\.json$/i)
    // create the instance that will hold the loaded data
    const localeData: LocalesDataInterface = {
        messages: {}
    }
    // loop through all the files
    const keys: string[] = files.keys()
    keys.forEach((key: string) => {
        // extract name without extension
        const matched = key.match(/([A-Za-z0-9-_]+)\./i)
        if (matched && matched.length > 1) {
            const localeId = matched[1]
            localeData.messages[localeId] = files(key).messages
        }
    })

    return localeData
}

// create our data dynamically by loading the JSON files through our getLocalesData helper
const data: LocalesDataInterface = getLocalesData()

// create out vue-18n instance
export const i18n = new createI18n({
    locale: 'ru-RU',
    fallbackLocale: 'en-US',
    messages: data.messages
})
