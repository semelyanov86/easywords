export interface WordInterface {
    id: number;
    original: string;
    translated: string;
    done_at: string | null;
    starred: boolean;
    user_id: number;
    language: string;
    views: number;
    created_at: string;
    from_sample: boolean;
    shared_by: number | null;
}
