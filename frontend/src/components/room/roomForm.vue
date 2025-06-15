<template>
  <form class="row contact_form mb-5" @submit.prevent="handleFormSubmit">
    <!-- عنوان النموذج -->
    <div class="col-12 text-center mb-4">
      <h3>{{ localFormType === 'Edit' ? t('room.edit') : t('room.add') }}</h3>
    </div>

    <!-- حقل الاسم -->
    <div class="col-md-6 mb-3">
      <label for="name">{{ t('room.number') }}</label>
      <Field name="number" v-slot="{ field }">
        <input
          id="number"
          type="number"
          class="form-control"
          :placeholder="t('room.name_placeholder')"
          v-bind="field"
           v-model="currentRoom.number"
        />
      </Field>
      <ErrorMessage name="name" v-slot="{ message }">
        <div class="text-danger">
          {{ message === 'validation.required' ? t('validation.required') : message }}
        </div>
      </ErrorMessage>
    </div>
    <div class="col-md-6 mb-3">
      <label for="name">{{ t('room.floor') }}</label>
      <Field name="floor" v-slot="{ field }">
        <input
          id="floor"
          type="number"
          class="form-control"
          :placeholder="t('room.floor_placeholder')"
          v-bind="field"
          v-model="currentRoom.floor"

        />

      </Field>
      <ErrorMessage name="name" v-slot="{ message }">
        <div class="text-danger">
          {{ message === 'validation.required' ? t('validation.required') : message }}
        </div>
      </ErrorMessage>
    </div>
    <div class="col-md-12 mb-3">
      <label for="department">{{ t('room.form.select') }}</label>
        <Field name="department_id">
          <select
            id="department"
            class="form-control"
            v-model="currentRoom.department_id"
          >
            <option value="">{{ t('room.form.select') }}</option>
            <option
              v-for="department in departmentsList"
              :key="department.id"
              :value="department.id"
            >
              {{ department.name }}
            </option>
          </select>
        </Field>

        <ErrorMessage name="department_id" v-slot="{ message }">
          <div class="text-danger">
            {{ message === 'validation.required' ? t('validation.required') : message }}
          </div>
        </ErrorMessage>
     </div>
    <!-- الحالة -->
    <div class="col-md-12 mb-3">
      <label class="d-block">{{ t('room.status') }}</label>
      <div class="form-check form-check-inline">
        <input
          class="form-check-input"
          type="radio"
          id="statusActive"
          :value="RoomConsts.ACTIVE"
          v-model="currentRoom.status"
        />
        <label class="form-check-label" for="statusActive">{{ t('room.active') }}</label>
      </div>

      <div class="form-check form-check-inline">
        <input
          class="form-check-input"
          type="radio"
          id="statusInactive"
          :value="RoomConsts.INACTIVE"
          v-model="currentRoom.status"
        />
        <label class="form-check-label" for="statusInactive">{{ t('room.inactive') }}</label>
      </div>
    </div>

    <div class="col-md-12 text-end mt-4">
      <button type="submit" class="btn btn-primary">
        {{ localFormType === 'Edit' ? t('room.update') : t('room.add') }}
      </button>
    </div>
  </form>
</template>



<script setup lang="ts">
import { ref, defineProps, onMounted } from 'vue'
import { useI18n } from 'vue-i18n'
import { useForm, Field, ErrorMessage } from 'vee-validate'
import { useRoute, useRouter } from 'vue-router'
import { roomvalidationSchema } from '@/rules/room/roomValidation'
import {  defaultCreateUpdateRoom, RoomConsts, type CreateUpdateRoom } from '@/models/Room/room'
import { addRoom, editRoom, getRoom } from '@/services/Room/roomSevice'
import {  defaultDepartment, type Department, type DepartmentSearchFilter } from '@/models/Department/department'
import { BaseConsts } from '@/utils/consts/base'
import { getDepartmentsList } from '@/services/Department/departmentService'

const { t } = useI18n()
const props = defineProps<{ formType: string }>()
const localFormType = ref(props.formType)
const validationSchema = roomvalidationSchema

const currentRoom = ref<CreateUpdateRoom>({ ...defaultCreateUpdateRoom })

const submitted = ref(false)
const router = useRouter()
const route = useRoute()
const roomId = ref(0)
const departmentsList = ref<Array<Department>>([])


roomId.value = (route.params?.id as unknown as number) ?? 0

const getCurrentRoom = async () => {
    if (roomId.value === 0) {
      currentRoom.value.number = 0
      currentRoom.value.floor = 0
      currentRoom.value.department_id = defaultDepartment.id
      currentRoom.value.status = 1
      return
    }
    const { room } = await getRoom(roomId.value)
  currentRoom.value = {
      id: room.id,
      number: room.number,
      floor: room.floor,
      status: room.status,
      department_id: room.department?.id ?? 0,
    }
    setValues({
      number: room.number,
      floor: room.floor,
      department_id: room.department?.id ?? 0,
      status: room.status,
    })
}

const { validate, setValues   } = useForm({
  validationSchema,
  validateOnMount: false,
  initialValues:
        localFormType.value == 'Edit'
          ? {
           number: currentRoom.value.number ?? undefined,
            floor: currentRoom.value.floor ?? undefined,
            status: currentRoom.value.status ?? 1,
            department_id: currentRoom.value?.department_id?? 0,
          }
          : {
            number: '',
            floor: '',
            status: 1,
            department_id: 0,
      },
})

const onSubmit = async (method: string) => {
  submitted.value = true
  const isValid = await validate()
  if (!isValid) return

  if (method === 'Add') {
    await onSubmitAdd()
  } else if (method === 'Edit') {
    await onSubmitEdit()
  }
}

const onSubmitAdd = async () => {

  const roomForm: CreateUpdateRoom = {
    number: currentRoom.value.number,
    floor: currentRoom.value.floor,
    department_id: currentRoom.value.department_id,
    status: currentRoom.value.status,
  }
  const { success } = await addRoom(roomForm)
    if (success) {
    router.push({ name: 'room' })
    }

}

const onSubmitEdit = async () => {
  const roomData = currentRoom.value
      console.log(roomData)
      const { success } = await editRoom(roomData)
      if (success) {
        router.push({ path: '/room' })
      }
    }
const handleFormSubmit = () => {
  onSubmit(localFormType.value)
}

const fetchDepartments = async () => {
  const departmentSearchFilter  = {} as DepartmentSearchFilter
  departmentSearchFilter.status = BaseConsts.ACTIVE
  const { departments } = await getDepartmentsList(departmentSearchFilter)
  departmentsList.value = departments
}

onMounted(async () => {
  getCurrentRoom()
  fetchDepartments()
  })
</script>
