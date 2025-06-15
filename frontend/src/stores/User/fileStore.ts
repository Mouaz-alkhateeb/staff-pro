/* eslint-disable @typescript-eslint/no-explicit-any */
/* eslint-disable prefer-const */
import { useApi } from '@/composable/useApi'
import type { Media } from '@/models/Media/media'
import { deleteMediaApi, getMediaApi, uploadMediaApi } from '@/utils/api/Media/medias'
import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useFile = defineStore('file', () => {
  const api = useApi()
  const success = ref<boolean>()
  const error_code = ref<string>()
  const message = ref<string>()
  const loading = ref(false)

  async function getFilesStore(media: Media) {
    try {
      const response = await getMediaApi(api, media)
      let returnedMedia: Media[]
      returnedMedia = response.response.data
      success.value = response.response.success
      error_code.value = response.response.error_code
      message.value = response.response.message

      return returnedMedia
    } catch (error: any) {
      success.value = error?.response.data.success
      error_code.value = error?.response.data.error_code
      message.value = error?.response.data.message
    } finally {
      loading.value = false
    }
  }

  async function addFileStore(media: FormData) {
    try {
      const response = await uploadMediaApi(api, media)
      let returnedMedia: Media[]
      returnedMedia = response.response.data
      success.value = response.response.success
      error_code.value = response.response.error_code
      message.value = response.response.message

      return returnedMedia
    } catch (error: any) {
      success.value = error?.response.data.success
      error_code.value = error?.response.data.error_code
      message.value = error?.response.data.message
    }
  }

  async function deleteFile(picture_id: number) {
    try {
      const response = await deleteMediaApi(api, picture_id)
      success.value = response.response.success
      error_code.value = response.response.error_code
      message.value = response.response.message

      return response
    } catch (error: any) {
      success.value = error?.response.data.success
      error_code.value = error?.response.data.error_code
      message.value = error?.response.data.message
    } finally {
      loading.value = false
    }
  }

  return {
    success,
    error_code,
    message,
    getFilesStore,
    deleteFile,
    addFileStore,
  } as const
})
