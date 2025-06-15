/* eslint-disable no-var */
/* eslint-disable @typescript-eslint/no-explicit-any */
import { useApi } from '@/composable/useApi'
import type { Nationality, NationalitySearchFilter } from '@/models/Nationality/nationality'
import {
  addNationalityApi,
  deleteNationalityApi,
  editNationalityApi,
  getNationalitiesApi,
  getNationalityApi,
} from '@/utils/api/Nationality/nationalities'
import { defaultPagination, type Pagination } from '@/utils/response'
import { acceptHMRUpdate, defineStore } from 'pinia'
import { ref } from 'vue'

export const useNationality = defineStore('nationality', () => {
  const api = useApi()
  const nationalities = ref<Nationality[]>([])
  const pagination = ref<Pagination>(defaultPagination)
  const loading = ref(false)
  const success = ref<boolean>()
  const error_code = ref<string>()
  const message = ref<string>()

  async function deleteNationalityStore(nationalityId: number) {
    if (loading.value) return

    loading.value = true

    try {
      const response = await deleteNationalityApi(api, nationalityId)
      nationalities.value.splice(
        nationalities.value.findIndex(
          (nationality: Nationality) => nationality.id === nationalityId,
        ),
        1,
      )
      success.value = response.response.success
      error_code.value = response.response.error_code
      message.value = response.response.message
    } catch (error: any) {
      success.value = error?.response.data.success
      error_code.value = error?.response.data.error_code
      message.value = error?.response.data.message
    } finally {
      loading.value = false
    }
  }
  async function getNationalityStore(nationalityId: number) {
    try {
      const response = await getNationalityApi(api, nationalityId)
      var returnedNationality: Nationality
      returnedNationality = response.response.data
      success.value = response.response.success
      error_code.value = response.response.error_code
      message.value = response.response.message

      return returnedNationality
    } catch (error: any) {
      success.value = error?.response.data.success
      error_code.value = error?.response.data.error_code
      message.value = error?.response.data.message
    } finally {
      loading.value = false
    }
  }
  async function addNationalityStore(nationality: Nationality) {
    try {
      const response = await addNationalityApi(api, nationality)
      var returnedNationality: Nationality
      returnedNationality = response.response.data
      nationalities.value.push(returnedNationality)
      success.value = response.response.success
      error_code.value = response.response.error_code
      message.value = response.response.message

      return returnedNationality
    } catch (error: any) {
      success.value = error?.response.data.success
      error_code.value = error?.response.data.error_code
      message.value = error?.response.data.message
    }
  }
  async function editNationalityStore(nationality: Nationality) {
    try {
      const response = await editNationalityApi(api, nationality)
      var returnedNationality: Nationality
      returnedNationality = response.response.data
      nationalities.value.splice(
        nationalities.value.findIndex(
          (nationalityElement) => (nationalityElement.id = nationality.id),
        ),
        1,
      )
      nationalities.value.push(returnedNationality)
      success.value = response.response.success
      error_code.value = response.response.error_code
      message.value = response.response.message
    } catch (error: any) {
      success.value = error?.response.data.success
      error_code.value = error?.response.data.error_code
      message.value = error?.response.data.message
    } finally {
      loading.value = false
    }
  }
  async function getNationalities(searchFilter: NationalitySearchFilter) {
    if (loading.value) return

    loading.value = true

    try {
      const returnedResponse = await getNationalitiesApi(api, searchFilter)
      nationalities.value = returnedResponse.response.data
      pagination.value = returnedResponse.response.pagination
      success.value = returnedResponse.response.success
      error_code.value = returnedResponse.response.error_code
      message.value = returnedResponse.response.message
    } catch (error: any) {
      success.value = error?.response.data.success
      error_code.value = error?.response.data.error_code
      message.value = error?.response.data.message
    } finally {
      loading.value = false
    }
  }

  return {
    success,
    error_code,
    message,
    nationalities,
    pagination,
    loading,
    deleteNationalityStore,
    addNationalityStore,
    editNationalityStore,
    getNationalityStore,
    getNationalities,
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
  import.meta.hot.accept(acceptHMRUpdate(useNationality, import.meta.hot))
}
