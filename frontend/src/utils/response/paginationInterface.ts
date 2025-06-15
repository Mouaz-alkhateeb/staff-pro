export interface Pagination {
  total: number
  count: number
  per_page: number
  page: number
  max_page: number
}
export const defaultPagination: Pagination = {
  total: 0,
  count: 0,
  per_page: 10,
  page: 1,
  max_page: 1,
}
