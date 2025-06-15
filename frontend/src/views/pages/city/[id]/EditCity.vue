<template>
  <section class="contact_area section_gap">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="contact_info text-center mb-4">
            <h2>City Form</h2>
          </div>
          <CityForm :formType="'Edit'"/>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import CityForm from '@/components/city/CityForm.vue'
import { useHead } from '@vueuse/head'
import { useI18n } from 'vue-i18n'
import { computed } from 'vue'



const { t } = useI18n()
const pageTitle = computed(() => t('city.edit'))

useHead({
  title: pageTitle,
})
</script>



