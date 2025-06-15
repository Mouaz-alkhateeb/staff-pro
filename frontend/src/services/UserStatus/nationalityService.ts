import {
  defaultUserStatus,
  type UserStatus,
  type UserStatusSearchFilter,
} from '@/models/UserStatus/userStatus'
import { useUserStatus } from '@/stores/UserStatus/userStatusStore'
import type { Pagination } from '@/utils/response'

export async function addUserStatus(userstatusData: UserStatus) {
  const userstatusResponse = useUserStatus()
  const userStatus: UserStatus =
    (await userstatusResponse.addUserStatusStore(userstatusData)) ?? defaultUserStatus
  const success: boolean = userstatusResponse.success ?? false
  const error_code: string = userstatusResponse.error_code ?? ''
  const message: string = userstatusResponse.message ?? ''
  return { success, error_code, message, userStatus }
}
export async function deleteUserStatus(userstatusId: number) {
  const userstatusResponse = useUserStatus()
  await userstatusResponse.deleteUserStatusStore(userstatusId)
  const success: boolean = userstatusResponse.success ?? false
  const error_code: string = userstatusResponse.error_code ?? ''
  const message: string = userstatusResponse.message ?? ''
  return { success, error_code, message }
}
export async function editUserStatus(userstatusData: UserStatus) {
  const userstatusResponse = useUserStatus()
  await userstatusResponse.editUserStatusStore(userstatusData)
  const success: boolean = userstatusResponse.success ?? false
  const error_code: string = userstatusResponse.error_code ?? ''
  const message: string = userstatusResponse.message ?? ''
  return { success, error_code, message }
}

export async function getUserStatus(userstatusId: number) {
  const userstatusResponse = useUserStatus()
  const userStatus: UserStatus =
    (await userstatusResponse.getUserStatusStore(userstatusId)) ?? defaultUserStatus
  const success: boolean = userstatusResponse.success ?? false
  const error_code: string = userstatusResponse.error_code ?? ''
  const message: string = userstatusResponse.message ?? ''
  return { success, error_code, message, userStatus }
}
export async function getUserStatusesList(searchFilter: UserStatusSearchFilter) {
  const userstatusResponse = useUserStatus()
  await userstatusResponse.getUserStatusesStore(searchFilter)
  const success: boolean = userstatusResponse.success ?? false
  const error_code: string = userstatusResponse.error_code ?? ''
  const message: string = userstatusResponse.message ?? ''
  const userstatuses: UserStatus[] = userstatusResponse.userstatuses
  const pagination: Pagination = userstatusResponse.pagination
  return { success, error_code, message, userstatuses, pagination }
}
