import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/pages/HomePage.vue'
import LoginPage from '../views/pages/auth/loginPage.vue'
import AddCity from '@/views/pages/city/AddCity.vue'
import RegisterPage from '@/views/pages/auth/registerPage.vue'
import IndexCity from '@/views/pages/city/IndexCity.vue'
import EditCity from '@/views/pages/city/[id]/EditCity.vue'
import IndexDepartment from '@/views/pages/department/IndexDepartment.vue'
import AddDepartment from '@/views/pages/department/AddDepartment.vue'
import EditDepartment from '@/views/pages/department/[id]/EditDepartment.vue'
import IndexRoom from '@/views/pages/room/IndexRoom.vue'
import AddRoom from '@/views/pages/room/AddRoom.vue'
import EditRoom from '@/views/pages/room/[id]/EditRoom.vue'
import AddNationality from '@/views/pages/nationality/AddNationality.vue'
import IndexNationality from '@/views/pages/nationality/IndexNationality.vue'
import EditNationality from '@/views/pages/nationality/[id]/EditNationality.vue'
import IndexUserStatus from '@/views/pages/userstatus/IndexUserStatus.vue'
import AddUserStatus from '@/views/pages/userstatus/AddUserStatus.vue'
import EditUserStatus from '@/views/pages/userstatus/[id]/EditUserStatus.vue'
import IndexRole from '@/views/pages/role/IndexRole.vue'
import EditRole from '@/views/pages/role/[id]/EditRole.vue'
import PermissionPage from '@/views/pages/auth/PermissionPage.vue'
import { setupRouteGuard } from '@/session-check'
import IndexUser from '@/views/pages/user/IndexUser.vue'
import EditUser from '@/views/pages/user/[id]/EditUser.vue'
import AddUser from '@/views/pages/user/AddUser.vue'
import DetailsUser from '@/views/pages/user/[id]/DetailsUser.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home,
    },
    {
      path: '/login',
      name: 'login',
      component: LoginPage,
    },
    {
      path: '/register',
      name: 'register',
      component: RegisterPage,
    },
    {
      path: '/city',
      name: 'city',
      component: IndexCity,
    },
    {
      path: '/city/add',
      name: 'add_city',
      component: AddCity,
    },
    {
      path: '/city/:id/edit',
      name: 'edit_city',
      component: EditCity,
    },

    {
      path: '/department',
      name: 'department',
      component: IndexDepartment,
    },
    {
      path: '/department/add',
      name: 'add_department',
      component: AddDepartment,
    },
    {
      path: '/department/:id/edit',
      name: 'edit_department',
      component: EditDepartment,
    },

    {
      path: '/room',
      name: 'room',
      component: IndexRoom,
    },
    {
      path: '/room/add',
      name: 'add_room',
      component: AddRoom,
    },
    {
      path: '/room/:id/edit',
      name: 'edit_room',
      component: EditRoom,
    },

    {
      path: '/nationality',
      name: 'nationality',
      component: IndexNationality,
    },
    {
      path: '/nationality/add',
      name: 'add_nationality',
      component: AddNationality,
    },
    {
      path: '/nationality/:id/edit',
      name: 'edit_nationality',
      component: EditNationality,
    },

    {
      path: '/userstatus',
      name: 'userstatus',
      component: IndexUserStatus,
    },
    {
      path: '/userstatus/add',
      name: 'add_userstatus',
      component: AddUserStatus,
    },
    {
      path: '/userstatus/:id/edit',
      name: 'edit_userstatus',
      component: EditUserStatus,
    },

    {
      path: '/role',
      name: 'role',
      component: IndexRole,
      meta: {
        requiresAuth: true,
        roles: ['Admin'],
      },
    },
    {
      path: '/role/:id/edit',
      name: 'edit_role',
      component: EditRole,
    },
    {
      path: '/user',
      name: 'user',
      component: IndexUser,
    },
    {
      path: '/user/add',
      name: 'add_user',
      component: AddUser,
    },
    {
      path: '/user/:id/edit',
      name: 'edit_user',
      component: EditUser,
    },
    {
      path: '/user/:id/details',
      name: 'details_user',
      component: DetailsUser,
    },
    {
      path: '/no-permission',
      name: 'no-permission',
      component: PermissionPage,
    },
  ],
})
setupRouteGuard(router)
export default router
