<template>
    <div class="loading-screen" v-show="loading" v-bind:class="classes" v-bind:style="{ backgroundColor: bc }">
        <component v-if="customLoader" v-bind:is="customLoader"></component>
        <div v-else>
            <div class="loading-circle"></div>
            <p class="loading-text">{{ text }}</p>
        </div>
    </div>
</template>

<script lang="ts">
    import { defineComponent, computed } from 'vue';

    export default defineComponent({
        name: 'Loader',
        props: {
            loading: {
                type: Boolean,
                default: false,
            },
            text: {
                type: String,
                default: 'Loading',
            },
            dark: {
                type: Boolean,
                default: false,
            },
            classes: null,
            background: null,
            customLoader: null,
        },
        setup(props) {
            const bc = computed(() => {
                return props.background || (props.dark ? 'rgba(0,0,0,0.8)' : 'rgba(255,255,255,0.8)');
            });
            return {
                bc,
            };
        },
    });
</script>

<style scoped>
    .loading-screen {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        width: 100vw;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 300;
        flex-direction: column;
        user-select: none;
    }
    .loading-circle {
        width: 50px;
        height: 50px;
        border-radius: 100%;
        border: 2px solid transparent;
        border-left-color: #ababab;
        animation: circleanimation 0.45s linear infinite;
    }
    .loading-text {
        margin-top: 15px;
        color: #808080;
        font-size: 12px;
        text-align: center;
    }
    @keyframes circleanimation {
        from {
            transform: rotateZ(0deg);
        }
        to {
            transform: rotateZ(360deg);
        }
    }
</style>
