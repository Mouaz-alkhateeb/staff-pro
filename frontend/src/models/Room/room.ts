import { BaseConsts } from '@/utils/consts/base'
import { type Department } from '../Department/department'

export interface Room {
  id?: number
  number: number
  floor: number
  department?: Department
  status: number
}

export interface CreateUpdateRoom {
  id?: number
  number: number
  floor: number
  department_id?: number
  status: number
}
export interface RoomSearchFilter {
  number?: number
  floor?: number
  department_id?: number
  status?: number
  page?: number
  per_page?: number
  order_by?: string
  order?: string
}
export const defaultRoom: Room = {
  id: 0,
  number: 0,
  floor: 0,
  department: undefined,
  status: 0,
}

export const defaultCreateUpdateRoom: CreateUpdateRoom = {
  id: 0,
  number: 0,
  floor: 0,
  department_id: undefined,
  status: 0,
}

export const defaultRoomSearchFilter: RoomSearchFilter = {
  number: undefined,
  floor: undefined,
  department_id: undefined,
  status: undefined,
  page: undefined,
  order: undefined,
  order_by: undefined,
  per_page: 10,
}
const RoomConsts = BaseConsts
export { RoomConsts }
