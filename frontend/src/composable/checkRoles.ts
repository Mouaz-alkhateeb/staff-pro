export function checkRoles(userRole: string, allowedRoles: string[]): boolean {
  if (allowedRoles === undefined || allowedRoles.length === 0) {
    return false
  }

  // test if only has All role
  const hasAllRoles = allowedRoles.filter((element) => element === 'All').length === 1

  if (hasAllRoles) return true

  return checkStringExistsInArray(userRole, allowedRoles)
}

function checkStringExistsInArray(str: string, arr: string[]): boolean {
  return arr.includes(str)
}
