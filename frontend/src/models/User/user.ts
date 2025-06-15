import { type Role } from './../../utils/consts/rolesPermissions'
import { type City, defaultCity } from './../City/city'
import { type UserStatus, defaultUserStatus } from './../UserStatus/userStatus'
import { defaultRoom, type Room } from './../Room/room'

export interface User {
  id?: number
  first_name: string
  last_name: string
  password: string
  gender: string
  birth_date?: string
  phone_number: string
  address: string
  city: City
  room: Room
  status: UserStatus
  roles?: Role[]
  token?: string
}
export const defaultUser: User = {
  id: 0,
  first_name: '',
  last_name: '',
  gender: '',
  birth_date: '',
  phone_number: '',
  address: '',
  city: defaultCity,
  status: defaultUserStatus,
  password: '',
  token: undefined,
  room: defaultRoom,
}
export interface SignInRequest {
  first_name?: string
  password?: string
}
export const defaultSignInRequest: SignInRequest = {
  first_name: undefined,
  password: undefined,
}
export interface SignUpRequest {
  first_name?: string
  last_name?: string
  password?: string
  phone_number?: string
}
export const defaultSignUpRequest: SignUpRequest = {
  first_name: undefined,
  last_name: undefined,
  password: undefined,
  phone_number: undefined,
}
export enum UserRole {
  ADMIN = 'Admin',
  USER = 'User',
}
export const UserRoles = {
  ADMIN: 'Admin',
  USER: 'User',
}
/////////////////////////////

export interface CreateUpdateUser {
  id?: number
  first_name: string
  last_name: string
  password: string
  gender?: string
  birth_date?: string
  phone_number: string
  address?: string
  city_id?: number
  room_id?: number
  user_status_id?: number
  roles: number[]
}
export interface ChangeUserStatus {
  id?: number
  user_status_id?: number
}
export interface UserSearchFilter {
  name?: string
  gender?: string
  phone_number?: string
  city_id?: number
  room_id?: number
  user_status_id?: number
  page?: number
  per_page?: number
  order_by?: string
  order?: string
}

export const defaultUserSearchFilter: UserSearchFilter = {
  name: undefined,
  gender: undefined,
  city_id: undefined,
  room_id: undefined,
  user_status_id: undefined,
  page: undefined,
  order: undefined,
  order_by: undefined,
  per_page: 10,
}
export const defaultCreateUpdateUser: CreateUpdateUser = {
  id: undefined,
  first_name: '',
  last_name: '',
  gender: undefined,
  birth_date: '',
  phone_number: '',
  address: '',
  city_id: undefined,
  room_id: undefined,
  user_status_id: undefined,
  password: '0000000000',
  roles: [],
}
export const defaultChangeStatusUser: ChangeUserStatus = {
  id: undefined,
  user_status_id: 0,
}
