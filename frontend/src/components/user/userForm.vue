<template>
  <form class="row contact_form mb-5" @submit.prevent="handleFormSubmit">
    <div class="col-12 text-center mb-4">
      <h3>{{ localFormType === 'Edit' ? t('user.edit') : t('user.add') }}</h3>
    </div>

    <!-- First Name -->
    <div class="col-md-6 mb-3">
      <label for="first_name">{{ t('user.first_name') }}</label>
      <Field name="first_name" v-slot="{ field, errorMessage }">
        <input
          id="first_name"
          type="text"
          class="form-control"
          :placeholder="t('user.first_name_placeholder')"
          v-bind="field"
          v-model="currentUser.first_name"
        />
        <div class="text-danger" v-if="submitted && errorMessage">
          {{ errorMessage }}
        </div>
      </Field>
    </div>

    <!-- Last Name -->
    <div class="col-md-6 mb-3">
      <label for="last_name">{{ t('user.last_name') }}</label>
      <Field name="last_name" v-slot="{ field, errorMessage }">
        <input
          id="last_name"
          type="text"
          class="form-control"
          :placeholder="t('user.last_name_placeholder')"
          v-bind="field"
          v-model="currentUser.last_name"
        />
        <div class="text-danger" v-if="submitted && errorMessage">
          {{ errorMessage }}
        </div>
      </Field>
    </div>

    <!-- Password -->
    <div class="col-md-6 mb-3">
      <label for="password">{{ t('user.password') }}</label>
      <Field name="password" v-slot="{ field, errorMessage }">
        <input
          id="password"
          type="password"
          class="form-control"
          :placeholder="t('user.password_placeholder')"
          v-bind="field"
          v-model="currentUser.password"
        />
        <div class="text-danger" v-if="submitted && errorMessage">
          {{ errorMessage }}
        </div>
      </Field>
    </div>

    <!-- Phone Number -->
    <div class="col-md-6 mb-3">
      <label for="phone_number">{{ t('user.phone_number') }}</label>
      <Field name="phone_number" v-slot="{ field, errorMessage }">
        <input
          id="phone_number"
          type="text"
          class="form-control"
          :placeholder="t('user.phone_number_placeholder')"
          v-bind="field"
          v-model="currentUser.phone_number"
        />
        <div class="text-danger" v-if="submitted && errorMessage">
          {{ errorMessage }}
        </div>
      </Field>
    </div>

    <!-- Birth Date -->
    <div class="col-md-6 mb-3">
      <label for="birth_date">{{ t('user.birth_date') }}</label>
      <Field name="birth_date" v-slot="{ field, errorMessage }">
        <input
          id="birth_date"
          type="date"
          class="form-control"
          :placeholder="t('user.birth_date_placeholder')"
          v-bind="field"
          v-model="currentUser.birth_date"
        />
        <div class="text-danger" v-if="submitted && errorMessage">
          {{ errorMessage }}
        </div>
      </Field>
    </div>

    <!-- Address -->
    <div class="col-md-6 mb-3">
      <label for="address">{{ t('user.address') }}</label>
      <Field name="address" v-slot="{ field, errorMessage }">
        <textarea
          id="address"
          class="form-control"
          :placeholder="t('user.address_placeholder')"
          v-bind="field"
          v-model="currentUser.address"
        ></textarea>
        <div class="text-danger" v-if="submitted && errorMessage">
          {{ errorMessage }}
        </div>
      </Field>
    </div>

    <!-- Gender -->
    <div class="col-md-6 mb-3">
      <label for="gender">{{ t('user.gender') }}</label>
      <Field name="gender" v-slot="{ errorMessage }">
        <select
          id="gender"
          class="form-control"
          v-model="currentUser.gender"
        >
          <option value="">{{ t('user.form.select') }}</option>
          <option value="Male">{{ t('user.male') }}</option>
          <option value="Female">{{ t('user.female') }}</option>
        </select>
        <div class="text-danger" v-if="submitted && errorMessage">
          {{ errorMessage }}
        </div>
      </Field>
    </div>

    <!-- City -->
    <div class="col-md-6 mb-3">
      <label for="city_id">{{ t('user.city') }}</label>
      <Field name="city_id" v-slot="{  errorMessage }">
        <select
          id="city_id"
          class="form-control"
          v-model="currentUser.city_id"
        >
          <option value="">{{ t('user.form.select') }}</option>
          <option
            v-for="city in citiesList"
            :key="city.id"
            :value="city.id"
          >
            {{ city.name }}
          </option>
        </select>
        <div class="text-danger" v-if="submitted && errorMessage">
          {{ errorMessage }}
        </div>
      </Field>
    </div>

    <!-- Room -->
    <div class="col-md-6 mb-3">
      <label for="room_id">{{ t('user.room') }}</label>
      <Field name="room_id" v-slot="{  errorMessage }">
        <select
          id="room_id"
          class="form-control"
          v-model="currentUser.room_id"
        >
          <option value="">{{ t('user.form.select') }}</option>
          <option
            v-for="room in roomsList"
            :key="room.id"
            :value="room.id"
          >
            {{ room.number }}
          </option>
        </select>
        <div class="text-danger" v-if="submitted && errorMessage">
          {{ errorMessage }}
        </div>
      </Field>
    </div>

    <!-- User Status -->
    <div class="col-md-6 mb-3">
      <label for="user_status_id">{{ t('user.status') }}</label>
      <Field name="user_status_id" v-slot="{ errorMessage }">
        <select
          id="user_status_id"
          class="form-control"
          v-model="currentUser.user_status_id"
        >
          <option value="">{{ t('user.form.select') }}</option>
          <option
            v-for="status in statusesList"
            :key="status.id"
            :value="status.id"
          >
            {{ status.name }}
          </option>
        </select>
        <div class="text-danger" v-if="submitted && errorMessage">
          {{ errorMessage }}
        </div>
      </Field>
    </div>

    <!-- Roles -->
    <div class="col-md-12 mb-3">
      <label class="d-block">{{ t('user.roles') }}</label>
      <Field name="roles" v-slot="{ errorMessage }">
        <div class="form-check form-check-inline" v-for="role in rolesList" :key="role.id">
          <input
            class="form-check-input"
            type="checkbox"
            :id="'role_' + role.id"
            :value="role.id"
            v-model="currentUser.roles"

          />
          <label class="form-check-label" :for="'role_' + role.id">{{ role.name }}</label>
        </div>
        <div class="text-danger" v-if="submitted && errorMessage">
          {{ errorMessage }}
        </div>
      </Field>
    </div>

    <!-- Submit Button -->
    <div class="col-md-12 text-end mt-4">
      <button type="submit" class="btn btn-primary">
        {{ localFormType === 'Edit' ? t('user.update') : t('user.add') }}
      </button>
    </div>
  </form>
