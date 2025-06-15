import { BaseConsts } from '@/utils/consts/base'
import { type User } from './../User/user'

export interface Media {
  id?: number
  model_id: unknown
  model_type: string
  relative_path?: string
  is_featured?: string
  file_name?: string
  mime_type?: string
  size?: number
  created_at?: string
  uploaded_by?: User
}

class MediaConsts extends BaseConsts {
  static readonly MEDIA_BASE_URL = import.meta.env.VITE_MEDIA_BASE_URL

  static readonly USER_MODEL_ROUTE = 'App\\Domain\\Entity\\User'

  public static getMediaIcon(mime_type: string): string {
    if (mime_type.startsWith('image')) return '/images/icons/files/image.png'
    if (mime_type == 'text/csv') return '/images/icons/files/excel.png'
    if (
      mime_type == 'application/msword' ||
      mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
    )
      return '/images/icons/files/word.png'
    if (mime_type == 'application/pdf') return '/images/icons/files/pdf.png'
    if (mime_type == 'text/plain') return '/images/icons/files/txt.png'

    return '/images/icons/files/unknown.png'
  }

  public static getAvatarIcon(gender: string): string {
    if (gender === 'Male') return '/images/icons/avatar/man.png'
    if (gender === 'Female') return '/images/icons/avatar/woman.png'
    else return '/images/icons/avatar/not_selected.png'
  }
}

export const defaultFiles: Media = {
  id: undefined,
  model_id: 0,
  model_type: MediaConsts.USER_MODEL_ROUTE,
  relative_path: undefined,
  is_featured: '0',
  file_name: undefined,
  mime_type: undefined,
  size: undefined,
  created_at: undefined,
  uploaded_by: undefined,
}

export { MediaConsts }
