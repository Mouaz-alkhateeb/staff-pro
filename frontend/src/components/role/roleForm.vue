<template>
  <form class="row contact_form mb-5" @submit.prevent="handleFormSubmit">
    <!-- عنوان النموذج -->
    <div class="col-12 text-center mb-4">
      <h3>{{ localFormType === 'Edit' ? t('role.edit') : t('role.add') }}</h3>
    </div>

    <!-- حقل الاسم -->
    <div class="col-md-12 mb-3">
      <label for="name">{{ t('role.name') }}</label>
      <Field name="name" v-slot="{ field }">
        <input
          id="name"
          type="text"
          disabled
          class="form-control"
          :placeholder="t('role.name_placeholder')"
          v-bind="field"
          :value="currentRole.name"
          @input="(e) => currentRole.name = (e.currentTarget as HTMLInputElement).value"
        />
      </Field>
      <ErrorMessage name="name" v-slot="{ message }">
        <div class="text-danger">
          {{ message === 'validation.required' ? t('validation.required') : message }}
        </div>
      </ErrorMessage>
    </div>

    <!-- عرض مجموعات الصلاحيات -->
    <div class="col-12">
      <div
        v-for="(permissionGroup, mainIndex) in permissionGroupsHelper"
        :key="mainIndex"
        class="mb-4 p-3 border rounded bg-white shadow-sm"
      >
        <!-- عنوان المجموعة -->
        <div class="form-check mb-3">
          <input
            class="form-check-input"
            type="checkbox"
            :id="'group-' + permissionGroup.id"
            v-model="permissionGroup.checked"
            @input="toggleAll(mainIndex, permissionGroup.checked)"
          />
          <label class="form-check-label fw-bold" :for="'group-' + permissionGroup.id">
            {{ permissionGroup.display_name }}
          </label>
        </div>

        <!-- صلاحيات المجموعة -->
        <div class="row">
          <div
            v-for="(permission, index) in permissionGroup.permissions"
            :key="index"
            class="col-12 col-sm-6 col-md-4 col-lg-3 mb-2"
          >
            <div class="form-check">
              <input
                class="form-check-input"
                type="checkbox"
                :id="'perm-' + permission.id"
                v-model="permission.checked"
                @input="togglePermission(mainIndex, index)"
              />
              <label
                class="form-check-label text-break"
                :for="'perm-' + permission.id"
                style="word-break: break-word"
              >
                {{ permission.display_name }}
              </label>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12 text-end mt-4">
      <button type="submit" class="btn btn-primary">
        {{ localFormType === 'Edit' ? t('role.update') : t('role.add') }}
      </button>
    </div>
  </form>
</template>



<script setup lang="ts">
import { ref, defineProps, onMounted, reactive } from 'vue'
import { useI18n } from 'vue-i18n'
import { useForm, Field, ErrorMessage } from 'vee-validate'
import { useRoute, useRouter } from 'vue-router'
import { getRole, updateRolePermissions } from '@/services/Role/roleService'
import { defaultRole } from '@/models/Role/role'
import { defaultPermissionGroupSearchFilter, type PermissionGroup, type PermissionGroupHelper, type PermissionHelper } from '@/models/PermissionGroup/permissionGroup'
import { getPermissionGroupsList } from '@/services/PermissionGroup/permissionGroupService'



const { t } = useI18n()
const props = defineProps<{ formType: string }>()
const localFormType = ref(props.formType)
const currentRole= ref(defaultRole)
const submitted = ref(false)
const router = useRouter()
const route = useRoute()
const roleId = ref(0)
const permissionGroupsList = ref<PermissionGroup[]>([])
const searchFilter = ref(defaultPermissionGroupSearchFilter)
const permissionGroupsHelper = ref<PermissionGroupHelper[]>([])
const permissionGroupsHelperForEditing = ref<string[]>([])


roleId.value = (route.params?.id as unknown as number) ?? 0
const getCurrentRole = async () => {
  if (roleId.value > 0) {
    const { role } = await getRole(roleId.value)
    currentRole.value = role
  }
}

const getPermissionGroups = async () => {
  if (roleId.value > 0) {
    const { permission_groups } = await getPermissionGroupsList(searchFilter.value)
    permissionGroupsList.value = permission_groups
  }
}

 const initPermissionGroupHelper = async (isFirstCall: boolean = false) => {
      permissionGroupsHelper.value = []
      permissionGroupsList.value.forEach((permissionGroup) => {
        let allPermissionsChecked = true
        const permissionsHelper: PermissionHelper[] = []
        permissionGroup.permissions.forEach((permission) => {
          const permissionFinder = currentRole.value.permissions.find(
            (currentRolePermission) => currentRolePermission.id == permission.id
          )
          if (permissionFinder) {
            permissionsHelper.push(
              reactive({
                id: permission.id,
                display_name: permission.display_name,
                name: permission.name,
                checked: true,
              })
            )
            if (isFirstCall) {
              const permissionEditFinder = permissionGroupsHelperForEditing.value.find(
                (el) => el == permissionFinder.name
              )
              if (!permissionEditFinder)
                permissionGroupsHelperForEditing.value.push(permissionFinder.name)
            }
          } else {
            permissionsHelper.push(
              reactive({
                id: permission.id,
                display_name: permission.display_name,
                name: permission.name,
                checked: false,
              })
            )
            allPermissionsChecked = false
          }
        })
        permissionGroupsHelper.value.push(
          reactive({
            id: permissionGroup.id,
            name: permissionGroup.name,
            display_name: permissionGroup.display_name,
            permissions: permissionsHelper,
            checked: allPermissionsChecked,
          })
        )
      })
    }

      const togglePermission = (groupIndex: number, permissionIndex: number) => {
    const permission = permissionGroupsHelper.value[groupIndex].permissions[permissionIndex]
    permission.checked = !permission.checked

    const allChecked = permissionGroupsHelper.value[groupIndex].permissions.every(p => p.checked)
    permissionGroupsHelper.value[groupIndex].checked = allChecked
  }

  const toggleAll = (groupIndex: number, value: boolean) => {
    permissionGroupsHelper.value[groupIndex].permissions.forEach(permission => {
      permission.checked = value
    })

    permissionGroupsHelper.value[groupIndex].checked = value
  }

const { validate } = useForm({

  initialValues:
        localFormType.value == 'Edit'
          ? {
            name: currentRole?.value?.name ?? '',
          }
          : {
            name: '',
          },
})

const onSubmit = async (method: string) => {
  submitted.value = true
  const isValid = await validate()
  if (!isValid) return

  if (method === 'Edit') {
    await onSubmitEdit()
  }
}

const onSubmitEdit = async () => {
  const selectedPermissions: string[] = []

  permissionGroupsHelper.value.forEach(group => {
    group.permissions.forEach(permission => {
      if (permission.checked) {
        selectedPermissions.push(permission.name)
      }
    })
  })

  const { success } = await updateRolePermissions(
    roleId.value,
    selectedPermissions
  )

  if (success) {
    router.push({ path: `/role` })
  }
}

const handleFormSubmit = () => {
  onSubmit(localFormType.value)
}



 onMounted(async () => {
      await getCurrentRole()
      await getPermissionGroups()
      await initPermissionGroupHelper(true)
    })
</script>
