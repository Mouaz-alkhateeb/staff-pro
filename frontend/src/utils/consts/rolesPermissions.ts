import { type User } from './../../models/User/user'

export interface Role {
  id: number
  name: string
  status: number
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
  status: 1,
  permissions: [],
  created_at: '',
  created_by: {} as User,
  description: undefined,
  users_count: undefined,
}

export enum Permissions {
  CITY_ACCESS = 'city_access',
  CITY_SHOW = 'city_show',
  CITY_CREATE = 'city_create',
  CITY_DELETE = 'city_delete',
  CITY_EDIT = 'city_edit',
  CITY_LIST = 'city_list',

  DEPARTMENT_ACCESS = 'department_access',
  DEPARTMENT_SHOW = 'department_show',
  DEPARTMENT_CREATE = 'department_create',
  DEPARTMENT_DELETE = 'department_delete',
  DEPARTMENT_EDIT = 'department_edit',
  DEPARTMENT_LIST = 'department_list',

  NATIONALITY_ACCESS = 'nationality_access',
  NATIONALITY_SHOW = 'nationality_show',
  NATIONALITY_CREATE = 'nationality_create',
  NATIONALITY_DELETE = 'nationality_delete',
  NATIONALITY_EDIT = 'nationality_edit',
  NATIONALITY_LIST = 'nationality_list',

  PERMISSION_ACCESS = 'permission_access',
  PERMISSION_SHOW = 'permission_show',
  PERMISSION_CREATE = 'permission_create',
  PERMISSION_DELETE = 'permission_delete',
  PERMISSION_EDIT = 'permission_edit',
  PERMISSION_LIST = 'permission_list',

  ROLE_ACCESS = 'role_access',
  ROLE_SHOW = 'role_show',
  ROLE_CREATE = 'role_create',
  ROLE_DELETE = 'role_delete',
  ROLE_EDIT = 'role_edit',
  ROLE_LIST = 'role_list',

  ROLE_HAS_PERMISSION_ACCESS = 'role_has_permission_access',
  ROLE_HAS_PERMISSION_SHOW = 'role_has_permission_show',
  ROLE_HAS_PERMISSION_CREATE = 'role_has_permission_create',
  ROLE_HAS_PERMISSION_DELETE = 'role_has_permission_delete',
  ROLE_HAS_PERMISSION_EDIT = 'role_has_permission_edit',
  ROLE_HAS_PERMISSION_LIST = 'role_has_permission_list',

  ROOM_ACCESS = 'room_access',
  ROOM_SHOW = 'room_show',
  ROOM_CREATE = 'room_create',
  ROOM_DELETE = 'room_delete',
  ROOM_EDIT = 'room_edit',
  ROOM_LIST = 'room_list',

  USER_ACCESS = 'user_access',
  USER_SHOW = 'user_show',
  USER_CREATE = 'user_create',
  USER_DELETE = 'user_delete',
  USER_EDIT = 'user_edit',
  USER_LIST = 'user_list',
  USER_STATUS_ACCESS = 'user_status_access',
  USER_STATUS_SHOW = 'user_status_show',
  USER_STATUS_CREATE = 'user_status_create',
  USER_STATUS_DELETE = 'user_status_delete',
  USER_STATUS_EDIT = 'user_status_edit',
  USER_STATUS_LIST = 'user_status_list',
}
