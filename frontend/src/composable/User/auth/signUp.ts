import type { SignUpRequest } from '@/models/User/user'
import { useAuth } from '@/stores/User/authStore'

export async function signUp(request: SignUpRequest) {
  const auth = useAuth()
  return await auth.signUpAuthStore(request)
}
