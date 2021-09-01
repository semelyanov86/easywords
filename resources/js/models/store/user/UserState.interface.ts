import { UserInterface } from '@/models/user/user.interface'
import {ShortUserInterface} from "@/models/user/shortUser.interface";

/**
 * @name UserStateInterface
 * @description
 * Interface for the Settings state
 */
export interface UserStateInterface {
  loading: boolean
  user: UserInterface,
    usersList: ShortUserInterface[]
}
