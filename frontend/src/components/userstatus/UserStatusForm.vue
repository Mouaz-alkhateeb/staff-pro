<template>
  <form class="row contact_form mb-5" @submit.prevent="handleFormSubmit">
    <!-- عنوان النموذج -->
    <div class="col-12 text-center mb-4">
      <h3>{{ localFormType === 'Edit' ? t('userstatus.edit') : t('userstatus.add') }}</h3>
    </div>

    <!-- حقل الاسم -->
    <div class="col-md-12 mb-3">
      <label for="name">{{ t('userstatus.name') }}</label>
      <Field name="name" v-slot="{ field }">
        <input
          id="name"
          type="text"
          class="form-control"
          :placeholder="t('userstatus.name_placeholder')"
          v-bind="field"
          :value="currentUserStatus.name"
          @input="(e) => currentUserStatus.name = (e.currentTarget as HTMLInputElement).value"
        />
      </Field>
      <ErrorMessage name="name" v-slot="{ message }">
        <div class="text-danger">
          {{ message === 'validation.required' ? t('validation.required') : message }}
        </div>
      </ErrorMessage>
    </div>


    <div class="col-md-12 text-end mt-4">
      <button type="submit" class="btn btn-primary">
        {{ localFormType === 'Edit' ? t('userstatus.update') : t('userstatus.add') }}
      </button>
    </div>
  </form>
</template>



<script setup lang="ts">
import { ref, defineProps, onMounted } from 'vue'
import { useI18n } from 'vue-i18n'
import { useForm, Field, ErrorMessage } from 'vee-validate'
import { useRoute, useRouter } from 'vue-router'
import { defaultUserStatus } from '@/models/UserStatus/userStatus'
import { userstatusvalidationSchema } from '@/rules/UserStatus/userstatusValidation'
import { addUserStatus, editUserStatus, getUserStatus } from '@/services/UserStatus/nationalityService'

const { t } = useI18n()
const props = defineProps<{ formType: string }>()
const localFormType = ref(props.formType)
const validationSchema = userstatusvalidationSchema
const currentUserStatus = ref(defaultUserStatus)
const submitted = ref(false)
const router = useRouter()
const route = useRoute()
const userstatusId = ref(0)


userstatusId.value = (route.params?.id as unknown as number) ?? 0

const getCurrentUserStatus = async () => {
      if (userstatusId.value === 0) {
        currentUserStatus.value.name = ''
        return
      }
      const { userStatus } = await getUserStatus(userstatusId.value)
      currentUserStatus.value = userStatus != undefined ? userStatus : defaultUserStatus

    }

const { validate } = useForm({
  validationSchema,
  validateOnMount: false,
  initialValues:
        localFormType.value == 'Edit'
          ? {
            name: currentUserStatus?.value?.name ?? '',
          }
          : {
            name: '',
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
  const { success } = await addUserStatus(currentUserStatus.value)
  if (success) {
router.push({ name: 'userstatus' })  }
}

const onSubmitEdit = async () => {
      const userstatusData = currentUserStatus.value
      const { success } = await editUserStatus(userstatusData)
      if (success) {
        router.push({ path: '/userstatus' })
      }
    }
const handleFormSubmit = () => {
  onSubmit(localFormType.value)
}

onMounted(() => {
    getCurrentUserStatus()
  })
</script>
