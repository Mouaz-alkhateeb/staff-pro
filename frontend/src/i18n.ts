// src/i18n.ts
import { createI18n } from 'vue-i18n'

import en from './locales/en.json'
import ar from './locales/ar.json'
import { useStorage } from '@vueuse/core'

const defaultLocale = useStorage('locale', 'en')
const i18n = createI18n({
  legacy: false,
  locale: defaultLocale.value,
  fallbackLocale: 'en',
  messages: {
    en,
    ar,
  },
})

export default i18n
