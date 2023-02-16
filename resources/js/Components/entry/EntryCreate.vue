
<template>
    <form @submit.prevent="submitForm">
        <div class="flex flex-col space-y-5">

            <!-- Fields in template -->
            <div v-for="field in template.fields">
                <label :for="field.id" class="block text-sm font-medium text-gray-700">{{field.label}}</label>
                <div class="mt-1">

                    <!-- Title-->
                    <input v-if="field.id == 'title'" v-model.lazy="form.content[field.id]" type="text" :name="field.id" :id="field.id" :class="getInputClass('text')">

                    <input v-else-if="field.type == 'text'" v-model.lazy="form.content[field.id]" type="text" :name="field.id" :id="field.id" :class="getInputClass('text')">
                    <input v-else-if="field.type == 'date'" v-model.lazy="form.content[field.id]" type="date" :name="field.id" :id="field.id" :class="getInputClass('text')">
                    <textarea v-else-if="field.type == 'textarea'" v-model.lazy="form.content[field.id]" :name="field.id" :id="field.id" :class="getInputClass('textarea')"></textarea>

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
import { toRef, toRefs, computed } from 'vue'

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

function getInputClass(type){
    if (type == "text"){
        return "block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
    }else if(type == "textarea"){
        return "block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
    }
}

function submitForm(){
    /**
     * Submit the form
     * and update the entry
     */
    
    // Only send the template id in the request
    form.transform((data) => ({
        ...data,
        template: data.template._id,
    })).post(route('entries.store'))


}
</script>
