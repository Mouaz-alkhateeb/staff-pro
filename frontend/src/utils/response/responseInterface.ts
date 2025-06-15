/* eslint-disable @typescript-eslint/no-explicit-any */
import { type Pagination } from './paginationInterface'
export interface CustomResponseCollection {
  success: boolean
  error_code: string
  message: string
  data: Array<any>
  pagination: Pagination
}
export interface CustomResponseSingle {
  success: boolean
  error_code: string
  message: string
  data: any
  pagination: Pagination
}
