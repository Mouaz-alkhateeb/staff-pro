<template>
  <section class="contact_area section_gap">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">{{ t('user') }}</h2>
        <router-link :to="{ name: 'add_user' }" class="btn btn-success btn-sm">
          <i class="bi bi-plus-circle"></i> {{ t('user.add') }}
        </router-link>
      </div>

      <form @submit.prevent="searchUsers" class="row g-3 align-items-end mb-3">
        <div class="col-md-2">
          <label class="form-label">{{ t('user.first_name') }}</label>
          <input type="text" class="form-control" v-model="searchFilter.name"  :placeholder="t('user.name_placeholder')">
        </div>

        <div class="col-md-2">
          <label class="form-label">{{ t('user.city') }}</label>
          <select class="form-select" v-model="searchFilter.city_id">
            <option :value="undefined">{{ t('user.form.select_city') }}</option>
            <option
              v-for="city in citiesList"
              :key="city.id"
              :value="city.id"
            >
              {{ city.name }}
            </option>
          </select>
        </div>
        <div class="col-md-2">
          <label class="form-label">{{ t('user.room') }}</label>
          <select class="form-select" v-model="searchFilter.room_id">
            <option :value="undefined">{{ t('user.form.select_room') }}</option>
            <option
              v-for="room in roomsList"
              :key="room.id"
              :value="room.id"
            >
              {{ room.number }}
            </option>
          </select>
        </div>
        <div class="col-md-2">
          <label class="form-label">{{ t('user.gender') }}</label>
          <select class="form-select" v-model="searchFilter.gender">
            <option :value="undefined">{{ t('user.gender') }}</option>
            <option :value="BaseConsts.MALE">{{ t('user.male') }}</option>
            <option :value="BaseConsts.FEMALE">{{ t('user.female') }}</option>
          </select>
        </div>

        <div class="col-md-2">
          <label class="form-label">{{ t('user.number_in_page') }}</label>
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
          <button type="button" class="btn btn-danger w-100" @click="resetFilter">{{ t('user.form.reset') }}</button>
        </div>
      </form>
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead>
            <tr>
              <th>#</th>
              <th>{{ t('user.first_name') }}</th>
              <th>{{ t('user.last_name') }}</th>
              <th>{{ t('user.gender') }}</th>
              <th>{{ t('user.phone_number') }}</th>
               <th>{{ t('user.birth_date') }}</th>
              <th>{{ t('user.city') }}</th>
               <th>{{ t('user.room') }}</th>
              <th>{{ t('user.userstatus') }}</th>
               <th>{{ t('user.role') }}</th>
              <th class="text-end">{{t('user.actions')}}</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(user, index) in usersList" :key="user.id">
              <td>{{ index + 1 + (paginationVar.page - 1) * paginationVar.per_page }}</td>
              <td>{{ user.first_name }}</td>
              <td>{{ user.last_name }}</td>
               <td>{{ user.gender }}</td>
                <td>{{ user.phone_number }}</td>
                <td>{{ user.birth_date }}</td>
                <td>{{ user.city.name }}</td>
                <td>{{ user.room.number }}</td>
                 <td>{{ user.status.name }}</td>
                  <td>
                    <span v-if="user.roles && user.roles.length">
                      {{ user.roles.map(role => role.display_name).join(', ') }}
                    </span>
                    <span v-else>
                      User
                    </span>
                  </td>
              <td class="text-end">
                <button class="btn btn-outline-primary btn-sm me-1" @click="onDetails(user.id)">{{ t('user.details') }}</button>
                <button class="btn btn-outline-warning btn-sm me-1" @click="onEdit(user.id)">{{ t('user.update') }}</button>
                <button class="btn btn-outline-danger btn-sm" @click="onDelete(user.id)">{{ t('user.delete') }}</button>
              </td>
            </tr>
            <tr v-if="usersList.length === 0">
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
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteUserodalLabel">تأكيد الحذف</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
      </div>
      <div class="modal-body">
        هل أنت متأكد أنك تريد حذف المدينة "<strong>{{ userToDelete?.first_name }}</strong>"؟
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
import { defaultUserSearchFilter, type User, type UserSearchFilter } from '@/models/User/user'
import { deleteUser, getUsersList } from '@/services/User/UserService'
import type { City } from '@/models/City/city'
import { getCitiesList } from '@/services/City/cityService'
import type { Room } from '@/models/Room/room'
import { getRoomsList } from '@/services/Room/roomSevice'
import { BaseConsts } from '@/utils/consts/base'


const { t } = useI18n()
const pageTitle = computed(() => t('users'))
const searchFilter = ref(defaultUserSearchFilter)
const usersList = ref<Array<User>>([])
const paginationVar = ref(defaultPagination)
const keyIncrement = ref(0)
const default_per_page = ref(1)
const router = useRouter()
const userToDelete = ref<User | null>(null)
let modalInstance: Modal
const citiesList = ref<Array<City>>([])
const roomsList = ref<Array<Room>>([])


useHead({ title: pageTitle })
const fetchUsers = async () => {
  const { users, pagination } = await getUsersList(searchFilter.value)
  usersList.value = users
  paginationVar.value = pagination
  keyIncrement.value++
  default_per_page.value = pagination.per_page
}
const changePage = (page: number) => {
  if (page < 1 || page > paginationVar.value.max_page) return
  searchFilter.value.page = page
  fetchUsers()
}

const searchUsers = () => {
  searchFilter.value.page = 1
  fetchUsers ()
}
const resetFilter = () => {
  searchFilter.value.name = undefined
  searchFilter.value.gender = undefined
  searchFilter.value.city_id = undefined
  searchFilter.value.room_id = undefined
  fetchUsers()
}
const changePerPage = (perPage: number) => {
  searchFilter.value.per_page = perPage
  searchFilter.value.page = 1
  fetchUsers()
}
onMounted(() => {
    fetchUsers()
    const modalElement = document.getElementById('deleteUserModal')
    if (modalElement) {
      modalInstance = new Modal(modalElement)
    }

  fetchCities()
  fetchRooms()
})

const fetchCities = async () => {
  const userSearchFilter  = {} as UserSearchFilter
  const { cities } = await getCitiesList(userSearchFilter)
  citiesList.value = cities
}

const fetchRooms = async () => {
  const userSearchFilter  = {} as UserSearchFilter
  const { rooms } = await getRoomsList(userSearchFilter)
  roomsList.value = rooms
}


const onEdit = (id: number | undefined) => router.push({ path: `/user/${id}/edit` })
const onDetails = (id: number | undefined) => router.push({ path: `/user/${id}/details` })


const onDelete = (id: number | undefined) => {
  if (!id) return
  const user = usersList.value.find((c) => c.id === id)
  if (user) {
    userToDelete.value = user
    modalInstance?.show()
  }
}
const confirmDelete = async () => {
  if (!userToDelete.value || typeof userToDelete.value.id !== 'number') return

  const id = userToDelete.value.id

  try {
    const { success } = await deleteUser(id)

    if (success) {
      const index = usersList.value.findIndex((user) => user.id === id)
      if (index !== -1) {
        usersList.value.splice(index, 1)
      }
    }
  } catch (error) {
    console.error('خطأ أثناء الحذف:', error)
  } finally {
    modalInstance?.hide()
    userToDelete.value = null
  }
}
watch(
  () => [searchFilter.value.name, searchFilter.value.gender,searchFilter.value.city_id,searchFilter.value.room_id],
  () => {
    searchFilter.value.page = 1
    fetchUsers ()
  }
)


</script>

