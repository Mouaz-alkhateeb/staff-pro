<template>
  <section class="contact_area section_gap">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="contact_info text-center mb-4">
            <h2>{{ t('auth.register_title') }}</h2>
            <p>{{ t('auth.success_signUp') }}</p>
          </div>

          <form class="row contact_form" @submit.prevent="handleRegister">
            <div class="col-md-12">
              <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  v-model="signRequest.first_name"
                  :placeholder="t('auth.placeholder.first_name')"
                />
                <span class="text-danger" v-if="submitted && errors.first_name">{{ errors.first_name }}</span>
              </div>

              <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  v-model="signRequest.last_name"
                  :placeholder="t('auth.placeholder.last_name')"
                />
                <span class="text-danger" v-if="submitted && errors.last_name">{{ errors.last_name }}</span>
              </div>

              <div class="form-group">
                <input
                  type="tel"
                  class="form-control"
                  v-model="signRequest.phone_number"
                  :placeholder="t('auth.placeholder.phone_number')"
                />
                <span class="text-danger" v-if="submitted && errors.phone_number">{{ errors.phone_number }}</span>
              </div>

              <div class="form-group">
                <input
                  type="password"
                  class="form-control"
                  v-model="signRequest.password"
                  :placeholder="t('auth.placeholder.password')"
                />
                <span class="text-danger" v-if="submitted && errors.password">{{ errors.password }}</span>
              </div>
            </div>

            <div class="col-md-12 text-right mb-5">
              <button type="submit" class="primary_btn">
                <span>{{ t('auth.register_title') }}</span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import { useHead } from '@vueuse/head'
import { useRouter } from 'vue-router'
import { useI18n } from 'vue-i18n'
import { ref } from 'vue'
import { z as zod } from 'zod'
import { useForm } from 'vee-validate'
import { computed } from 'vue'
import { defaultSignUpRequest } from '@/models/User/user'
import { signUp } from '@/composable/User/auth/signUp'

const { t } = useI18n()
const pageTitle = computed(() => t('auth.register_title'))

useHead({
  title: pageTitle,
})

const router = useRouter()
const signRequest = ref(defaultSignUpRequest)
const submitted = ref(false)

const validationSchema = zod.object({
  first_name: zod.string().min(1, t('auth.errors.first_name.required')),
  last_name: zod.string().min(1, t('auth.errors.last_name.required')),
  phone_number: zod
    .string()
    .min(1, t('auth.errors.phone_number.required'))
    .regex(/^963\d{9}$/, t('auth.errors.phone_number.invalid')),
  password: zod.string().min(8, t('auth.errors.password.length'))
})

const { setErrors, errors } = useForm()

const handleRegister = async () => {
  submitted.value = true

  const result = validationSchema.safeParse(signRequest.value)

  if (!result.success) {
    const fieldErrors = result.error.flatten().fieldErrors

    setErrors({
      first_name: fieldErrors.first_name?.[0] || '',
      last_name: fieldErrors.last_name?.[0] || '',
      phone_number: fieldErrors.phone_number?.[0] || '',
      password: fieldErrors.password?.[0] || ''
    })

    return
  }

  await signUp(signRequest.value)
  router.push({ name: 'login' })
}
</script>
