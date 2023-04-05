declare module '*.vue' {
    import { defineComponent } from 'vue';
    import 'vite/client';
    const component: ReturnType<typeof defineComponent>;
    export default component;
}

declare interface process {
    env: {
        VUE_APP_CONFIG: string;
    };
}
