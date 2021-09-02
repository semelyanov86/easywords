import {WordInterface} from "../words/Word.interface";

export interface StatisticsDataInterface {
    all: number,
    starred:number,
    not_dones:number,
    dones:number,
    total_views:number,
    users_count:number,
    updated_this_month:number,
    updated_today:number,
    most_viewed:WordInterface[],
    added_today:WordInterface[]
}
