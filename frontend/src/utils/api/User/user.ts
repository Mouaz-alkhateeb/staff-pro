import type { ChangeUserStatus, CreateUpdateUser, UserSearchFilter } from '@/models/User/user'
import type { CustomResponseCollection, CustomResponseSingle } from '@/utils/response'
import type { AxiosInstance } from 'axios'

export async function deleteUserApi(
  api: AxiosInstance,
  userId: number,
): Promise<{ response: CustomResponseCollection }> {
  const { data: response } = await api.delete(`user/${userId}`)

  return { response }
}
export async function addUserApi(
  api: AxiosInstance,
  user: CreateUpdateUser,
): Promise<{ response: CustomResponseSingle }> {
  const { data: response } = await api.post(`user`, user)

  return { response }
}
export async function editUserApi(
  api: AxiosInstance,
  user: CreateUpdateUser,
): Promise<{ response: CustomResponseSingle }> {
  const { data: response } = await api.put(`user/${user.id}`, user)
  return { response }
}
export async function changeUserStatusApi(
  api: AxiosInstance,
  user: ChangeUserStatus,
): Promise<{ response: CustomResponseSingle }> {
  const { data: response } = await api.put(`user/${user.id}/changeUserStatus`, user)
  return { response }
}
export async function getUserApi(
  api: AxiosInstance,
  userId: number,
): Promise<{ response: CustomResponseSingle }> {
  const { data: response } = await api.get(`user/${userId}`)

  return { response }
}
export async function getUsersApi(
  api: AxiosInstance,
  searchFilter: UserSearchFilter,
): Promise<{ response: CustomResponseCollection }> {
  const { data: response } = await api.get('user/getUserList', {
    params: searchFilter,
  })
  return { response }
}
