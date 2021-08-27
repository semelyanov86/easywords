import { createToast } from 'mosha-vue-toastify';
import {NotificationInterface} from "./NotificationInterface";

export function notify(data:NotificationInterface) {
    createToast(data.message)
}
