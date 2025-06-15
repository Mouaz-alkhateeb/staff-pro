<template>
  <form class="row contact_form mb-5" @submit.prevent="handleFormSubmit">
    <!-- عنوان النموذج -->
    <div class="col-12 text-center mb-4">
      <h3>{{ localFormType === 'Edit' ? t('department.edit') : t('department.add') }}</h3>
    </div>

    <!-- حقل الاسم -->
    <div class="col-md-12 mb-3">
      <label for="name">{{ t('department.name') }}</label>
      <Field name="name" v-slot="{ field }">
        <input
          id="name"
          type="text"
          class="form-control"
          :placeholder="t('department.name_placeholder')"
          v-bind="field"
          :value="currentDepartement.name"
          @input="(e) => currentDepartement.name = (e.currentTarget as HTMLInputElement).value"
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
      <label class="d-block">{{ t('department.status') }}</label>
      <div class="form-check form-check-inline">
        <input
          class="form-check-input"
          type="radio"
          id="statusActive"
          :value="DepartmentConsts.ACTIVE"
          v-model="currentDepartement.status"
        />
        <label class="form-check-label" for="statusActive">{{ t('department.active') }}</label>
      </div>

      <div class="form-check form-check-inline">
        <input
          class="form-check-input"
          type="radio"
          id="statusInactive"
          :value="DepartmentConsts.INACTIVE"
          v-model="currentDepartement.status"
        />
        <label class="form-check-label" for="statusInactive">{{ t('department.inactive') }}</label>
      </div>
    </div>

    <div class="col-md-12 text-end mt-4">
      <button type="submit" class="btn btn-primary">
        {{ localFormType === 'Edit' ? t('department.update') : t('department.add') }}
      </button>
    </div>
  </form>
</template>



<script setup lang="ts">
import { ref, defineProps, onMounted } from 'vue'
import { useI18n } from 'vue-i18n'
import { useForm, Field, ErrorMessage } from 'vee-validate'
import { useRoute, useRouter } from 'vue-router'
import { defaultDepartment, DepartmentConsts } from '@/models/Department/department'
import { departmentvalidationSchema } from '@/rules/Department/departmentValidation'
import { addDepartment, editDepartment, getDepartment } from '@/services/Department/departmentService'

const { t } = useI18n()
const props = defineProps<{ formType: string }>()
const localFormType = ref(props.formType)
const validationSchema = departmentvalidationSchema
const currentDepartement = ref(defaultDepartment)
const submitted = ref(false)
const router = useRouter()
const route = useRoute()
const departementId = ref(0)


departementId.value = (route.params?.id as unknown as number) ?? 0

const getCurrentDepartement = async () => {
      if (departementId.value === 0) {
        currentDepartement.value.name = ''
        currentDepartement.value.status = 1
        return
      }
      const { department } = await getDepartment(departementId.value)
      currentDepartement.value = department != undefined ? department : defaultDepartment

    }

const { validate } = useForm({
  validationSchema,
  validateOnMount: false,
  initialValues:
        localFormType.value == 'Edit'
          ? {
            name: currentDepartement?.value?.name ?? '',
            status: currentDepartement?.value?.status ?? 1,
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
  const { success } = await addDepartment(currentDepartement.value)
  if (success) {
router.push({ name: 'department' })  }
}

const onSubmitEdit = async () => {
      const departementData = currentDepartement.value
      const { success } = await editDepartment(departementData)
      if (success) {
        router.push({ path: '/department' })
      }
    }
const handleFormSubmit = () => {
  onSubmit(localFormType.value)
}

onMounted(() => {
    getCurrentDepartement()
  })
</script>
