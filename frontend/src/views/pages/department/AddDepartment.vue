<template>
  <section class="contact_area section_gap">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="contact_info text-center mb-4">
            <h2>Departement Form</h2>
          </div>
          <DepartementForm :formType="'Add'"/>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import { useHead } from '@vueuse/head'
import { useI18n } from 'vue-i18n'
import { computed } from 'vue'
import DepartementForm from '@/components/departement/departementForm.vue'



const { t } = useI18n()
const pageTitle = computed(() => t('departement.add'))

useHead({
  title: pageTitle,
})
</script>



