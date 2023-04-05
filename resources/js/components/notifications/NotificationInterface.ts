import { NotifyTypes } from './NotifyTypes';

export interface NotificationInterface {
    title: string;
    message: string;
    type: NotifyTypes;
}
