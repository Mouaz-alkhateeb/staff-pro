import { defaultCity, type City, type CitySearchFilter } from '@/models/City/city'
import { useCity } from '@/stores/City/cityStore'
import type { Pagination } from '@/utils/response'

export async function addCity(cityData: City) {
  const cityResponse = useCity()
  const city: City = (await cityResponse.addCityStore(cityData)) ?? defaultCity
  const success: boolean = cityResponse.success ?? false
  const error_code: string = cityResponse.error_code ?? ''
  const message: string = cityResponse.message ?? ''
  return { success, error_code, message, city }
}

export async function getCitiesList(searchFilter: CitySearchFilter) {
  const city = useCity()
  await city.getCitiesStore(searchFilter)
  const cities: City[] = city.cities
  const pagination: Pagination = city.pagination
  const success: boolean = city.success ?? false
  const error_code: string = city.error_code ?? ''
  const message: string = city.message ?? ''

  return { cities, pagination, success, error_code, message }
}

export async function getCity(cityId: number) {
  const cityResponse = useCity()
  const city: City = (await cityResponse.getCityStore(cityId)) ?? defaultCity
  const success: boolean = cityResponse.success ?? false
  const error_code: string = cityResponse.error_code ?? ''
  const message: string = cityResponse.message ?? ''
  return { success, error_code, message, city }
}

export async function editCity(cityData: City) {
  const cityResponse = useCity()
  await cityResponse.editCityStore(cityData)
  const success: boolean = cityResponse.success ?? false
  const error_code: string = cityResponse.error_code ?? ''
  const message: string = cityResponse.message ?? ''
  return { success, error_code, message }
}

export async function deleteCity(cityId: number) {
  const cityResponse = useCity()
  await cityResponse.deleteCityStore(cityId)
  const success: boolean = cityResponse.success ?? false
  const error_code: string = cityResponse.error_code ?? ''
  const message: string = cityResponse.message ?? ''
  return { success, error_code, message }
}
