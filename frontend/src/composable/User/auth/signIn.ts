import type { SignInRequest } from '@/models/User/user'
import { useAuth } from '@/stores/User/authStore'

export async function signIn(request: SignInRequest) {
  const auth = useAuth()
  return await auth.signInAuthStore(request)
}
