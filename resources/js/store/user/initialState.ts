import {UserStateInterface } from '@/models/store'

/**
 * @name initialUserState
 * @description
 * The User state instance with the initial default values
 */
export const initialUserState: UserStateInterface = {
    loading: false,
    user: {
        "id": 1,
        "name": "",
        "email": "",
        "email_verified_at": null,
        "current_team_id": null,
        "profile_photo_path": null,
        "created_at": "2021-08-26T05:57:00.000000Z",
        "updated_at": "2021-08-26T05:57:00.000000Z"
    }
}
