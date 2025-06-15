import { checkRequiredPermissions } from '@/composable/checkPermission'
import { useAuth } from './stores/User/authStore'
import type { Router } from 'vue-router'
import { checkRoles } from './composable/checkRoles'

export function setupRouteGuard(router: Router) {
  router.beforeEach((to, from, next) => {
    const userAuth = useAuth()

    if (!to.meta.requiresAuth) {
      return next()
    }

    if (!userAuth.isLoggedIn && to.name !== 'login') {
      return next({ name: 'login' })
    }

    const loggedUser = userAuth.getUser()
    const userRoles = loggedUser?.roles ?? []
    const userPermissions: string[] = []

    userRoles.forEach((userRole) => {
      if (userRole.permissions) {
        userRole.permissions.forEach((permission) => {
          userPermissions.push(permission.name)
        })
      }
    })

    const requiredPermissions: string[] = (to.meta.permissions as string[]) || []
    const requiredRoles: string[] = (to.meta.roles as string[]) || []

    const hasPermission =
      requiredPermissions.length === 0 ||
      userPermissions.some((p) => checkRequiredPermissions(p, requiredPermissions))

    const hasRole =
      requiredRoles.length === 0 || userRoles.some((role) => checkRoles(role.name, requiredRoles))

    if (!hasPermission || !hasRole) {
      return next({ name: 'no-permission' })
    }

    next()
  })
}
