import { useAuth } from '@/stores/User/authStore'
import axios, { type AxiosInstance } from 'axios'

let api: AxiosInstance

export function createApi() {
  axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*'
  api = axios.create({
    baseURL: import.meta.env.VITE_API_BASE_URL,
    withCredentials: false,
    headers: {
      'Content-Type': 'application/json',
      Accept: 'application/json',
      'Access-Control-Allow-Origin': '*',
    },
  })

  api.interceptors.request.use(
    (config) => {
      const userAuth = useAuth()

      if (userAuth.isLoggedIn && config.headers) {
        config.headers['Authorization'] = `Bearer ${userAuth.token}`
      }

      return config
    },
    (err) => {
      if (err.message == 'Network Error') {
        console.log('Network Error')
      }
      return Promise.reject(err)
    },
  )

  return api
}

export function useApi() {
  if (!api) {
    createApi()
  }
  return api
}
