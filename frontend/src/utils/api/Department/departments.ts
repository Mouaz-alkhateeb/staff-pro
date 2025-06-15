import type { Department, DepartmentSearchFilter } from '@/models/Department/department'
import type { CustomResponseCollection, CustomResponseSingle } from '@/utils/response'
import type { AxiosInstance } from 'axios'

export async function deleteDepartmentApi(
  api: AxiosInstance,
  departmentId: number,
): Promise<{ response: CustomResponseCollection }> {
  const { data: response } = await api.delete(`department/${departmentId}`)

  return { response }
}
export async function addDepartmentApi(
  api: AxiosInstance,
  department: Department,
): Promise<{ response: CustomResponseSingle }> {
  const { data: response } = await api.post(`department`, department)

  return { response }
}
export async function editDepartmentApi(
  api: AxiosInstance,
  department: Department,
): Promise<{ response: CustomResponseSingle }> {
  const { data: response } = await api.put(`department/${department.id}`, department)
  return { response }
}
export async function getDepartmentApi(
  api: AxiosInstance,
  departmentId: number,
): Promise<{ response: CustomResponseSingle }> {
  const { data: response } = await api.get(`department/${departmentId}`)

  return { response }
}
export async function getDepartmentsApi(
  api: AxiosInstance,
  searchFilter: DepartmentSearchFilter,
): Promise<{ response: CustomResponseCollection }> {
  const { data: response } = await api.get('department/getDepartmentsList', {
    params: searchFilter,
  })
  return { response }
}
