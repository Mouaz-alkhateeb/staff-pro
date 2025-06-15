import type { CreateUpdateRoom, RoomSearchFilter } from '@/models/Room/room'
import type { CustomResponseCollection, CustomResponseSingle } from '@/utils/response'
import type { AxiosInstance } from 'axios'

export async function deleteRoomApi(
  api: AxiosInstance,
  roomId: number,
): Promise<{ response: CustomResponseCollection }> {
  const { data: response } = await api.delete(`room/${roomId}`)

  return { response }
}
export async function addRoomApi(
  api: AxiosInstance,
  room: CreateUpdateRoom,
): Promise<{ response: CustomResponseSingle }> {
  const { data: response } = await api.post(`room`, room)

  return { response }
}
export async function editRoomApi(
  api: AxiosInstance,
  room: CreateUpdateRoom,
): Promise<{ response: CustomResponseSingle }> {
  const { data: response } = await api.put(`room/${room.id}`, room)
  return { response }
}
export async function getRoomApi(
  api: AxiosInstance,
  roomId: number,
): Promise<{ response: CustomResponseSingle }> {
  const { data: response } = await api.get(`room/${roomId}`)

  return { response }
}
export async function getRoomsApi(
  api: AxiosInstance,
  searchFilter: RoomSearchFilter,
): Promise<{ response: CustomResponseCollection }> {
  const { data: response } = await api.get('room/getRoomList', {
    params: searchFilter,
  })
  return { response }
}
