<template>
  <section class="contact_area section_gap">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">{{ t('rooms') }}</h2>
        <router-link :to="{ name: 'add_room' }" class="btn btn-success btn-sm">
          <i class="bi bi-plus-circle"></i> {{ t('room.add') }}
        </router-link>
      </div>

      <form @submit.prevent="searchRooms" class="row g-3 align-items-end mb-3">
        <div class="col-md-2">
          <label class="form-label">{{ t('room.number') }}</label>
          <input type="text" class="form-control" v-model="searchFilter.number"  :placeholder="t('room.name_placeholder')">
        </div>
        <div class="col-md-2">
          <label class="form-label">{{ t('room.floor') }}</label>
          <input type="text" class="form-control" v-model="searchFilter.floor"  :placeholder="t('room.floor_placeholder')">
        </div>
        <div class="col-md-2">
          <label class="form-label">{{ t('room.department') }}</label>
          <select class="form-select" v-model="searchFilter.department_id">
            <option :value="undefined">{{ t('room.form.select') }}</option>
            <option
              v-for="department in departmentsList"
              :key="department.id"
              :value="department.id"
            >
              {{ department.name }}
            </option>
          </select>
        </div>
        <div class="col-md-2">
          <label class="form-label">{{ t('room.status') }}</label>
          <select class="form-select" v-model="searchFilter.status">
            <option :value="undefined">{{ t('room.all') }}</option>
            <option :value="1">{{ t('room.active') }}</option>
            <option :value="0">{{ t('room.inactive') }}</option>
          </select>
        </div>

        <div class="col-md-2">
          <label class="form-label">{{ t('room.number_in_page') }}</label>
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
          <button type="button" class="btn btn-danger w-100" @click="resetFilter">{{ t('room.form.reset') }}</button>
        </div>
      </form>
      <!-- جدول المدن -->
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead>
            <tr>
              <th>#</th>
              <th>{{ t('room.number') }}</th>
               <th>{{ t('room.floor') }}</th>
                <th>{{ t('room.department') }}</th>
              <th>{{ t('room.status') }}</th>
              <th class="text-end">{{t('room.actions')}}</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(room, index) in roomsList" :key="room.id">
              <td>{{ index + 1 + (paginationVar.page - 1) * paginationVar.per_page }}</td>
              <td>{{ room.number }}</td>
               <td>{{ room.floor }}</td>
                <td>{{ room.department?.name }}</td>
              <td>
                <span :class="['badge', room.status === 1 ? 'bg-success' : 'bg-secondary']">
                  {{ room.status === 1 ? 'نشط' : 'غير نشط' }}
                </span>
              </td>
              <td class="text-end">
                <button class="btn btn-outline-warning btn-sm me-1" @click="onEdit(room.id)">{{ t('room.update') }}</button>
                <button class="btn btn-outline-danger btn-sm" @click="onDelete(room.id)">{{ t('room.delete') }}</button>
              </td>
            </tr>
            <tr v-if="roomsList.length === 0">
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
<div class="modal fade" id="deleteRoomModal" tabindex="-1" aria-labelledby="deleteRoomModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteRoomModalLabel">تأكيد الحذف</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
      </div>
      <div class="modal-body">
        هل أنت متأكد أنك تريد حذف المدينة "<strong>{{ roomToDelete?.number }}</strong>"؟
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
import { defaultRoomSearchFilter, type Room } from '@/models/Room/room'
import { deleteRoom, getRoomsList } from '@/services/Room/roomSevice'
import type { Department, DepartmentSearchFilter } from '@/models/Department/department'
import { getDepartmentsList } from '@/services/Department/departmentService'
import { BaseConsts } from '@/utils/consts/base'


const { t } = useI18n()
const pageTitle = computed(() => t('rooms'))
const searchFilter = ref(defaultRoomSearchFilter)
const roomsList = ref<Array<Room>>([])
const departmentsList = ref<Array<Department>>([])
const paginationVar = ref(defaultPagination)
const keyIncrement = ref(0)
const default_per_page = ref(1)
const router = useRouter()
const roomToDelete = ref<Room | null>(null)
let modalInstance: Modal

useHead({ title: pageTitle })
const fetchRooms = async () => {
  const { rooms, pagination } = await getRoomsList(searchFilter.value)
  roomsList.value = rooms
  paginationVar.value = pagination
  keyIncrement.value++
  default_per_page.value = pagination.per_page
}
const changePage = (page: number) => {
  if (page < 1 || page > paginationVar.value.max_page) return
  searchFilter.value.page = page
  fetchRooms()
}

const searchRooms = () => {
  searchFilter.value.page = 1
  fetchRooms ()
}
const resetFilter = () => {
  searchFilter.value.number = undefined
   searchFilter.value.floor = undefined
  searchFilter.value.status = undefined
   searchFilter.value.department_id = undefined
  fetchRooms()
}
const changePerPage = (perPage: number) => {
  searchFilter.value.per_page = perPage
  searchFilter.value.page = 1
  fetchRooms()
}
onMounted(() => {
    fetchRooms()
    const modalElement = document.getElementById('deleteRoomModal')
    if (modalElement) {
      modalInstance = new Modal(modalElement)
    }

    fetchDepartments()
})
const fetchDepartments = async () => {
  const departmentSearchFilter  = {} as DepartmentSearchFilter
  departmentSearchFilter.status = BaseConsts.ACTIVE
  const { departments } = await getDepartmentsList(departmentSearchFilter)
  departmentsList.value = departments
}
const onEdit = (id: number | undefined) => router.push({ path: `/room/${id}/edit` })
const onDelete = (id: number | undefined) => {
  if (!id) return
  const room = roomsList.value.find((c) => c.id === id)
  if (room) {
    roomToDelete.value = room
    modalInstance?.show()
  }
}
const confirmDelete = async () => {
  if (!roomToDelete.value || typeof roomToDelete.value.id !== 'number') return

  const id = roomToDelete.value.id

  try {
    const { success } = await deleteRoom(id)

    if (success) {
      const index = roomsList.value.findIndex((room) => room.id === id)
      if (index !== -1) {
        roomsList.value.splice(index, 1)
      }
    }
  } catch (error) {
    console.error('خطأ أثناء الحذف:', error)
  } finally {
    modalInstance?.hide()
    roomToDelete.value = null
  }
}
watch(
  () => [searchFilter.value.number, searchFilter.value.floor, searchFilter.value.status , searchFilter.value.department_id],
  () => {
    searchFilter.value.page = 1
    fetchRooms ()
  }
)


</script>

