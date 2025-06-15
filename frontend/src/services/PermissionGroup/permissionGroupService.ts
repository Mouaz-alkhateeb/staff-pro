import type {
  PermissionGroup,
  PermissionGroupSearchFilter,
} from '@/models/PermissionGroup/permissionGroup'
import { usePermissionGroup } from '@/stores/PermissionGroup/permissionGroupStore'

export async function getPermissionGroupsList(filter: PermissionGroupSearchFilter) {
  const response = usePermissionGroup()
  await response.getPermissionGroupsStore(filter)
  const permission_groups: PermissionGroup[] = response.permissionGroups
  const success: boolean = response.success ?? false
  const error_code: string = response.error_code ?? ''
  const message: string = response.message ?? ''
  return { success, error_code, message, permission_groups }
}
