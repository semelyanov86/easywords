import { mount } from '@vue/test-utils'
import Language from '@/components/settings/children/Language.component.vue'

describe('Item.component.vue: appearance', () => {
    it('renders an Item correctly', () => {

        const wrapper = mount(Language, {
            props: {
                language: 'DE',
                main_language: 'RU'
            }
        })

        const classes = wrapper.classes()
        expect(classes)
            .toBe('array')


        // this just tests that the entire text rendered by the component somewhere rendered
        // 'Unit test item 1', but this is not very precise.
        expect(wrapper.text()).toContain('RU -> DE')

        // this is more precise as we are selecting the div with the class name and check if it rendered the correct text
        let domEl = wrapper.find('li')
        expect(domEl.text()).toContain('RU -> DE')
    })
})