</template>

<script setup lang="ts">
import { defaultCitySearchFilter, type City } from '@/models/City/city';
import { defaultRoomSearchFilter, type Room } from '@/models/Room/room';
import { defaultCreateUpdateUser, type CreateUpdateUser } from '@/models/User/user';
import { defaultUserStatusSearchFilter, type UserStatus } from '@/models/UserStatus/userStatus';
import { uservalidationSchema } from '@/rules/user/userValidation';
import { getCitiesList } from '@/services/City/cityService';
import { getRolesList } from '@/services/Role/roleService';
import { getRoomsList } from '@/services/Room/roomSevice';
import { addUser, editUser, getUser } from '@/services/User/UserService';
import { getUserStatusesList } from '@/services/UserStatus/nationalityService';
import { BaseConsts } from '@/utils/consts/base';
import type { Role } from '@/utils/consts/rolesPermissions';
import { useForm } from 'vee-validate';
import { onMounted, ref } from 'vue';
import { useI18n } from 'vue-i18n';
import { useRoute, useRouter } from 'vue-router';



const { t } = useI18n()
const props = defineProps<{ formType: string }>()
const localFormType = ref(props.formType)
const validationSchema = uservalidationSchema

const currentUser = ref<CreateUpdateUser>({ ...defaultCreateUpdateUser })
const submitted = ref(false)
const router = useRouter()
const route = useRoute()
const userId = ref(0)
const citiesList = ref<Array<City>>([])
const roomsList = ref<Array<Room>>([])
const statusesList = ref<Array<UserStatus>>([])
const rolesList = ref<Array<Role>>([])

