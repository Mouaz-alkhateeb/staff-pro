import {
  defaultDepartment,
  type Department,
  type DepartmentSearchFilter,
} from '@/models/Department/department'
import { useDepartment } from '@/stores/Department/departmentsStore'
import type { Pagination } from '@/utils/response'

export async function addDepartment(departmentData: Department) {
  const departmentResponse = useDepartment()
  const department: Department =
    (await departmentResponse.addDepartmentStore(departmentData)) ?? defaultDepartment
  const success: boolean = departmentResponse.success ?? false
  const error_code: string = departmentResponse.error_code ?? ''
  const message: string = departmentResponse.message ?? ''
  return { success, error_code, message, department }
}
export async function getDepartment(departmentId: number) {
  const departmentResponse = useDepartment()
  const department: Department =
    (await departmentResponse.getDepartmentStore(departmentId)) ?? defaultDepartment
  const success: boolean = departmentResponse.success ?? false
  const error_code: string = departmentResponse.error_code ?? ''
  const message: string = departmentResponse.message ?? ''
  return { success, error_code, message, department }
}
export async function editDepartment(departmentData: Department) {
  const departmentResponse = useDepartment()
  await departmentResponse.editDepartmentStore(departmentData)
  const success: boolean = departmentResponse.success ?? false
  const error_code: string = departmentResponse.error_code ?? ''
  const message: string = departmentResponse.message ?? ''
  return { success, error_code, message }
}
export async function deleteDepartment(departmentId: number) {
  const departmentResponse = useDepartment()
  await departmentResponse.deleteDepartmentStore(departmentId)
  const success: boolean = departmentResponse.success ?? false
  const error_code: string = departmentResponse.error_code ?? ''
  const message: string = departmentResponse.message ?? ''
  return { success, error_code, message }
}
export async function getDepartmentsList(searchFilter: DepartmentSearchFilter) {
  const departmentResponse = useDepartment()
  await departmentResponse.getDepartmentsStore(searchFilter)
  const success: boolean = departmentResponse.success ?? false
  const departments: Department[] = departmentResponse.departments
  const pagination: Pagination = departmentResponse.pagination

  const error_code: string = departmentResponse.error_code ?? ''
  const message: string = departmentResponse.message ?? ''
  return { success, error_code, message, departments, pagination }
}
