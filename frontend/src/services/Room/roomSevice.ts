import {
  defaultRoom,
  type CreateUpdateRoom,
  type Room,
  type RoomSearchFilter,
} from '@/models/Room/room'
import { useRoom } from '@/stores/Room/roomStore'
import type { Pagination } from '@/utils/response'

export async function addRoom(roomData: CreateUpdateRoom) {
  const roomResponse = useRoom()
  const room: Room = (await roomResponse.addRoomStore(roomData)) ?? defaultRoom
  const success: boolean = roomResponse.success ?? false
  const error_code: string = roomResponse.error_code ?? ''
  const message: string = roomResponse.message ?? ''
  return { success, error_code, message, room }
}
export async function deleteRoom(roomId: number) {
  const roomResponse = useRoom()
  await roomResponse.deleteRoomStore(roomId)
  const success: boolean = roomResponse.success ?? false
  const error_code: string = roomResponse.error_code ?? ''
  const message: string = roomResponse.message ?? ''
  return { success, error_code, message }
}

export async function editRoom(roomData: CreateUpdateRoom) {
  const roomResponse = useRoom()
  await roomResponse.editRoomStore(roomData)
  const success: boolean = roomResponse.success ?? false
  const error_code: string = roomResponse.error_code ?? ''
  const message: string = roomResponse.message ?? ''
  return { success, error_code, message }
}

export async function getRoom(roomId: number) {
  const roomResponse = useRoom()
  const room: Room = (await roomResponse.getRoomStore(roomId)) ?? defaultRoom
  const success: boolean = roomResponse.success ?? false
  const error_code: string = roomResponse.error_code ?? ''
  const message: string = roomResponse.message ?? ''
  return { success, error_code, message, room }
}

export async function getRoomsList(searchFilter: RoomSearchFilter) {
  const roomResponse = useRoom()
  await roomResponse.getRoomsStore(searchFilter)
  const rooms: Room[] = roomResponse.rooms
  const pagination: Pagination = roomResponse.pagination
  const success: boolean = roomResponse.success ?? false
  const error_code: string = roomResponse.error_code ?? ''
  const message: string = roomResponse.message ?? ''
  return { success, error_code, message, rooms, pagination }
}
