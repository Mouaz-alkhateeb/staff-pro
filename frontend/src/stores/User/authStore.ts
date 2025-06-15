import { useApi } from '@/composable/useApi'
import type { SignInRequest, SignUpRequest, User } from '@/models/User/user'
import { signIn, signUp } from '@/utils/api/User/auth'
import { useStorage } from '@vueuse/core'
import { defineStore } from 'pinia'
import { computed, ref } from 'vue'

export const useAuth = defineStore('userAuth', () => {
  const api = useApi()
  const token = useStorage('token', '')
  const user = ref<User>()
  const loggedUser = useStorage('loggedUser', '')
  const userFullName = useStorage('userFullName', '')
  const success = ref<boolean>()
  const error_code = ref<string>()
  const message = ref<string>()
  const isLoggedIn = computed(() => token.value !== undefined && token.value !== '')

  function setUser(newUser: User) {
    user.value = newUser
    loggedUser.value = JSON.stringify(newUser)
    userFullName.value = newUser?.first_name + ' ' + newUser?.last_name
  }

  function getUser(): User {
    return JSON.parse(loggedUser.value) as User
  }
  function setToken(newToken: string) {
    token.value = newToken
  }

  async function logoutUser() {
    token.value = undefined
    user.value = undefined
    loggedUser.value = ''
    userFullName.value = undefined
  }
  function getUserFulLName(): string {
    return userFullName.value
  }

  async function signInAuthStore(credentials: SignInRequest) {
    try {
      const response = await signIn(api, credentials)

      token.value = response?.response?.data?.token as string
      user.value = response?.response?.data as User

      setToken(token.value)
      setUser(user.value)

      return response.response.data
    } catch (e) {
      throw e
    } finally {
    }
  }

  async function signUpAuthStore(credentials: SignUpRequest) {
    try {
      const response = await signUp(api, credentials)

      token.value = response?.response?.data?.token as string
      user.value = response?.response?.data as User

      setToken(token.value)
      setUser(user.value)

      return response.response.data
    } catch (e) {
      throw e
    } finally {
    }
  }

  return {
    user,
    loggedUser,
    token,
    isLoggedIn,
    success,
    error_code,
    message,
    setUser,
    getUser,
    setToken,
    logoutUser,
    getUserFulLName,
    signInAuthStore,
    signUpAuthStore,
  } as const
})
