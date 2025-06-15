/* eslint-disable @typescript-eslint/no-explicit-any */
/* eslint-disable prefer-const */
import { useApi } from '@/composable/useApi'
import type { City, CitySearchFilter } from '@/models/City/city'
import {
  addCityApi,
  deleteCityApi,
  editCityApi,
  getCitiesApi,
  getCityApi,
} from '@/utils/api/City/cities'
import { defaultPagination, type Pagination } from '@/utils/response'
import { acceptHMRUpdate, defineStore } from 'pinia'
import { ref } from 'vue'

export const useCity = defineStore('city', () => {
  const api = useApi()
  const cities = ref<City[]>([])
  const pagination = ref<Pagination>(defaultPagination)
  const success = ref<boolean>()
  const error_code = ref<string>()
  const message = ref<string>()

  async function addCityStore(city: City) {
    try {
      const response = await addCityApi(api, city)
      let returnedCity: City
      returnedCity = response.response.data
      cities.value.push(returnedCity)
      success.value = response.response.success
      error_code.value = response.response.error_code
      message.value = response.response.message

      return returnedCity
    } catch (error: any) {
      success.value = error?.response.data.success
      error_code.value = error?.response.data.error_code
      message.value = error?.response.data.message
    }
  }

  async function getCitiesStore(searchFilter: CitySearchFilter) {
    try {
      const returnedResponse = await getCitiesApi(api, searchFilter)
      cities.value = returnedResponse.response.data
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

  async function getCityStore(cityId: number) {
    try {
      const response = await getCityApi(api, cityId)
      let returnedCity: City
      returnedCity = response.response.data
      success.value = response.response.success
      error_code.value = response.response.error_code
      message.value = response.response.message

      return returnedCity
    } catch (error: any) {
      success.value = error?.response.data.success
      error_code.value = error?.response.data.error_code
      message.value = error?.response.data.message
    }
  }

  async function editCityStore(city: City) {
    try {
      const response = await editCityApi(api, city)
      let returnedCity: City
      returnedCity = response.response.data
      cities.value.splice(
        cities.value.findIndex((cityElement) => (cityElement.id = city.id)),
        1,
      )
      success.value = response.response.success
      error_code.value = response.response.error_code
      message.value = response.response.message

      cities.value.push(returnedCity)
    } catch (error: any) {
      success.value = error?.response.data.success
      error_code.value = error?.response.data.error_code
      message.value = error?.response.data.message
    }
  }

  async function deleteCityStore(cityId: number) {
    try {
      const response = await deleteCityApi(api, cityId)
      cities.value.splice(
        cities.value.findIndex((city: City) => city.id === cityId),
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

  return {
    success,
    error_code,
    message,
    cities,
    pagination,
    addCityStore,
    getCitiesStore,
    getCityStore,
    editCityStore,
    deleteCityStore,
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
  import.meta.hot.accept(acceptHMRUpdate(useCity, import.meta.hot))
}
