import { toFormValidator } from '@vee-validate/zod'
import { z as zod } from 'zod'
import { createI18n, type DefaultLocaleMessageSchema } from 'vue-i18n'

const i18n = createI18n<[DefaultLocaleMessageSchema], 'ar' | 'en'>({
  locale: 'ar',
  fallbackLocale: 'en',
})

const uservalidationSchema = toFormValidator(
  zod.object({
    first_name: zod
      .string({
        required_error: i18n.global.t('validation.required'),
      })
      .min(1, i18n.global.t('validation.required')),

    last_name: zod
      .string({
        required_error: i18n.global.t('validation.required'),
      })
      .min(1, i18n.global.t('validation.required')),

    password: zod
      .string({
        required_error: i18n.global.t('validation.required'),
      })
      .min(6, i18n.global.t('validation.password.min')),

    phone_number: zod.preprocess(
      (input) => {
        const processed = zod.string().regex(/\d+/).transform(Number).safeParse(input)
        return processed.success ? processed.data : input
      },
      zod
        .number({
          required_error: i18n.global.t('validation.required'),
          invalid_type_error: i18n.global.t('validation.number.invalid_type_error'),
        })
        .min(9, i18n.global.t('validation.number.invalid_type_error')),
    ),

    address: zod
      .string({
        required_error: i18n.global.t('validation.required'),
      })
      .min(1, i18n.global.t('validation.required')),

    city_id: zod.preprocess(
      (input) => {
        const processed = zod.string().regex(/\d+/).transform(Number).safeParse(input)
        return processed.success ? processed.data : input
      },
      zod
        .number({
          required_error: i18n.global.t('validation.required'),
          invalid_type_error: i18n.global.t('validation.required'),
        })
        .min(1, i18n.global.t('validation.required')),
    ),

    room_id: zod.preprocess(
      (input) => {
        const processed = zod.string().regex(/\d+/).transform(Number).safeParse(input)
        return processed.success ? processed.data : input
      },
      zod
        .number({
          required_error: i18n.global.t('validation.required'),
          invalid_type_error: i18n.global.t('validation.required'),
        })
        .min(1, i18n.global.t('validation.required')),
    ),

    user_status_id: zod.preprocess(
      (input) => {
        const processed = zod.string().regex(/\d+/).transform(Number).safeParse(input)
        return processed.success ? processed.data : input
      },
      zod
        .number({
          required_error: i18n.global.t('validation.required'),
          invalid_type_error: i18n.global.t('validation.required'),
        })
        .min(1, i18n.global.t('validation.required')),
    ),
    gender: zod.string().min(1, i18n.global.t('validation.required')),
    birth_date: zod.string().min(1, i18n.global.t('validation.required')),

    roles: zod.array(zod.number()).nonempty(i18n.global.t('validation.roles.required')),
  }),
)

export { uservalidationSchema }
