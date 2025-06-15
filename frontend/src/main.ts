/* eslint-disable vue/multi-word-component-names */
import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import { createHead } from '@vueuse/head'
import i18n from './i18n'
import { Field, ErrorMessage } from 'vee-validate'

import App from './App.vue'
import router from './router'

const app = createApp(App)
const head = createHead()

app.use(createPinia())
app.use(router)
app.use(head)
app.use(i18n)

app.component('Field', Field)
app.component('ErrorMessage', ErrorMessage)

app.mount('#app')
