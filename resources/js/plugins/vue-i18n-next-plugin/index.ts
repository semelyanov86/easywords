import {
    createI18n,
    VueMessageType,
    LocaleMessages,
    //DateTimeFormat, // TODO: see if vue-i18n@next alpha 13 has a type for this
    //NumberFormats // TODO: see if vue-i18n@next alpha 13 has a type for this
} from 'vue-i18n'


interface LocalesDataInterface {
    datetimeFormats: any // TODO: see if vue-i18n@next alpha 13 has a type for this
    numberFormats: any // TODO: see if vue-i18n@next alpha 13 has a type for this
    messages: LocaleMessages<VueMessageType>
}

/**
 * @name: getLocalesData
 * @description: Helper to load the locale json files with each locale data
 */
const getLocalesData = (): LocalesDataInterface => {
    // we use require.context to get all the .json files under the locales sub-directory
    // const files = require.context('./locales', true, /^.*$/)
    const files = import.meta.glob('./locales/*.json')
    // create the instance that will hold the loaded data
    const localeData: LocalesDataInterface = {
        datetimeFormats: {},
        numberFormats: {},
        messages: {}
    }
    // loop through all the files
    for (const path in files) {
        files[path]().then((mod: any) => {
            const matched = path.match(/([A-Za-z0-9-_]+)\./i)
            if (matched && matched.length > 1) {
                const localeId = matched[1]
                // from each file, set the related messages property
                localeData.datetimeFormats[localeId] = mod.datetimeFormats
                localeData.numberFormats[localeId] = mod.numberFormats
                localeData.messages[localeId] = mod.messages
            }
        })
    }

    return localeData
}

// create our data dynamically by loading the JSON files through our getLocalesData helper
const data: LocalesDataInterface = getLocalesData()

// create out vue-18n instance
export const i18n = createI18n({
    locale: 'ru-RU',
    fallbackLocale: 'en-US',
    message: data.messages,
    datetimeFormats: data.datetimeFormats,
    numberFormats: data.numberFormats
})
