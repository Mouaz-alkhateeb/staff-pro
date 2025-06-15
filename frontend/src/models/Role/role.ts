import { defaultUser, type User } from '../User/user'

export interface Role {
  id: number
  name: string
  description?: string
  display_name: string
  users_count?: number
  created_by?: User
  created_at?: string
  permissions: Permission[]
}

export interface Permission {
  id: number
  name: string
  display_name: string
}

export const defaultRole: Role = {
  id: 0,
  display_name: '',
  name: '',
  permissions: [],
  created_at: '',
  created_by: defaultUser,
  description: undefined,
  users_count: undefined,
}
