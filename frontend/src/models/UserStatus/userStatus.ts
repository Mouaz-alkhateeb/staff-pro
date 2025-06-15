import { createI18n, type DefaultLocaleMessageSchema } from 'vue-i18n'

const i18n = createI18n<[DefaultLocaleMessageSchema], 'ar' | 'en'>({
  locale: 'ar',
  fallbackLocale: 'en',
})

export interface UserStatus {
  id?: number
  name: string
}
export interface UserStatusSearchFilter {
  name?: string
  page?: number
  per_page?: number
  order_by?: string
  order?: string
}
export const defaultUserStatus: UserStatus = {
  id: 0,
  name: '',
}

export const defaultUserStatusSearchFilter: UserStatusSearchFilter = {
  name: undefined,
  page: undefined,
  order: undefined,
  order_by: undefined,
  per_page: 10,
}

class UserStatusConsts {
  static readonly ACTIVE = 1
  static readonly INACTIVE = 2

  public static getStatusName(status: number | undefined): string {
    if (status === this.ACTIVE) return i18n.global.t('user_statuses.active')
    if (status === this.INACTIVE) return i18n.global.t('user_statuses.inactive')
    return ''
  }

  public static getStatusColor(status: number | undefined) {
    if (status == this.ACTIVE) return 'success'
    if (status == this.INACTIVE) return 'danger'
    else return undefined
  }
}
export { UserStatusConsts }
