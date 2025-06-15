<script setup lang="ts">
import { useHead } from '@vueuse/head'
import { useI18n } from 'vue-i18n'

const { t } = useI18n()
useHead({
  title: t('auth.no_permission.title'),
})
</script>

<template>
    <div class="error-wrapper">
      <div class="error-inner has-text-centered " >
        <div class="bg-number dark-inverted">402</div>
        <img class="light-image" src="../../../assets/error-5.svg" alt="" />

        <h3 class="dark-inverted">
          {{ t('auth.no_permission.you_have_no_permission') }}
        </h3>
        <p>
          {{ t('auth.no_permission.content') }}
        </p>
      <div class="button-wrap">
  <button class="btn-primary" @click="$router.go(-1)">
    {{ t('auth.no_permission.back_to_previous_page') }}
  </button>
</div>

      </div>
    </div>

</template>

<style >
.error-inner {
  position: relative;
  max-width: 540px;
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  min-height: 80vh;
  text-align: center;
  padding: 20px;


  .bg-number {
    font-family: var(--font);
    position: absolute;
    top: -110px;
    left: -80px;
    margin: 0 auto;
    font-size: 28rem;
    font-weight: 600;
    opacity: 0.15;
    z-index: 0;
  }

  img,
  svg,
  h3,
  p,
  .button-wrap {
    position: relative;
    z-index: 1;
  }

  img,
  svg {
    display: block;
    max-width: 100%;
    margin: 0 auto 24px;
  }

  h3 {
    font-size: 1.5rem;
    font-family: var(--font-alt);
    color: var(--dark-text);
    font-weight: 600;
    margin-top: 10px;
  }

  p {
    font-family: var(--font);
    font-size: 1.1rem;
    margin-bottom: 16px;
  }

  .button-wrap {
    .button {
      min-width: 220px;
      min-height: 50px;
    }
  }
}

.btn-primary {
  background-color: #56b786; /* لون أزرق جميل */
  color: white;
  padding: 12px 24px;
  font-size: 1rem;
  font-weight: 500;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  transition: background-color 0.3s ease, transform 0.2s ease;
}

.btn-primary:hover {
  background-color: #56b786;
  transform: translateY(-2px);
}

.btn-primary:active {
  background-color: #1e3a8a;
  transform: translateY(0);
}


</style>
