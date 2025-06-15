<template>
  <section class="contact_area section_gap">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">{{ t('userstatus.userstatus') }}</h2>
        <router-link :to="{ name: 'add_userstatus' }" class="btn btn-success btn-sm">
          <i class="bi bi-plus-circle"></i> {{ t('userstatus.add') }}
        </router-link>
      </div>

      <form @submit.prevent="searchUserStatus" class="row g-3 align-items-end mb-3">
        <div class="col-md-4">
          <label class="form-label">{{ t('userstatus.name') }}</label>
          <input type="text" class="form-control" v-model="searchFilter.name"  :placeholder="t('userstatus.name_placeholder')">
        </div>

        <div class="col-md-4">
          <label class="form-label">{{ t('userstatus.number_in_page') }}</label>
         <select
            class="form-select"
            v-model.number="searchFilter.per_page"
            @change="changePerPage(searchFilter.per_page ?? 10)"
          >
            <option :value="5">5</option>
            <option :value="10">10</option>
            <option :value="20">20</option>
            <option :value="50">50</option>
          </select>
        </div>
        <div class="col-md-2 d-flex gap-2">
          <button type="button" class="btn btn-danger" @click="resetFilter">{{ t('userstatus.form.reset') }}</button>
        </div>
      </form>

      <!-- جدول المدن -->
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead>
            <tr>
              <th>#</th>
              <th>{{ t('userstatus.name') }}</th>
              <th class="text-end">{{t('userstatus.actions')}}</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(userstatus, index) in userstatusList" :key="userstatus.id">
              <td>{{ index + 1 + (paginationVar.page - 1) * paginationVar.per_page }}</td>
              <td>{{ userstatus.name }}</td>

              <td class="text-end">
                <button class="btn btn-outline-warning btn-sm me-1" @click="onEdit(userstatus.id)">{{ t('userstatus.update') }}</button>
                <button class="btn btn-outline-danger btn-sm" @click="onDelete(userstatus.id)">{{ t('userstatus.delete') }}</button>
              </td>
            </tr>
            <tr v-if="userstatusList.length === 0">
              <td colspan="4" class="text-center text-muted">لا توجد بيانات</td>
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
  <!-- Modal تأكيد الحذف -->
<div class="modal fade" id="deleteUserStatusModal" tabindex="-1" aria-labelledby="deleteUserStatusModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteUserStatusModalLabel">تأكيد الحذف</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
      </div>
      <div class="modal-body">
        هل أنت متأكد أنك تريد حذف المدينة "<strong>{{ userStatusToDelete?.name }}</strong>"؟
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
        <button type="button" class="btn btn-danger" @click="confirmDelete">حذف</button>
      </div>
    </div>
  </div>
</div>

</template>

<script setup lang="ts">
import { defaultPagination } from '@/utils/response'
import { useHead } from '@vueuse/head'
import { computed, onMounted, ref, watch } from 'vue'
import { useI18n } from 'vue-i18n'
import { useRouter } from 'vue-router'
import { Modal } from 'bootstrap'
import { defaultUserStatusSearchFilter, type UserStatus } from '@/models/UserStatus/userStatus'
import { deleteUserStatus, getUserStatusesList } from '@/services/UserStatus/nationalityService'


const { t } = useI18n()
const pageTitle = computed(() => t('userstatus.userstatus'))
const searchFilter = ref(defaultUserStatusSearchFilter)
const userstatusList = ref<Array<UserStatus>>([])
const paginationVar = ref(defaultPagination)
const keyIncrement = ref(0)
const default_per_page = ref(1)
const router = useRouter()
const userStatusToDelete = ref<UserStatus | null>(null)
let modalInstance: Modal


useHead({ title: pageTitle })

const fetchUserStatus = async () => {
  const { userstatuses, pagination } = await getUserStatusesList(searchFilter.value)
  userstatusList.value = userstatuses
  paginationVar.value = pagination
  keyIncrement.value++
  default_per_page.value = pagination.per_page
}

const changePage = (page: number) => {
  if (page < 1 || page > paginationVar.value.max_page) return
  searchFilter.value.page = page
  fetchUserStatus()
}

const searchUserStatus = () => {
  searchFilter.value.page = 1
  fetchUserStatus()
}

const resetFilter = () => {
  searchFilter.value.name = ''
  fetchUserStatus()
}

const changePerPage = (perPage: number) => {
  searchFilter.value.per_page = perPage
  searchFilter.value.page = 1
  fetchUserStatus()
}
onMounted(() => {
  fetchUserStatus()
  const modalElement = document.getElementById('deleteUserStatusModal')
  if (modalElement) {
    modalInstance = new Modal(modalElement)
  }
})


const onEdit = (id: number | undefined) => router.push({ path: `/userstatus/${id}/edit` })
const onDelete = (id: number | undefined) => {
  if (!id) return
  const userstatus = userstatusList.value.find((c) => c.id === id)
  if (userstatus) {
    userStatusToDelete.value = userstatus
    modalInstance?.show()
  }
}
const confirmDelete = async () => {
  if (!userStatusToDelete.value || typeof userStatusToDelete.value.id !== 'number') return

  const id = userStatusToDelete.value.id

  try {
    const { success } = await deleteUserStatus(id)

    if (success) {
      const index = userstatusList.value.findIndex((userStatus) => userStatus.id === id)
      if (index !== -1) {
        userstatusList.value.splice(index, 1)
      }
    }
  } catch (error) {
    console.error('خطأ أثناء الحذف:', error)
  } finally {
    modalInstance?.hide()
    userStatusToDelete.value = null
  }
}

watch(
  () => [searchFilter.value.name],
  () => {
    searchFilter.value.page = 1
    fetchUserStatus()
  }
)


</script>

