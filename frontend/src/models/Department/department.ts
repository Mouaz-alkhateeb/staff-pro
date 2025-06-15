import { BaseConsts } from '@/utils/consts/base'

export interface Department {
  id?: number
  name: string
  status: number
}

export const defaultDepartment: Department = {
  id: 0,
  name: '',
  status: 1,
}

export interface DepartmentSearchFilter {
  name?: string
  status?: number
  page?: number
  order_by?: string
  order?: string
  per_page?: number
}

export const defaultDepartmentSearchFilter: DepartmentSearchFilter = {
  name: undefined,
  status: undefined,
  page: undefined,
  order: undefined,
  order_by: undefined,
  per_page: 10,
}
const DepartmentConsts = BaseConsts
export { DepartmentConsts }
