/* eslint-disable @typescript-eslint/no-wrapper-object-types */
import type { CustomResponseCollection, CustomResponseSingle } from '@/utils/response'
import type { AxiosInstance } from 'axios'

export async function getRolesApi(
  api: AxiosInstance,
): Promise<{ response: CustomResponseCollection }> {
  const { data: response } = await api.get('role')
  return { response }
}
export async function getRoleApi(
  api: AxiosInstance,
  roleId: number,
): Promise<{ response: CustomResponseSingle }> {
  const { data: response } = await api.get(`role/${roleId}`)
  return { response }
}
export async function updateRolePermissionsApi(
  api: AxiosInstance,
  roleId: number,
  permissions: String[],
): Promise<{ response: CustomResponseSingle }> {
  const { data: response } = await api.put(`role/${roleId}/updateRolePermissions`, {
    permissions: permissions,
  })
  return { response }
}
