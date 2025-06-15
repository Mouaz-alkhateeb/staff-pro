import type { City, CitySearchFilter } from '@/models/City/city'
import type { CustomResponseCollection, CustomResponseSingle } from '@/utils/response'
import type { AxiosInstance } from 'axios'

export async function addCityApi(
  api: AxiosInstance,
  city: City,
): Promise<{ response: CustomResponseSingle }> {
  const { data: response } = await api.post(`city`, city)

  return { response }
}

export async function getCitiesApi(
  api: AxiosInstance,
  searchFilter: CitySearchFilter,
): Promise<{ response: CustomResponseCollection }> {
  const { data: response } = await api.get('city', {
    params: searchFilter,
  })
  return { response }
}

export async function getCityApi(
  api: AxiosInstance,
  cityId: number,
): Promise<{ response: CustomResponseSingle }> {
  const { data: response } = await api.get(`city/${cityId}`)

  return { response }
}

export async function editCityApi(
  api: AxiosInstance,
  city: City,
): Promise<{ response: CustomResponseSingle }> {
  const { data: response } = await api.put(`city/${city.id}`, city)
  return { response }
}

export async function deleteCityApi(
  api: AxiosInstance,
  cityId: number,
): Promise<{ response: CustomResponseCollection }> {
  const { data: response } = await api.delete(`city/${cityId}`)

  return { response }
}
