<template>
  <form class="row contact_form mb-5" @submit.prevent="handleFormSubmit">
    <!-- عنوان النموذج -->
    <div class="col-12 text-center mb-4">
      <h3>{{ localFormType === 'Edit' ? t('city.edit') : t('city.add') }}</h3>
    </div>

    <!-- حقل الاسم -->
    <div class="col-md-12 mb-3">
      <label for="name">{{ t('city.name') }}</label>
      <Field name="name" v-slot="{ field }">
        <input
          id="name"
          type="text"
          class="form-control"
          :placeholder="t('city.name_placeholder')"
          v-bind="field"
          :value="currentCity.name"
          @input="(e) => currentCity.name = (e.currentTarget as HTMLInputElement).value"
        />
      </Field>
      <ErrorMessage name="name" v-slot="{ message }">
        <div class="text-danger">
          {{ message === 'validation.required' ? t('validation.required') : message }}
        </div>
      </ErrorMessage>
    </div>

    <!-- الحالة -->
    <div class="col-md-12 mb-3">
      <label class="d-block">{{ t('city.status') }}</label>
      <div class="form-check form-check-inline">
        <input
          class="form-check-input"
          type="radio"
          id="statusActive"
          :value="CityConsts.ACTIVE"
          v-model="currentCity.status"
        />
        <label class="form-check-label" for="statusActive">{{ t('city.active') }}</label>
      </div>

      <div class="form-check form-check-inline">
        <input
          class="form-check-input"
          type="radio"
          id="statusInactive"
          :value="CityConsts.INACTIVE"
          v-model="currentCity.status"
        />
        <label class="form-check-label" for="statusInactive">{{ t('city.inactive') }}</label>
      </div>
    </div>

    <div class="col-md-12 text-end mt-4">
      <button type="submit" class="btn btn-primary">
        {{ localFormType === 'Edit' ? t('city.update') : t('city.add') }}
      </button>
    </div>
  </form>
</template>



<script setup lang="ts">
import { ref, defineProps, onMounted } from 'vue'
import { useI18n } from 'vue-i18n'
import { useForm, Field, ErrorMessage } from 'vee-validate'
import { cityvalidationSchema } from '@/rules/city/cityValidation'
import { addCity, editCity, getCity } from '@/services/City/cityService'
import { CityConsts, defaultCity } from '@/models/City/city'
import { useRoute, useRouter } from 'vue-router'

const { t } = useI18n()
const props = defineProps<{ formType: string }>()
const localFormType = ref(props.formType)
const validationSchema = cityvalidationSchema
const currentCity = ref(defaultCity)
const submitted = ref(false)
const router = useRouter()
const route = useRoute()
const cityId = ref(0)


cityId.value = (route.params?.id as unknown as number) ?? 0

const getCurrentCity = async () => {
      if (cityId.value === 0) {
        currentCity.value.name = ''
        currentCity.value.status = 1
        return
      }
      const { city } = await getCity(cityId.value)
      currentCity.value = city != undefined ? city : defaultCity

    }

const { validate } = useForm({
  validationSchema,
  validateOnMount: false,
  initialValues:
        localFormType.value == 'Edit'
          ? {
            name: currentCity?.value?.name ?? '',
            status: currentCity?.value?.status ?? 1,
          }
          : {
            name: '',
            status: 1,
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
  const { success } = await addCity(currentCity.value)
  if (success) {
router.push({ name: 'city' })  }
}

const onSubmitEdit = async () => {
      const cityData = currentCity.value
      const { success } = await editCity(cityData)
      if (success) {
        router.push({ path: '/city' })
      }
    }
const handleFormSubmit = () => {
  onSubmit(localFormType.value)
}

onMounted(() => {
    getCurrentCity()
  })
</script>
