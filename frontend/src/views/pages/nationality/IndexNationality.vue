


<template>
  <section class="contact_area section_gap">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">{{ t('nationalities') }}</h2>
        <router-link :to="{ name: 'add_nationality' }" class="btn btn-success btn-sm">
          <i class="bi bi-plus-circle"></i> {{ t('nationality.add') }}
        </router-link>
      </div>

      <form @submit.prevent="searchNationalitiesList" class="row g-3 align-items-end mb-3">
        <div class="col-md-4">
          <label class="form-label">{{ t('nationality.name') }}</label>
          <input type="text" class="form-control" v-model="searchFilter.name"  :placeholder="t('nationality.name_placeholder')">
        </div>
        <div class="col-md-3">
          <label class="form-label">{{ t('nationality.status') }}</label>
          <select class="form-select" v-model="searchFilter.status">
            <option :value="undefined">{{ t('nationality.all') }}</option>
            <option :value="1">{{ t('nationality.active') }}</option>
            <option :value="0">{{ t('nationality.inactive') }}</option>
          </select>
        </div>
        <div class="col-md-3">
          <label class="form-label">{{ t('nationality.number_in_page') }}</label>
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
          <button type="button" class="btn btn-danger" @click="resetFilter">{{ t('nationality.form.reset') }}</button>
        </div>
      </form>

      <!-- جدول المدن -->
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead>
            <tr>
              <th>#</th>
              <th>{{ t('nationality.name') }}</th>
              <th>{{ t('nationality.status') }}</th>
              <th class="text-end">{{t('nationality.actions')}}</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(nationality, index) in nationalitiesList" :key="nationality.id">
              <td>{{ index + 1 + (paginationVar.page - 1) * paginationVar.per_page }}</td>
              <td>{{ nationality.name }}</td>
              <td>
                <span :class="['badge', nationality.status === 1 ? 'bg-success' : 'bg-secondary']">
                  {{ nationality.status === 1 ? 'نشط' : 'غير نشط' }}
                </span>
              </td>
              <td class="text-end">
                <button class="btn btn-outline-warning btn-sm me-1" @click="onEdit(nationality.id)">{{ t('nationality.update') }}</button>
                <button class="btn btn-outline-danger btn-sm" @click="onDelete(nationality.id)">{{ t('nationality.delete') }}</button>
              </td>
            </tr>
            <tr v-if="nationalitiesList.length === 0">
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
<div class="modal fade" id="deleteNationalityModal" tabindex="-1" aria-labelledby="deleteNationalitModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteNationalitModalLabel">تأكيد الحذف</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
      </div>
      <div class="modal-body">
        هل أنت متأكد أنك تريد حذف المدينة "<strong>{{ nationalitToDelete?.name }}</strong>"؟
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
import { defaultNationalitySearchFilter, type Nationality } from '@/models/Nationality/nationality'
import { deleteNationality, getNationalitiesList } from '@/services/Nationality/nationalityService'


const { t } = useI18n()
const pageTitle = computed(() => t('nationalities'))
const searchFilter = ref(defaultNationalitySearchFilter)
const nationalitiesList = ref<Array<Nationality>>([])
const paginationVar = ref(defaultPagination)
const keyIncrement = ref(0)
const default_per_page = ref(1)
const router = useRouter()
const nationalitToDelete = ref<Nationality | null>(null)
let modalInstance: Modal


useHead({ title: pageTitle })

const fetchNationalities = async () => {
  const { nationalities, pagination } = await getNationalitiesList(searchFilter.value)
  nationalitiesList.value = nationalities
  paginationVar.value = pagination
  keyIncrement.value++
  default_per_page.value = pagination.per_page
}

const changePage = (page: number) => {
  if (page < 1 || page > paginationVar.value.max_page) return
  searchFilter.value.page = page
  fetchNationalities()
}

const searchNationalitiesList = () => {
  searchFilter.value.page = 1
  fetchNationalities()
}

const resetFilter = () => {
  searchFilter.value.name = ''
   searchFilter.value.status = undefined
  fetchNationalities()
}

const changePerPage = (perPage: number) => {
  searchFilter.value.per_page = perPage
  searchFilter.value.page = 1
  fetchNationalities()
}
onMounted(() => {
  fetchNationalities()
  const modalElement = document.getElementById('deleteNationalityModal')
  if (modalElement) {
    modalInstance = new Modal(modalElement)
  }
})


const onEdit = (id: number | undefined) => router.push({ path: `/nationality/${id}/edit` })
const onDelete = (id: number | undefined) => {
  if (!id) return
  const nationality = nationalitiesList.value.find((c) => c.id === id)
  if (nationality) {
    nationalitToDelete.value = nationality
    modalInstance?.show()
  }
}
const confirmDelete = async () => {
  if (!nationalitToDelete.value || typeof nationalitToDelete.value.id !== 'number') return

  const id = nationalitToDelete.value.id

  try {
    const { success } = await deleteNationality(id)

    if (success) {
      const index = nationalitiesList.value.findIndex((nationality) => nationality.id === id)
      if (index !== -1) {
        nationalitiesList.value.splice(index, 1)
      }
    }
  } catch (error) {
    console.error('خطأ أثناء الحذف:', error)
  } finally {
    modalInstance?.hide()
    nationalitToDelete.value = null
  }
}

watch(
  () => [searchFilter.value.name, searchFilter.value.status],
  () => {
    searchFilter.value.page = 1
    fetchNationalities()
  }
)


</script>

