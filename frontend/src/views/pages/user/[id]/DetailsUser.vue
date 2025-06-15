<template>
   <section class="contact_area section_gap">
      <div class="container my-5">
          <div class="row gy-3">
            <div
              class="col-md-6"
              v-for="(file, index) in userFiles"
              :key="file.id ?? index"
            >
              <div class="d-flex align-items-start p-3 border rounded shadow-sm bg-white">
                <img
                  :src="MediaConsts.getMediaIcon(file.mime_type ?? '')"
                  alt="file icon"
                  class="me-3"
                  style="width: 48px; height: 48px; object-fit: contain;"
                />

                <div class="flex-grow-1">
                  <a
                    class="text-primary fw-semibold text-decoration-none d-block"
                    :href="file.relative_path"
                    target="_blank"
                  >
                    {{ file.file_name ?? 'File ' + (index + 1) }}
                  </a>
                  <small class="text-muted d-block mt-1">
                    {{ file.mime_type ?? 'Unknown type' }} |
                    {{
                      file.size !== undefined
                        ? (file.size / (1024 * 1024)).toFixed(2) + ' ' + t('images.megabyte')
                        : t('images.unknown_size')
                    }}
                  </small>
                  <small class="text-muted d-block mt-1">
                    {{ file.created_at }} • {{ t('images.by') }}
                    {{ file.uploaded_by?.first_name }} {{ file.uploaded_by?.last_name }}
                  </small>
                </div>

                <button
                  v-if="file.id"
                  class="btn btn-sm btn-danger ms-2 mt-1"
                  @click="onDeleteFile(file.id )"
                >
                  🗑
                </button>
              </div>
            </div>
          </div>
      </div>
      <div class="container mt-4">
      <h5 class="mb-3">{{ t('user.files_add') }}</h5>
      <div class="d-flex align-items-center flex-wrap gap-2 mb-4">
        <div class="file">
          <label class="btn btn-outline-primary">
            <input type="file" class="d-none" @change="onAddFile" />
            <i class="fas fa-upload" style="margin-inline-end: 0.25rem;"></i> {{ t('images.image_name_placeholder') }}
          </label>
          <span class="ms-3 small text-muted">
            {{ filesToUpload?.name ?? t('images.image_select_file') }}
          </span>
        </div>

        <button
          class="btn btn-success"
          :disabled="!filesToUpload || uploadLoading"
          @click="uploadFile"
        >
          <span v-if="uploadLoading" class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
          {{ t('contractor.details.upload') }}
        </button>
      </div>
      <p class="text-muted small">{{ t('images.accepted_file') }}</p>
</div>
   </section>
<div class="modal fade" id="deleteFileModal" tabindex="-1" aria-labelledby="deleteFileModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteFileModalLabel">تأكيد الحذف</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
      </div>
      <div class="modal-body">
        هل أنت متأكد أنك تريد حذف الملف "<strong>{{ fileToDelete?.file_name }}</strong>"؟
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
        <button type="button" class="btn btn-danger" @click="confirmDelete">حذف</button>
      </div>
    </div>
  </div>
</div>
</template>

<script setup lang="ts">
import { useHead } from '@vueuse/head'
import { useI18n } from 'vue-i18n'
import { computed, onMounted, ref } from 'vue'
import { useRoute } from 'vue-router'
import { addFile, deleteFile, getFiles } from '@/services/User/UserService'
import { MediaConsts, type Media } from '@/models/Media/media'
import { Modal } from 'bootstrap'


const { t } = useI18n()
const pageTitle = computed(() => t('user.files'))
const route = useRoute()
const userId = ref(0)
const userFiles = ref<Array<Media>>([])
const fileToDelete = ref<Media | null>(null)
let modalInstance: Modal
const filesToUpload = ref<File | undefined>(undefined)
const uploadLoading = ref(false)

userId.value = (route.params?.id as unknown as number) ?? 0


const fetchUserFiles = async () => {
  const { media } = await getFiles(userId.value)
  if (media.length != 0) {
    media.forEach((mediaElemnt) => {
      userFiles.value.push(mediaElemnt)
    })
  }
}

const onDeleteFile = (file_id: number) => {
  if (!file_id) return
  const file = userFiles.value.find((c) => c.id === file_id)
  if (file) {
    fileToDelete.value = file
    modalInstance?.show()
  }
}
const confirmDelete = async () => {
  if (!fileToDelete.value || typeof fileToDelete.value.id !== 'number') return

  const id = fileToDelete.value.id

  try {
    const { success } = await deleteFile(id)

    if (success) {
      const index = userFiles.value.findIndex((file) => file.id === id)
      if (index !== -1) {
        userFiles.value.splice(index, 1)
      }
    }
  } catch (error) {
    console.error('خطأ أثناء الحذف:', error)
  } finally {
    modalInstance?.hide()
    fileToDelete.value = null
  }
}

const onAddFile = async (event: Event) => {
  const input = event.target as HTMLInputElement
  const file = input.files?.[0]
  if (!file) return

  if (
    file.type !== 'image/jpeg' &&
    file.type !== 'image/png' &&
    file.type !== 'image/webp' &&
    file.type !== 'application/pdf'
  ) {
    return
  }

  if (file.size > 2 * 1024 * 1024) {
    return
  }

  filesToUpload.value = file
}

const uploadFile = async () => {
  if (!filesToUpload.value) return

  uploadLoading.value = true

console.log(filesToUpload)

  const formData = new FormData()
   formData.append('images[]', filesToUpload.value)

  formData.set('model_id', userId.value.toString())
  formData.set('model_type', MediaConsts.USER_MODEL_ROUTE)
  formData.set('is_featured', 'true')

  const { success,  media } = await addFile(userId.value, formData)

  if (success && media.length > 0) {
    media[0].file_name = media[0].relative_path
    media[0].relative_path = import.meta.env.VITE_MEDIA_BASE_URL + media[0].relative_path
    userFiles.value.unshift(media[0])
    filesToUpload.value = undefined
  }

  uploadLoading.value = false
}
useHead({
  title: pageTitle,
})

onMounted(async () => {
  fetchUserFiles()
  const modalElement = document.getElementById('deleteFileModal')
    if (modalElement) {
      modalInstance = new Modal(modalElement)
    }
})
</script>

