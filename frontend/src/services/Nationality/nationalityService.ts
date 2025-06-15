import {
  defaultNationality,
  type Nationality,
  type NationalitySearchFilter,
} from '@/models/Nationality/nationality'
import { useNationality } from '@/stores/Nationality/nationalityStore'
import type { Pagination } from '@/utils/response'

export async function addNationality(nationalityData: Nationality) {
  const nationalityResponse = useNationality()
  const nationality: Nationality =
    (await nationalityResponse.addNationalityStore(nationalityData)) ?? defaultNationality
  const success: boolean = nationalityResponse.success ?? false
  const error_code: string = nationalityResponse.error_code ?? ''
  const message: string = nationalityResponse.message ?? ''
  return { success, error_code, message, nationality }
}
export async function deleteNationality(nationalityId: number) {
  const nationalityResponse = useNationality()
  await nationalityResponse.deleteNationalityStore(nationalityId)
  const success: boolean = nationalityResponse.success ?? false
  const error_code: string = nationalityResponse.error_code ?? ''
  const message: string = nationalityResponse.message ?? ''
  return { success, error_code, message }
}

export async function editNationality(nationalityData: Nationality) {
  const nationalityResponse = useNationality()
  await nationalityResponse.editNationalityStore(nationalityData)
  const success: boolean = nationalityResponse.success ?? false
  const error_code: string = nationalityResponse.error_code ?? ''
  const message: string = nationalityResponse.message ?? ''
  return { success, error_code, message }
}

export async function getNationalitiesList(searchFilter: NationalitySearchFilter) {
  const nationalityResponse = useNationality()
  await nationalityResponse.getNationalities(searchFilter)
  const nationalities: Nationality[] = nationalityResponse.nationalities
  const pagination: Pagination = nationalityResponse.pagination
  const success: boolean = nationalityResponse.success ?? false
  const error_code: string = nationalityResponse.error_code ?? ''
  const message: string = nationalityResponse.message ?? ''

  return { nationalities, pagination, success, error_code, message }
}

export async function getNationality(nationalityId: number) {
  const nationalityResponse = useNationality()
  const nationality: Nationality =
    (await nationalityResponse.getNationalityStore(nationalityId)) ?? defaultNationality
  const success: boolean = nationalityResponse.success ?? false
  const error_code: string = nationalityResponse.error_code ?? ''
  const message: string = nationalityResponse.message ?? ''

  return { success, error_code, message, nationality }
}
