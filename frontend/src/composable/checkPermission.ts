/* eslint-disable @typescript-eslint/no-unused-vars */
/* eslint-disable @typescript-eslint/no-explicit-any */
import { useAuth } from '@/stores/User/authStore'
import type { Role } from '@/utils/consts/rolesPermissions'

export function checkPermission(permission: string): boolean {
  const userAuth = useAuth()

  if (!userAuth.isLoggedIn || !userAuth.loggedUser) return false

  try {
    const loggedUser = JSON.parse(userAuth.loggedUser)
    const userPermissions: string[] = []

    loggedUser.roles?.forEach((role: Role) => {
      role.permissions?.forEach((permissionObj) => {
        userPermissions.push(permissionObj.name)
      })
    })

    return userPermissions.includes(permission)
  } catch (e) {
    return false
  }
}

export function checkRequiredPermissions(
  userPermission: string,
  allowedPermissions: string[],
): boolean {
  if (allowedPermissions === undefined || allowedPermissions.length === 0) {
    return false
  }

  return checkStringExistsInArray(userPermission, allowedPermissions)
}
function checkStringExistsInArray(str: string, arr: string[]): boolean {
  return arr.includes(str)
}
function getAuthUserPermissions(): string[] {
  const userAuth = useAuth()

  const userPermissions: string[] = []
  try {
    const loggedUser = JSON.parse(userAuth.loggedUser)
    loggedUser.roles.forEach((role: Role) => {
      role.permissions.forEach((permission) => {
        userPermissions.push(permission.name)
      })
    })
  } catch (error: any) {}
  return userPermissions
}
