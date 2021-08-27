<template>
    <w-flex column justify-center>
        <w-card title="Login in easyword!" class="mx10">
            <w-form v-model="valid">
                <w-input
                    label="First name"
                    :validators="[validators.required]">
                </w-input>

                <w-input
                    class="mt3"
                    label="Last name"
                    :validators="[validators.required]">
                </w-input>

                <div class="text-right mt6">
                    <strong>v-model:</strong>
                    <code class="ml2 mr4">
                        {{ valid === false ? 'false' : valid || 'null' }}
                    </code>
                    <w-button type="submit" :disabled="valid === false">
                        Validate
                    </w-button>
                </div>
            </w-form>
        </w-card>
    </w-flex>
</template>

<script lang="ts">
import {defineComponent, reactive, computed, onMounted} from "vue";
import {ValidatorInterface} from "@/models/forms/ValidatorInterface";

export default defineComponent({
    name: "Login",
    setup() {
        let valid = null;
        let validators:ValidatorInterface = {
            required: value => !!value || 'This field is required'
        }
        return {
            valid, validators
        }
    }
})
</script>

<style scoped>

</style>
