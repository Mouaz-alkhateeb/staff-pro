




<template>
  <section class="contact_area section_gap">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">{{ t('departments') }}</h2>
        <router-link :to="{ name: 'add_department' }" class="btn btn-success btn-sm">
          <i class="bi bi-plus-circle"></i> {{ t('department.add') }}
        </router-link>
      </div>

      <form @submit.prevent="searchDepartments" class="row g-3 align-items-end mb-3">
        <div class="col-md-4">
          <label class="form-label">{{ t('department.name') }}</label>
          <input type="text" class="form-control" v-model="searchFilter.name"  :placeholder="t('department.name_placeholder')">
        </div>
        <div class="col-md-3">
          <label class="form-label">{{ t('department.status') }}</label>
          <select class="form-select" v-model="searchFilter.status">
            <option :value="undefined">{{ t('department.all') }}</option>
            <option :value="1">{{ t('department.active') }}</option>
            <option :value="0">{{ t('department.inactive') }}</option>
          </select>
        </div>
        <div class="col-md-3">
          <label class="form-label">{{ t('department.number_in_page') }}</label>
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
          <button type="button" class="btn btn-danger" @click="resetFilter">{{ t('department.form.reset') }}</button>
        </div>
      </form>

      <!-- جدول المدن -->
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead>
            <tr>
              <th>#</th>
              <th>{{ t('department.name') }}</th>
              <th>{{ t('department.status') }}</th>
              <th class="text-end">{{t('department.actions')}}</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(department, index) in departmentsList" :key="department.id">
              <td>{{ index + 1 + (paginationVar.page - 1) * paginationVar.per_page }}</td>
              <td>{{ department.name }}</td>
              <td>
                <span :class="['badge', department.status === 1 ? 'bg-success' : 'bg-secondary']">
                  {{ department.status === 1 ? 'نشط' : 'غير نشط' }}
                </span>
              </td>
              <td class="text-end">
                <button class="btn btn-outline-warning btn-sm me-1" @click="onEdit(department.id)">{{ t('department.update') }}</button>
                <button class="btn btn-outline-danger btn-sm" @click="onDelete(department.id)">{{ t('department.delete') }}</button>
              </td>
            </tr>
            <tr v-if="departmentsList.length === 0">
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
<div class="modal fade" id="deleteDepartmentModal" tabindex="-1" aria-labelledby="deleteDepartmentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteDepartmentModalLabel">تأكيد الحذف</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
      </div>
      <div class="modal-body">
        هل أنت متأكد أنك تريد حذف المدينة "<strong>{{ departmentToDelete?.name }}</strong>"؟
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
import { defaultDepartmentSearchFilter, type Department } from '@/models/Department/department'
import { deleteDepartment, getDepartmentsList } from '@/services/Department/departmentService'
import { defaultPagination } from '@/utils/response'
import { useHead } from '@vueuse/head'
import { computed, onMounted, ref, watch } from 'vue'
import { useI18n } from 'vue-i18n'
import { useRouter } from 'vue-router'
import { Modal } from 'bootstrap'


const { t } = useI18n()
const pageTitle = computed(() => t('departments'))
const searchFilter = ref(defaultDepartmentSearchFilter)
const departmentsList = ref<Array<Department>>([])

const paginationVar = ref(defaultPagination)
const keyIncrement = ref(0)
const default_per_page = ref(1)
const router = useRouter()
const departmentToDelete = ref<Department | null>(null)
let modalInstance: Modal


useHead({ title: pageTitle })


const fetchDepartments = async () => {
  const { departments, pagination } = await getDepartmentsList(searchFilter.value)
  departmentsList.value = departments
  paginationVar.value = pagination
  keyIncrement.value++
  default_per_page.value = pagination.per_page
}



const changePage = (page: number) => {
  if (page < 1 || page > paginationVar.value.max_page) return
  searchFilter.value.page = page
  fetchDepartments()
}

const searchDepartments = () => {
  searchFilter.value.page = 1
  fetchDepartments ()
}

const resetFilter = () => {
  // searchFilter.value = defaultDepartmentSearchFilter
  searchFilter.value.name = ''
   searchFilter.value.status = undefined
  fetchDepartments()
}



const changePerPage = (perPage: number) => {
  searchFilter.value.per_page = perPage
  searchFilter.value.page = 1
  fetchDepartments()
}
onMounted(() => {
    fetchDepartments()
    const modalElement = document.getElementById('deleteDepartmentModal')
    if (modalElement) {
      modalInstance = new Modal(modalElement)
    }



})


const onEdit = (id: number | undefined) => router.push({ path: `/department/${id}/edit` })
const onDelete = (id: number | undefined) => {
  if (!id) return
  const department = departmentsList.value.find((c) => c.id === id)
  if (department) {
    departmentToDelete.value = department
    modalInstance?.show()
  }
}
const confirmDelete = async () => {
  if (!departmentToDelete.value || typeof departmentToDelete.value.id !== 'number') return

  const id = departmentToDelete.value.id

  try {
    const { success } = await deleteDepartment(id)

    if (success) {
      const index = departmentsList.value.findIndex((department) => department.id === id)
      if (index !== -1) {
        departmentsList.value.splice(index, 1)
      }
    }
  } catch (error) {
    console.error('خطأ أثناء الحذف:', error)
  } finally {
    modalInstance?.hide()
    departmentToDelete.value = null
  }
}

watch(
  () => [searchFilter.value.name, searchFilter.value.status],
  () => {
    searchFilter.value.page = 1
    fetchDepartments ()
  }
)


</script>

