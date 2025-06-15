import { BaseConsts } from '@/utils/consts/base'

export interface City {
  id?: number
  name: string
  status: number
}
export interface CitySearchFilter {
  name?: string
  status?: number
  page?: number
  per_page?: number
  order_by?: string
  order?: string
}

export const defaultCity: City = {
  id: 0,
  name: '',
  status: 1,
}

export const defaultCitySearchFilter: CitySearchFilter = {
  name: undefined,
  status: undefined,
  page: undefined,
  order: undefined,
  order_by: undefined,
  per_page: 10,
}

const CityConsts = BaseConsts
export { CityConsts }
