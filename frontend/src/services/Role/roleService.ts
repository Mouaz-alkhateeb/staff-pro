import { useRole } from '@/stores/Role/roleStore'
import { defaultRole, type Role } from '@/utils/consts/rolesPermissions'
import type { Pagination } from '@/utils/response'

export async function getRolesList() {
  const response = useRole()
  await response.getRolesStore()
  const roles: Role[] = response.roles
  const pagination: Pagination = response.pagination
  const success: boolean = response.success ?? false
  const error_code: string = response.error_code ?? ''
  const message: string = response.message ?? ''
  return { success, error_code, message, roles, pagination }
}
export async function getRole(roleId: number) {
  const response = useRole()
  const role: Role = (await response.getRoleStore(roleId)) ?? defaultRole
  const success: boolean = response.success ?? false
  const error_code: string = response.error_code ?? ''
  const message: string = response.message ?? ''
  return { success, error_code, message, role }
}
export async function updateRolePermissions(roleId: number, permissions: string[]) {
  const response = useRole()
  const role: Role = (await response.updateRolePermissionsStore(roleId, permissions)) ?? defaultRole
  const success: boolean = response.success ?? false
  const error_code: string = response.error_code ?? ''
  const message: string = response.message ?? ''
  return { success, error_code, message, role }
}
