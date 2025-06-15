import { BaseConsts } from '@/utils/consts/base'

export interface Nationality {
  id?: number
  name: string
  status: number
}
export interface NationalitySearchFilter {
  name?: string
  status?: number
  page?: number
  per_page?: number
  order_by?: string
  order?: string
}
export const defaultNationality: Nationality = {
  id: 0,
  name: '',
  status: 1,
}

export const defaultNationalitySearchFilter: NationalitySearchFilter = {
  name: undefined,
  status: undefined,
  page: undefined,
  order: undefined,
  order_by: undefined,
  per_page: 10,
}
const NationalityConsts = BaseConsts
export { NationalityConsts }
