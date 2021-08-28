export interface UserInterface {
    id: number,
    name: string,
    email: string,
    email_verified_at: string|null,
    current_team_id: number|null,
    profile_photo_path: string|null,
    created_at: string,
    updated_at: string
}
