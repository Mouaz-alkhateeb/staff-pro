<template>
  <section class="contact_area section_gap">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="contact_info text-center mb-4">
            <h2>{{ t('auth.login_title') }}</h2>
            <p>{{ t('auth.welcome_back') }}</p>
          </div>

          <form class="row contact_form" @submit.prevent="onSubmit">
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
                <span>{{ t('auth.login_title') }}</span>
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
import { useAuth } from '@/stores/User/authStore'
import { signIn } from '@/composable/User/auth/signIn'
import { useI18n } from 'vue-i18n'
import { defaultSignInRequest } from '@/models/User/user'
import { computed } from 'vue'

import { useForm } from 'vee-validate'
import { z as zod } from 'zod'
import { ref } from 'vue'

const router = useRouter()
const { t } = useI18n()

const pageTitle = computed(() => t('auth.login_title'))

useHead({
  title: pageTitle,
})


const userAuth = useAuth()
const signRequest = ref(defaultSignInRequest)
const submitted = ref(false)

const validationSchema = zod.object({
  first_name: zod
    .string({ required_error: t('auth.errors.name.required') })
    .min(1, t('auth.errors.name.required')),
  password: zod
    .string({ required_error: t('auth.errors.password.required') })
    .min(8, t('auth.errors.password.length')),
})

const { setErrors, errors } = useForm()

const onSubmit = async () => {
  submitted.value = true

  const result = validationSchema.safeParse(signRequest.value)

  if (!result.success) {
    const fieldErrors = result.error.flatten().fieldErrors

    setErrors({
      first_name: fieldErrors.first_name?.[0] || '',
      password: fieldErrors.password?.[0] || ''
    })

    return
  }

  try {
    await signIn(signRequest.value)

    if (userAuth.isLoggedIn) {
      router.push({ name: 'home' })
    }
  // eslint-disable-next-line @typescript-eslint/no-explicit-any
  } catch (err: any) {
    if (err?.response?.status === 401) {
      setErrors({
        first_name: t('auth.errors.name.invalid'),
        password: t('auth.errors.password.invalid'),
      })
    }
  }
}

</script>