userId.value = (route.params?.id as unknown as number) ?? 0

const getCurrentUser = async () => {
  if (userId.value === 0) {
    currentUser.value = { ...defaultCreateUpdateUser }
    return
  }
  const { user } = await getUser(userId.value)
  currentUser.value = {
    id: user.id,
    first_name: user.first_name,
    last_name: user.last_name,
    password: user.password || '',
    gender: user.gender,
    birth_date: user.birth_date,
    phone_number: user.phone_number,
    address: user.address,
    city_id: user.city?.id ?? 0,
    room_id: user.room?.id ?? 0,
    user_status_id: user.status?.id ?? 0,
    roles: user.roles?.map(role => role.id) || [],
  }
  setValues({
    first_name: user.first_name,
    last_name: user.last_name,
    password: user.password || '',
    gender: user.gender,
    birth_date: user.birth_date,
    phone_number: user.phone_number,
    address: user.address,
    city_id: user.city?.id ?? 0,
    room_id: user.room?.id ?? 0,
    user_status_id: user.status?.id ?? 0,
    roles: user.roles?.map(role => role.id) || [],
  })
}

const { validate, setValues } = useForm({
  validationSchema,
  validateOnMount: false,
  initialValues:
    localFormType.value === 'Edit'
      ? {
          first_name: currentUser.value.first_name ?? '',
          last_name: currentUser.value.last_name ?? '',
          password: currentUser.value.password ?? '',
          gender: currentUser.value.gender ?? '',
          birth_date: currentUser.value.birth_date ?? '',
          phone_number: currentUser.value.phone_number ?? '',
          address: currentUser.value.address ?? '',
          city_id: currentUser.value.city_id ?? 0,
          room_id: currentUser.value.room_id ?? 0,
          user_status_id: currentUser.value.user_status_id ?? 0,
          roles: currentUser.value.roles ?? [],
        }
      : {
          first_name: '',
          last_name: '',
          password: '0000000000',
          gender: '',
          birth_date: '',
          phone_number: '',
          address: '',
          city_id: 0,
          room_id: 0,
          user_status_id: 0,
          roles: [],
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
  const userForm: CreateUpdateUser = {
    first_name: currentUser.value.first_name,
    last_name: currentUser.value.last_name,
    password: currentUser.value.password,
    gender: currentUser.value.gender,
    birth_date: currentUser.value.birth_date,
    phone_number: currentUser.value.phone_number,
    address: currentUser.value.address,
    city_id: currentUser.value.city_id,
    room_id: currentUser.value.room_id,
    user_status_id: currentUser.value.user_status_id,
    roles: currentUser.value.roles,
  }
  const { success } = await addUser(userForm)
  if (success) {
    router.push({ name: 'user' })
  }
}

const onSubmitEdit = async () => {
  const userData = currentUser.value
  const { success } = await editUser(userData)
  if (success) {
    router.push({ path: '/user' })
  }
}

const handleFormSubmit = () => {
  onSubmit(localFormType.value)
}

const fetchData = async () => {
  const citySearchFilter = { ...defaultCitySearchFilter, status: BaseConsts.ACTIVE }
  const { cities } = await getCitiesList(citySearchFilter)
  citiesList.value = cities

  const roomSearchFilter = { ...defaultRoomSearchFilter, status: BaseConsts.ACTIVE }
  const { rooms } = await getRoomsList(roomSearchFilter)
  roomsList.value = rooms

  const statusSearchFilter = { ...defaultUserStatusSearchFilter, status: BaseConsts.ACTIVE }
  const { userstatuses } = await getUserStatusesList(statusSearchFilter)
  statusesList.value = userstatuses

  const { roles } = await getRolesList()
  rolesList.value = roles
}


onMounted(async () => {
  await getCurrentUser()
  await fetchData()
})
</script>
