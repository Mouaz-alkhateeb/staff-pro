import { createI18n, type DefaultLocaleMessageSchema } from 'vue-i18n'

const i18n = createI18n<[DefaultLocaleMessageSchema], 'ar' | 'en'>({
  locale: 'ar',
  fallbackLocale: 'en',
})
export class BaseConsts {
  static readonly ACTIVE = 1
  static readonly INACTIVE = 0
  static readonly TRUE = 1
  static readonly FALSE = 0
  static readonly MALE = 'male'
  static readonly FEMALE = 'female'

  public static showStatusName(status: number): string {
    if (status === BaseConsts.ACTIVE) return i18n.global.t('status.active')
    if (status === BaseConsts.INACTIVE) return i18n.global.t('status.inactive')
    return ''
  }
  public static showBoolean(value: number | undefined): string {
    if (value === BaseConsts.TRUE) return i18n.global.t('boolean.true')

    if (value === BaseConsts.FALSE) return i18n.global.t('boolean.false')
    if (value === undefined) return i18n.global.t('place_holder.none')

    return i18n.global.t('place_holder.none')
  }
}
