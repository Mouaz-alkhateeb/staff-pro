import type { UserStatus, UserStatusSearchFilter } from '@/models/UserStatus/userStatus'
import type { CustomResponseCollection, CustomResponseSingle } from '@/utils/response'
import type { AxiosInstance } from 'axios'

export async function deleteUserStatusApi(
  api: AxiosInstance,
  userstatusId: number,
): Promise<{ response: CustomResponseCollection }> {
  const { data: response } = await api.delete(`userstatus/${userstatusId}`)

  return { response }
}
export async function addUserStatusApi(
  api: AxiosInstance,
  userstatus: UserStatus,
): Promise<{ response: CustomResponseSingle }> {
  const { data: response } = await api.post(`userstatus`, userstatus)

  return { response }
}
export async function editUserStatusApi(
  api: AxiosInstance,
  userstatus: UserStatus,
): Promise<{ response: CustomResponseSingle }> {
  const { data: response } = await api.put(`userstatus/${userstatus.id}`, userstatus)
  return { response }
}
export async function getUserStatusApi(
  api: AxiosInstance,
  userstatusId: number,
): Promise<{ response: CustomResponseSingle }> {
  const { data: response } = await api.get(`userstatus/${userstatusId}`)

  return { response }
}
export async function getUserStatusesApi(
  api: AxiosInstance,
  searchFilter: UserStatusSearchFilter,
): Promise<{ response: CustomResponseCollection }> {
  const { data: response } = await api.get('userstatus/getStatusList', {
    params: searchFilter,
  })
  return { response }
}
