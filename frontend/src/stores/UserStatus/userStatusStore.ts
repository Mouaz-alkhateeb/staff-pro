/* eslint-disable prefer-const */
/* eslint-disable @typescript-eslint/no-explicit-any */
import { useApi } from '@/composable/useApi'
import type { UserStatus, UserStatusSearchFilter } from '@/models/UserStatus/userStatus'
import {
  addUserStatusApi,
  deleteUserStatusApi,
  editUserStatusApi,
  getUserStatusApi,
  getUserStatusesApi,
} from '@/utils/api/UserStatus/userstatuses'
import { defaultPagination, type Pagination } from '@/utils/response'
import { acceptHMRUpdate, defineStore } from 'pinia'
import { ref } from 'vue'

export const useUserStatus = defineStore('userstatus', () => {
  const api = useApi()
  const userstatuses = ref<UserStatus[]>([])
  const pagination = ref<Pagination>(defaultPagination)
  const loading = ref(false)
  const success = ref<boolean>()
  const error_code = ref<string>()
  const message = ref<string>()

  async function deleteUserStatusStore(userstatusId: number) {
    if (loading.value) return

    loading.value = true

    try {
      const response = await deleteUserStatusApi(api, userstatusId)
      userstatuses.value.splice(
        userstatuses.value.findIndex((userstatus: UserStatus) => userstatus.id === userstatusId),
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
  async function getUserStatusStore(userstatusId: number) {
    try {
      const response = await getUserStatusApi(api, userstatusId)
      let returnedUserStatus: UserStatus
      returnedUserStatus = response.response.data
      success.value = response.response.success
      error_code.value = response.response.error_code
      message.value = response.response.message

      return returnedUserStatus
    } catch (error: any) {
      success.value = error?.response.data.success
      error_code.value = error?.response.data.error_code
      message.value = error?.response.data.message
    } finally {
      loading.value = false
    }
  }
  async function addUserStatusStore(userstatus: UserStatus) {
    try {
      const response = await addUserStatusApi(api, userstatus)
      let returnedUserStatus: UserStatus
      returnedUserStatus = response.response.data
      userstatuses.value.push(returnedUserStatus)
      success.value = response.response.success
      error_code.value = response.response.error_code
      message.value = response.response.message

      return returnedUserStatus
    } catch (error: any) {
      success.value = error?.response.data.success
      error_code.value = error?.response.data.error_code
      message.value = error?.response.data.message
    } finally {
      loading.value = false
    }
  }
  async function editUserStatusStore(userstatus: UserStatus) {
    try {
      const response = await editUserStatusApi(api, userstatus)
      let returnedUserStatus: UserStatus
      returnedUserStatus = response.response.data
      userstatuses.value.splice(
        userstatuses.value.findIndex((userstatusElement) => (userstatusElement.id = userstatus.id)),
        1,
      )
      success.value = response.response.success
      error_code.value = response.response.error_code
      message.value = response.response.message

      userstatuses.value.push(returnedUserStatus)
    } catch (error: any) {
      success.value = error?.response.data.success
      error_code.value = error?.response.data.error_code
      message.value = error?.response.data.message
    } finally {
      loading.value = false
    }
  }
  async function getUserStatusesStore(searchFilter: UserStatusSearchFilter) {
    if (loading.value) return

    loading.value = true

    try {
      const returnedResponse = await getUserStatusesApi(api, searchFilter)
      userstatuses.value = returnedResponse.response.data
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
    userstatuses,
    pagination,
    loading,
    deleteUserStatusStore,
    addUserStatusStore,
    editUserStatusStore,
    getUserStatusStore,
    getUserStatusesStore,
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
  import.meta.hot.accept(acceptHMRUpdate(useUserStatus, import.meta.hot))
}
