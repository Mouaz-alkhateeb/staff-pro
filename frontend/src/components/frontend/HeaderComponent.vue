<template>
   <header class="header_area ">
      <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
          <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <a class="navbar-brand logo_h" href="index.html"><img src="/frontend/img/logo.png" alt="" /></a>
            <button
              class="navbar-toggler"
              type="button"
              data-toggle="collapse"
              data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse offset " id="navbarSupportedContent">
              <ul class="nav navbar-nav menu_nav me-auto">
                <li class="nav-item active">
                  <router-link class="nav-link" :to="{ name: 'home' }">{{ t('home') }}</router-link>
                </li>

                <li class="nav-item active" v-if="!auth.isLoggedIn">
                  <router-link class="nav-link" :to="{ name: 'login' }">{{ t('auth.login_title') }}</router-link>
                </li>

                <li class="nav-item active" v-if="!auth.isLoggedIn">
                  <router-link class="nav-link" :to="{ name: 'register' }">{{ t('auth.register_title') }}</router-link>
                </li>

                <li class="nav-item" v-if="auth.isLoggedIn">
                  <router-link to="" class="nav-link">
                    {{ userName }}
                  </router-link>
                </li>

                <li class="nav-item active" v-if="auth.isLoggedIn">
                  <router-link to="" class="nav-link" @click="logoutUser">{{ t('auth.logout_title') }}</router-link>
                </li>

                <!-- Dropdown Menu (Bootstrap) -->
                <li class="nav-item dropdown" v-if="auth.isLoggedIn">
                  <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuButton" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ t('settings') }}
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li v-if="checkPermission(Permissions.CITY_LIST)"><router-link class="dropdown-item" :to="{ name: 'city' }">{{ t('cities') }}</router-link></li>
                    <li v-if="checkPermission(Permissions.DEPARTMENT_LIST)"><router-link class="dropdown-item" :to="{ name: 'department' }">{{ t('departements') }}</router-link></li>
                    <li v-if="checkPermission(Permissions.ROOM_LIST)"><router-link class="dropdown-item" :to="{ name: 'room' }">{{ t('rooms') }}</router-link></li>
                    <li v-if="checkPermission(Permissions.USER_STATUS_LIST)"><router-link class="dropdown-item" :to="{ name: 'userstatus' }">{{ t('userstatus') }}</router-link></li>
                    <li v-if="checkPermission(Permissions.NATIONALITY_LIST)"><router-link class="dropdown-item" :to="{ name: 'nationality' }">{{ t('nationality') }}</router-link></li>
                    <li ><router-link class="dropdown-item" :to="{ name: 'role' }">{{ t('roles') }}</router-link></li>
                    <li ><router-link class="dropdown-item" :to="{ name: 'user' }">{{ t('user') }}</router-link></li>
                  </ul>
                </li>

                <!-- Language selector -->
                <li class="nav-item language-selector" :style="{ position: 'relative', marginRight: locale === 'ar' ? '1rem' : '' }">
                  <div @click="toggleDropdown" class="nav-link" style="cursor: pointer;">
                    {{ t(`language.${locale}`) }}
                  </div>
                  <ul v-if="dropdownOpen" class="dropdown-menu-custom">
                    <li><a href="#" @click.prevent="changeLanguage('en')">{{ t('language.english') }}</a></li>
                    <li><a href="#" @click.prevent="changeLanguage('ar')">{{ t('language.arabic') }}</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </header>
</template>

<script setup lang="ts">
import { ref, computed, watch } from 'vue'
import { useI18n } from 'vue-i18n'
import { useStorage } from '@vueuse/core'
import { useAuth } from '@/stores/User/authStore'
import { useRouter } from 'vue-router'
import { checkPermission } from '@/composable/checkPermission'
import { Permissions } from '@/utils/consts/rolesPermissions'

const { t, locale } = useI18n()
const defaultLocale = useStorage('locale', 'en')
locale.value = defaultLocale.value
document.dir = locale.value === 'ar' ? 'rtl' : 'ltr'
document.documentElement.lang = locale.value

watch(locale, (newLocale) => {
  defaultLocale.value = newLocale
  document.dir = newLocale === 'ar' ? 'rtl' : 'ltr'
  document.documentElement.lang = newLocale
})

const dropdownOpen = ref(false)
const toggleDropdown = () => {
  dropdownOpen.value = !dropdownOpen.value
}
const changeLanguage = (lang: string) => {
  locale.value = lang
  dropdownOpen.value = false
}

const auth = useAuth()
const userName = computed(() => auth.getUserFulLName())
const router = useRouter()
const logoutUser = async () => {
  try {
    await auth.logoutUser()
    await router.push({ name: 'login' })
  // eslint-disable-next-line @typescript-eslint/no-explicit-any
  } catch (err: any) {
    throw err
  }
}
</script>


<style scoped>
.dropdown-menu-custom {
  position: absolute;
  top: 100%;
  left: 0;
  background: white;
  border: 1px solid #ddd;
  z-index: 1000;
  padding: 0;
  margin: 0;
  list-style: none;
  min-width: 120px;
}
.dropdown-menu-custom li a {
  display: block;
  padding: 8px 12px;
  text-decoration: none;
  color: #333;
}
.dropdown-menu-custom li a:hover {
  background-color: #f0f0f0;
}

</style>



