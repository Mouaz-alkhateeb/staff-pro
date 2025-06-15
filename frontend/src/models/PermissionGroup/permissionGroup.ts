import type { Permission } from '../Role/role'

export interface PermissionGroup {
  id: number
  name: string
  display_name: string
  permissions: Permission[]
}
export interface PermissionGroupHelper {
  id: number
  name: string
  display_name: string
  permissions: PermissionHelper[]
  checked: boolean
}
export interface PermissionHelper {
  id: number
  name: string
  display_name: string
  checked: boolean
}

export interface PermissionGroupSearchFilter {
  name?: string
  id?: number
  permission_name?: string
}
export const defaultPermissionGroup: PermissionGroup = {
  id: 0,
  name: '',
  display_name: '',
  permissions: [],
}

export const defaultPermissionGroupSearchFilter: PermissionGroupSearchFilter = {
  name: undefined,
  id: undefined,
  permission_name: undefined,
}
