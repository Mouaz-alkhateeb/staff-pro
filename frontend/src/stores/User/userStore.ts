/* eslint-disable no-var */
/* eslint-disable @typescript-eslint/no-explicit-any */
import { useApi } from '@/composable/useApi'
import type { ChangeUserStatus, CreateUpdateUser, User, UserSearchFilter } from '@/models/User/user'
import {
  addUserApi,
  changeUserStatusApi,
  deleteUserApi,
  editUserApi,
  getUserApi,
  getUsersApi,
} from '@/utils/api/User/user'
import { defaultPagination, type Pagination } from '@/utils/response'
import { acceptHMRUpdate, defineStore } from 'pinia'
import { ref } from 'vue'

export const useUser = defineStore('user', () => {
  const api = useApi()
  const users = ref<User[]>([])
  const pagination = ref<Pagination>(defaultPagination)
  const success = ref<boolean>()
  const error_code = ref<string>()
  const message = ref<string>()

  async function deleteUserStore(userId: number) {
    try {
      const response = await deleteUserApi(api, userId)
      users.value.splice(
        users.value.findIndex((user: User) => user.id === userId),
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
  async function getUserStore(userId: number) {
    try {
      const response = await getUserApi(api, userId)
      var returnedUser: User
      returnedUser = response.response.data
      success.value = response.response.success
      error_code.value = response.response.error_code
      message.value = response.response.message

      return returnedUser
    } catch (error: any) {
      success.value = error?.response.data.success
      error_code.value = error?.response.data.error_code
      message.value = error?.response.data.message
    }
  }
  async function addUserStore(user: CreateUpdateUser) {
    try {
      const response = await addUserApi(api, user)
      var returnedUser: User
      returnedUser = response.response.data
      users.value.push(returnedUser)
      success.value = response.response.success
      error_code.value = response.response.error_code
      message.value = response.response.message

      return returnedUser
    } catch (error: any) {
      success.value = error?.response.data.success
      error_code.value = error?.response.data.error_code
      message.value = error?.response.data.message
    }
  }
  async function editUserStore(user: CreateUpdateUser) {
    try {
      const response = await editUserApi(api, user)
      var returnedUser: User
      returnedUser = response.response.data
      users.value.splice(
        users.value.findIndex((userElement) => (userElement.id = user.id)),
        1,
      )
      success.value = response.response.success
      error_code.value = response.response.error_code
      message.value = response.response.message

      users.value.push(returnedUser)
    } catch (error: any) {
      success.value = error?.response.data.success
      error_code.value = error?.response.data.error_code
      message.value = error?.response.data.message
    }
  }
  async function changeUserStatusStore(user: ChangeUserStatus) {
    try {
      const response = await changeUserStatusApi(api, user)
      var returnedUser: User
      returnedUser = response.response.data
      users.value.splice(
        users.value.findIndex((userElement) => (userElement.id = user.id)),
        1,
      )
      success.value = response.response.success
      error_code.value = response.response.error_code
      message.value = response.response.message

      users.value.push(returnedUser)
    } catch (error: any) {
      success.value = error?.response.data.success
      error_code.value = error?.response.data.error_code
      message.value = error?.response.data.message
    }
  }
  async function getUsersStore(searchFilter: UserSearchFilter) {
    try {
      const returnedResponse = await getUsersApi(api, searchFilter)
      users.value = returnedResponse.response.data
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

  return {
    success,
    error_code,
    message,
    users,
    pagination,
    deleteUserStore,
    addUserStore,
    editUserStore,
    getUserStore,
    getUsersStore,
    changeUserStatusStore,
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
  import.meta.hot.accept(acceptHMRUpdate(useUser, import.meta.hot))
}
