/* eslint-disable prefer-const */
import { defaultFiles, MediaConsts, type Media } from '@/models/Media/media'
import {
  defaultUser,
  type ChangeUserStatus,
  type CreateUpdateUser,
  type User,
  type UserSearchFilter,
} from '@/models/User/user'
import { useFile } from '@/stores/User/fileStore'
import { useUser } from '@/stores/User/userStore'
import type { Pagination } from '@/utils/response'

export async function getFiles(user_id: number) {
  const fileResponse = useFile()
  let mediaParams = defaultFiles
  mediaParams.is_featured = '1'
  mediaParams.model_id = user_id
  let media: Media[] = (await fileResponse.getFilesStore(mediaParams)) ?? []
  media.forEach((element) => {
    element.file_name = element.relative_path
    element.relative_path = MediaConsts.MEDIA_BASE_URL + element.relative_path
  })
  let success: boolean = fileResponse.success ?? false
  let error_code: string = fileResponse.error_code ?? ''
  let message: string = fileResponse.message ?? ''
  return { success, error_code, message, media }
}

export async function addFile(user_id: unknown, fd: FormData) {
  const fileResponse = useFile()
  // const is_featured: unknown = false
  // fd.set('model_id', user_id as string)
  // fd.set('model_type', MediaConsts.USER_MODEL_ROUTE)
  // fd.set('is_featured', String(is_featured))
  let media: Media[] = (await fileResponse.addFileStore(fd)) ?? []
  let success: boolean = fileResponse.success ?? false
  let error_code: string = fileResponse.error_code ?? ''
  let message: string = fileResponse.message ?? ''
  return { success, error_code, message, media }
}

export async function deleteFile(file_id: number) {
  const fileResponse = useFile()
  await fileResponse.deleteFile(file_id)
  let success: boolean = fileResponse.success ?? false
  let error_code: string = fileResponse.error_code ?? ''
  let message: string = fileResponse.message ?? ''
  return { success, error_code, message }
}

export async function addUser(userData: CreateUpdateUser) {
  const userResponse = useUser()
  const user: User = (await userResponse.addUserStore(userData)) ?? defaultUser
  const success: boolean = userResponse.success ?? false
  const error_code: string = userResponse.error_code ?? ''
  const message: string = userResponse.message ?? ''
  return { success, error_code, message, user }
}
export async function getUser(userId: number) {
  const userResponse = useUser()
  const user: User = (await userResponse.getUserStore(userId)) ?? defaultUser
  const success: boolean = userResponse.success ?? false
  const error_code: string = userResponse.error_code ?? ''
  const message: string = userResponse.message ?? ''
  return { success, error_code, message, user }
}
export async function editUser(userData: CreateUpdateUser) {
  const userResponse = useUser()
  await userResponse.editUserStore(userData)
  const success: boolean = userResponse.success ?? false
  const error_code: string = userResponse.error_code ?? ''
  const message: string = userResponse.message ?? ''
  return { success, error_code, message }
}
export async function changeUserStatus(userData: ChangeUserStatus) {
  const userResponse = useUser()
  await userResponse.changeUserStatusStore(userData)
  const success: boolean = userResponse.success ?? false
  const error_code: string = userResponse.error_code ?? ''
  const message: string = userResponse.message ?? ''
  return { success, error_code, message }
}
export async function deleteUser(userId: number) {
  const userResponse = useUser()
  await userResponse.deleteUserStore(userId)
  const success: boolean = userResponse.success ?? false
  const error_code: string = userResponse.error_code ?? ''
  const message: string = userResponse.message ?? ''
  return { success, error_code, message }
}

export async function getUsersList(searchFilter: UserSearchFilter) {
  const userResponse = useUser()
  await userResponse.getUsersStore(searchFilter)
  const success: boolean = userResponse.success ?? false
  const error_code: string = userResponse.error_code ?? ''
  const message: string = userResponse.message ?? ''
  const users: User[] = userResponse.users
  const pagination: Pagination = userResponse.pagination

  return { success, error_code, message, users, pagination }
}
