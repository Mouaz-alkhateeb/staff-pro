import type { PermissionGroupSearchFilter } from '@/models/PermissionGroup/permissionGroup'
import type { CustomResponseCollection } from '@/utils/response'
import type { AxiosInstance } from 'axios'

export async function getPermissionGroupsListApi(
  api: AxiosInstance,
  filter: PermissionGroupSearchFilter,
): Promise<{ response: CustomResponseCollection }> {
  const { data: response } = await api.get('permissionGroup/getPermissionGroupsList', {
    params: filter,
  })
  return { response }
}
