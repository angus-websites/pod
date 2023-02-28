
<template>
    <form @submit.prevent="submitForm">
        <div class="flex flex-col space-y-5">

            <!-- Fields in template -->
            <div v-for="field in template.fields">
                <label :for="field.id" class="block text-sm font-medium text-gray-700">{{field.label}}</label>
                <div class="mt-1">
                    <component :is="TemplateInputs[field.type]" :key="field.id" :field="field" v-model.lazy="form.content[field.id]"></component>
                </div>
                <template v-if="$page.props.errors">
                    <p v-if="$page.props.errors[field.id]" class="mt-2 text-sm text-red-600" id="email-error">{{ $page.props.errors[field.id] }}</p>
                </template>
            </div>

            <!-- Save button -->
            <div class="mt-5">
                <PrimaryButton type="submit">Save</PrimaryButton>
            </div>
        </div>
    </form>
</template>

<script setup>
import PrimaryButton from "@/Components/buttons/PrimaryButton.vue";
import {useForm, usePage} from '@inertiajs/inertia-vue3';
import { toRef, toRefs, computed, resolveComponent, markRaw } from 'vue';

import TemplateText from "@/Components/template/TemplateText.vue";
import TemplateDate from "@/Components/template/TemplateDate.vue";
import TemplateTextarea from "@/Components/template/TemplateTextarea.vue";
import TemplateRaw from "@/Components/template/TemplateRaw.vue";


// Components
const TemplateInputs = {"text": TemplateText, "date": TemplateDate, "textarea": TemplateTextarea, "raw": TemplateRaw};

const props = defineProps({
    template: {
        type: Object
    }
});

// Define our template as a reactive prop
const template = toRef(props, 'template')

// Store the content for the form
const form_content = {};

// We use content instead of 'data' as it seems to be a keyword
const form = useForm({
    content: form_content,
    template: template,
})

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function submitForm(){
    /**
     * Submit the form
     * and update the entry
     */
    
    // Only send the template id in the request
    form.transform((data) => ({
        ...data,
        template: data.template.id,
    })).post(route('entries.store'))


}
</script>
