<template>
  <form class="row contact_form mb-5" @submit.prevent="handleFormSubmit">
    <!-- عنوان النموذج -->
    <div class="col-12 text-center mb-4">
      <h3>{{ localFormType === 'Edit' ? t('nationality.edit') : t('nationality.add') }}</h3>
    </div>

    <!-- حقل الاسم -->
    <div class="col-md-12 mb-3">
      <label for="name">{{ t('nationality.name') }}</label>
      <Field name="name" v-slot="{ field }">
        <input
          id="name"
          type="text"
          class="form-control"
          :placeholder="t('nationality.name_placeholder')"
          v-bind="field"
          :value="currentNationality.name"
          @input="(e) => currentNationality.name = (e.currentTarget as HTMLInputElement).value"
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
      <label class="d-block">{{ t('nationality.status') }}</label>
      <div class="form-check form-check-inline">
        <input
          class="form-check-input"
          type="radio"
          id="statusActive"
          :value="NationalityConsts.ACTIVE"
          v-model="currentNationality.status"
        />
        <label class="form-check-label" for="statusActive">{{ t('nationality.active') }}</label>
      </div>

      <div class="form-check form-check-inline">
        <input
          class="form-check-input"
          type="radio"
          id="statusInactive"
          :value="NationalityConsts.INACTIVE"
          v-model="currentNationality.status"
        />
        <label class="form-check-label" for="statusInactive">{{ t('nationality.inactive') }}</label>
      </div>
    </div>

    <div class="col-md-12 text-end mt-4">
      <button type="submit" class="btn btn-primary">
        {{ localFormType === 'Edit' ? t('nationality.update') : t('nationality.add') }}
      </button>
    </div>
  </form>
</template>



<script setup lang="ts">
import { ref, defineProps, onMounted } from 'vue'
import { useI18n } from 'vue-i18n'
import { useForm, Field, ErrorMessage } from 'vee-validate'
import { useRoute, useRouter } from 'vue-router'
import { defaultNationality, NationalityConsts } from '@/models/Nationality/nationality'
import { addNationality, editNationality, getNationality } from '@/services/Nationality/nationalityService'
import { nationalityvalidationSchema } from '@/rules/nationality/nationalityvalidationSchema'

const { t } = useI18n()
const props = defineProps<{ formType: string }>()
const localFormType = ref(props.formType)
const validationSchema = nationalityvalidationSchema
const currentNationality = ref(defaultNationality)
const submitted = ref(false)
const router = useRouter()
const route = useRoute()
const nationalityId = ref(0)


nationalityId.value = (route.params?.id as unknown as number) ?? 0

const getCurrentNationality = async () => {
      if (nationalityId.value === 0) {
        currentNationality.value.name = ''
        currentNationality.value.status = 1
        return
      }
      const { nationality } = await getNationality(nationalityId.value)
      currentNationality.value = nationality != undefined ? nationality : defaultNationality

    }

const { validate } = useForm({
  validationSchema,
  validateOnMount: false,
  initialValues:
        localFormType.value == 'Edit'
          ? {
            name: currentNationality?.value?.name ?? '',
            status: currentNationality?.value?.status ?? 1,
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
  const { success } = await addNationality(currentNationality.value)
  if (success) {
router.push({ name: 'nationality' })  }
}

const onSubmitEdit = async () => {
      const nationalityData = currentNationality.value
      const { success } = await editNationality(nationalityData)
      if (success) {
        router.push({ path: '/nationality' })
      }
    }
const handleFormSubmit = () => {
  onSubmit(localFormType.value)
}

onMounted(() => {
    getCurrentNationality()
  })
</script>
