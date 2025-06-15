/* eslint-disable prefer-const */
/* eslint-disable @typescript-eslint/no-explicit-any */
import { useApi } from '@/composable/useApi'
import type { Department, DepartmentSearchFilter } from '@/models/Department/department'
import {
  addDepartmentApi,
  deleteDepartmentApi,
  editDepartmentApi,
  getDepartmentApi,
  getDepartmentsApi,
} from '@/utils/api/Department'
import { defaultPagination, type Pagination } from '@/utils/response'
import { acceptHMRUpdate, defineStore } from 'pinia'
import { ref } from 'vue'

export const useDepartment = defineStore('department', () => {
  const api = useApi()
  const departments = ref<Department[]>([])
  const pagination = ref<Pagination>(defaultPagination)
  const success = ref<boolean>()
  const error_code = ref<string>()
  const message = ref<string>()

  async function deleteDepartmentStore(departmentId: number) {
    try {
      const response = await deleteDepartmentApi(api, departmentId)
      departments.value.splice(
        departments.value.findIndex((department: Department) => department.id === departmentId),
        1,
      )
      success.value = response.response.success
      error_code.value = response.response.error_code
      message.value = response.response.message
    } catch (error: any) {
      success.value = error?.response.data.success
      error_code.value = error?.response.data.error_code
      message.value = error?.response.data.message
    }
  }
  async function getDepartmentStore(departmentId: number) {
    try {
      const response = await getDepartmentApi(api, departmentId)
      let returnedDepartment: Department
      returnedDepartment = response.response.data
      success.value = response.response.success
      error_code.value = response.response.error_code
      message.value = response.response.message

      return returnedDepartment
    } catch (error: any) {
      success.value = error?.response.data.success
      error_code.value = error?.response.data.error_code
      message.value = error?.response.data.message
    }
  }
  async function addDepartmentStore(department: Department) {
    try {
      const response = await addDepartmentApi(api, department)
      let returnedDepartment: Department
      returnedDepartment = response.response.data
      departments.value.push(returnedDepartment)
      success.value = response.response.success
      error_code.value = response.response.error_code
      message.value = response.response.message

      return returnedDepartment
    } catch (error: any) {
      success.value = error?.response.data.success
      error_code.value = error?.response.data.error_code
      message.value = error?.response.data.message
    }
  }
  async function editDepartmentStore(department: Department) {
    try {
      const response = await editDepartmentApi(api, department)
      let returnedDepartment: Department

      returnedDepartment = response.response.data
      departments.value.splice(
        departments.value.findIndex((departmentElement) => (departmentElement.id = department.id)),
        1,
      )
      success.value = response.response.success
      error_code.value = response.response.error_code
      message.value = response.response.message

      departments.value.push(returnedDepartment)
    } catch (error: any) {
      success.value = error?.response.data.success
      error_code.value = error?.response.data.error_code
      message.value = error?.response.data.message
    }
  }
  async function getDepartmentsStore(searchFilter: DepartmentSearchFilter) {
    try {
      const returnedResponse = await getDepartmentsApi(api, searchFilter)
      departments.value = returnedResponse.response.data
      pagination.value = returnedResponse.response.pagination
      success.value = returnedResponse.response.success
      error_code.value = returnedResponse.response.error_code
      message.value = returnedResponse.response.message
    } catch (error: any) {
      success.value = error?.response.data.success
      error_code.value = error?.response.data.error_code
      message.value = error?.response.data.message
    }
  }

  return {
    success,
    error_code,
    message,
    departments,
    pagination,
    deleteDepartmentStore,
    addDepartmentStore,
    editDepartmentStore,
    getDepartmentStore,
    getDepartmentsStore,
  } as const
})

/**
 * Pinia supports Hot Module replacement so you can edit your stores and
 * interact with them directly in your app without reloading the page.
 *
 * @see https://pinia.esm.dev/cookbook/hot-module-replacement.html
 * @see https://vitejs.dev/guide/api-hmr.html
 */
if (import.meta.hot) {
  import.meta.hot.accept(acceptHMRUpdate(useDepartment, import.meta.hot))
}
