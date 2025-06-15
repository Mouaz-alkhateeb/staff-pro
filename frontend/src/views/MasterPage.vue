<template>
  <!--================ Start Header Area =================-->
  <HeaderComponent v-if="showLayout" />
  <!--================ End Header Area =================-->

  <router-view></router-view>

  <!--================Footer Area =================-->
  <FooterComponent v-if="showLayout" />
  <!--================End Footer Area =================-->
</template>

<script setup lang="ts">
import { useRoute } from 'vue-router'
import { computed } from 'vue'

import HeaderComponent from '@/components/frontend/HeaderComponent.vue'
import FooterComponent from '@/components/frontend/FooterComponent.vue'

const route = useRoute()

const hideLayoutRoutes = ['no-permission']

const showLayout = computed(() => {
  return !hideLayoutRoutes.includes(route.name as string)
})
</script>
