import { toFormValidator } from '@vee-validate/zod'
import { z as zod } from 'zod'
import { createI18n, type DefaultLocaleMessageSchema } from 'vue-i18n'

const i18n = createI18n<[DefaultLocaleMessageSchema], 'ar' | 'en'>({
  locale: 'ar',
  fallbackLocale: 'en',
})

const nationalityvalidationSchema = toFormValidator(
  zod.object({
    name: zod
      .string({
        required_error: i18n.global.t('validation.required'),
      })
      .min(1, i18n.global.t('validation.required')),
    status: zod.number({ required_error: i18n.global.t('validation.redio.required') }),
  }),
)
export { nationalityvalidationSchema }
