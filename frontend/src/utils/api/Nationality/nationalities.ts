import type { Nationality, NationalitySearchFilter } from '@/models/Nationality/nationality'
import type { CustomResponseCollection, CustomResponseSingle } from '@/utils/response'
import type { AxiosInstance } from 'axios'

export async function deleteNationalityApi(
  api: AxiosInstance,
  nationalityId: number,
): Promise<{ response: CustomResponseCollection }> {
  const { data: response } = await api.delete(`nationality/${nationalityId}`)

  return { response }
}
export async function addNationalityApi(
  api: AxiosInstance,
  nationality: Nationality,
): Promise<{ response: CustomResponseSingle }> {
  const { data: response } = await api.post(`nationality`, nationality)

  return { response }
}
export async function editNationalityApi(
  api: AxiosInstance,
  nationality: Nationality,
): Promise<{ response: CustomResponseSingle }> {
  const { data: response } = await api.put(`nationality/${nationality.id}`, nationality)
  return { response }
}
export async function getNationalityApi(
  api: AxiosInstance,
  nationalityId: number,
): Promise<{ response: CustomResponseSingle }> {
  const { data: response } = await api.get(`nationality/${nationalityId}`)

  return { response }
}
export async function getNationalitiesApi(
  api: AxiosInstance,
  searchFilter: NationalitySearchFilter,
): Promise<{ response: CustomResponseCollection }> {
  const { data: response } = await api.get('nationality/getNationalitiesList', {
    params: searchFilter,
  })
  return { response }
}
