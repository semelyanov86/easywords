import router from "../../router";
import axios from "axios";
import {AxiosError} from "axios";
import {notify} from "../../components/notifications";
import {NotifyTypes} from "../../components/notifications/NotifyTypes";

export function ErrorHandler(error: Error | AxiosError) {
    let message:string;
    if (axios.isAxiosError(error))  {
        if (error.response) {
            /*
             * The request was made and the server responded with a
             * status code that falls out of the range of 2xx
             */
            message = error.response.data.message;
            if (error.response.status === 401) {
                router.push({name: 'Login'})
            }
        } else if (error.request) {
            /*
             * The request was made but no response was received, `error.request`
             * is an instance of XMLHttpRequest in the browser and an instance
             * of http.ClientRequest in Node.js
             */
            message = error.request;
        } else {
            // Something happened in setting up the request and triggered an Error
            message = 'Error: ' + error.message;
        }
    } else {
        message = 'Error: ' + error.message;
    }

    console.log(error);
    notify({
        title: 'Error in server request',
        message: message,
        type: NotifyTypes.danger
    })
}
