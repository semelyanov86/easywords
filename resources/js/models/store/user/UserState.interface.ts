import { UserInterface } from '@/models/user/user.interface'

/**
 * @name UserStateInterface
 * @description
 * Interface for the Settings state
 */
export interface UserStateInterface {
  loading: boolean
  user: UserInterface
}
