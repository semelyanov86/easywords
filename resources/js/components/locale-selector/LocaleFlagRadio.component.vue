<template>
    <i @click="onClick" :class="`ml-2 flag-icons ${localeInfo.flag} ${localeInfo.selected ? 'selected' : ''}`"></i>
</template>

<script lang="ts">
  import { defineComponent, reactive, computed, ref } from 'vue'
  import { useI18n } from 'vue-i18n'
  import { LocaleInfoInterface } from '@/models/localization/LocaleInfo.interface'
  import { i18n } from '@/plugins/vue-i18n-next-plugin'

  export default defineComponent({
    props: {
      localeInfo: {
        type: Object
      }
    },
    emits: ['clicked'],
    setup(props, { emit }) {
      const i18n = useI18n()

      const onClick = () => {
        emit('clicked', props.localeInfo)
      }

      return {
        onClick
      }
    }
  })
</script>
<style scoped>
.selected {
    background-color: #42b983;
    border-radius: 15px;
    margin: 5px;
}
</style>
