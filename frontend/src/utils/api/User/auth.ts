import type { SignInRequest } from '@/models/User/user'
import type { CustomResponseSingle } from '@/utils/response'
import type { AxiosInstance } from 'axios'

export async function signIn(
  api: AxiosInstance,
  credentials: SignInRequest,
): Promise<{ response: CustomResponseSingle }> {
  const { data: response } = await api.post('auth/login', credentials)
  return { response }
}

export async function signUp(
  api: AxiosInstance,
  credentials: SignInRequest,
): Promise<{ response: CustomResponseSingle }> {
  const { data: response } = await api.post('auth/register', credentials)
  return { response }
}
