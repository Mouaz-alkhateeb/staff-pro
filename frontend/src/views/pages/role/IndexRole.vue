
<route lang="json">
{
  "meta": {
    "requiresAuth": true,
    "permissions": [
      "role_list"
    ]
  }
}
</route>
<template>
  <section class="contact_area section_gap">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">{{ t('role.role') }}</h2>
      </div>
      <!-- جدول المدن -->
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead>
              <tr>
                <th>#</th>
                <th>{{ t('role.name') }}</th>
                <th>{{ t('role.display_name') }}</th>
                <th>{{ t('role.status') }}</th>
                 <th>{{ t('role.permissions') }}</th>
                <th>{{ t('role.users_count') }}</th>
                <th>{{ t('role.permissions_count') }}</th>
                <th>{{ t('role.created_by') }}</th>
                <th class="text-end">{{ t('role.actions') }}</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(role, index) in rolesList" :key="role.id">
                <td>{{ index + 1 + (paginationVar.page - 1) * paginationVar.per_page }}</td>
                <td>{{ role.name }}</td>
                <td>{{ role.display_name }}</td>
                <td>
                  <span :class="['badge', role.status === 1 ? 'bg-success' : 'bg-secondary']">
                    {{ role.status === 1 ? 'نشط' : 'غير نشط' }}
                  </span>
                </td>
                <td>
                  <div
                    class="d-flex flex-wrap gap-1"
                    style="max-width: 300px; overflow-y: auto; max-height: 100px;"
                  >
                    <span
                      v-for="per in role.permissions"
                      :key="per.id"
                      class="badge bg-secondary text-wrap"
                    >
                      {{ per.name }}
                    </span>
                  </div>
                </td>
                <td>{{ role.users_count ?? 0 }}</td>
                <td>{{ role.permissions?.length ?? 0 }}</td>
                <td>
                  {{ role.created_by?.first_name }} {{ role.created_by?.last_name }}
                </td>
                <td class="text-end">
                  <button class="btn btn-outline-warning btn-sm me-1" @click="onEdit(role.id)">
                    {{ t('role.update') }}
                  </button>
                </td>
              </tr>
              <tr v-if="rolesList.length === 0">
                <td colspan="8" class="text-center text-muted">لا توجد بيانات</td>
              </tr>
            </tbody>

        </table>
      </div>

      <!-- Pagination -->
      <nav v-if="paginationVar.max_page > 1" class="mt-3">
        <ul class="pagination justify-content-center">
          <li class="page-item" :class="{ disabled: paginationVar.page === 1 }">
            <a class="page-link" href="#" @click.prevent="changePage(paginationVar.page - 1)">السابق</a>
          </li>
          <li class="page-item" v-for="page in paginationVar.max_page" :key="page" :class="{ active: page === paginationVar.page }">
            <a class="page-link" href="#" @click.prevent="changePage(page)">{{ page }}</a>
          </li>
          <li class="page-item" :class="{ disabled: paginationVar.page === paginationVar.max_page }">
            <a class="page-link" href="#" @click.prevent="changePage(paginationVar.page + 1)">التالي</a>
          </li>
        </ul>
      </nav>

    </div>
  </section>


</template>

<script setup lang="ts">
import { defaultPagination } from '@/utils/response'
import { useHead } from '@vueuse/head'
import { computed, onMounted, ref } from 'vue'
import { useI18n } from 'vue-i18n'
import { useRouter } from 'vue-router'
import {  getRolesList } from '@/services/Role/roleService'
import type { Role } from '@/utils/consts/rolesPermissions'



const { t } = useI18n()
const pageTitle = computed(() => t('role.role'))
const rolesList = ref<Array<Role>>([])
const paginationVar = ref(defaultPagination)
const keyIncrement = ref(0)
const default_per_page = ref(1)
const router = useRouter()

useHead({ title: pageTitle })

const fetchRoles = async () => {
  const { roles, pagination } = await getRolesList()
  rolesList.value = roles
  paginationVar.value = pagination
  keyIncrement.value++
  default_per_page.value = pagination.per_page
}

const changePage = (page: number) => {
  if (page < 1 || page > paginationVar.value.max_page) return
  fetchRoles()
}


onMounted(() => {
  fetchRoles()

})
const onEdit = (id: number | undefined) => router.push({ path: `/role/${id}/edit` })

</script>

