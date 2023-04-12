
<template>
    <form @submit.prevent="submitForm">
        <div class="flex flex-col space-y-5">

            <!-- Fields in template -->
            <div v-for="field in template.fields">
                <label :for="field.id" class="block text-sm font-medium text-gray-700">{{field.label}}</label>
                <div class="mt-2">
                    <component :is="TemplateInputs[field.type]" :key="field.id" :field="field" v-model.lazy="form.content[field.id]"></component>
                </div>
            </div>

            <!-- Save button -->
            <div class="flex justify-between mt-5">
                <PrimaryButton type="submit">Save</PrimaryButton>
                <DangerButton v-if="can.deleteEntry" @click="deleteEntry">Delete</DangerButton>
            </div>
        </div>
    </form>

</template>


<script setup>
import PrimaryButton from "@/Components/buttons/PrimaryButton.vue";
import DangerButton from "@/Components/buttons/DangerButton.vue";

import {useForm} from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia'
import { toRef, toRefs } from 'vue'

import TemplateText from "@/Components/template/TemplateText.vue";
import TemplateDate from "@/Components/template/TemplateDate.vue";
import TemplateTextarea from "@/Components/template/TemplateTextarea.vue";
import TemplateRaw from "@/Components/template/TemplateRaw.vue";



// Components
const TemplateInputs = {"text": TemplateText,"date": TemplateDate, "textarea": TemplateTextarea, "raw": TemplateRaw};

const props = defineProps({
    entry: {
        type: Object,
    },
    template: {
        type: Object
    },
    can: {
        type:  Object
    }
});

// Define emits so we can switch tabs after save
const emit = defineEmits(['tabToggle'])

// We use content instead of 'data' as it seems to be a keyword
const form = useForm("entryContent",{
    content: props.entry.data,
})

function deleteEntry(event){
    /**
     * Delete the entry
     */
    event.preventDefault();
    console.log("Deleted entry")

    if (confirm('Are you sure you want to delete this entry?')) {
      Inertia.delete(route("entries.destroy", props.entry.id))
    }
}

function submitForm(){
    /**
     * Submit the form
     * and update the entry
     */

    // Update
    form.put(route('entries.update', props.entry.id), {
        // If we succeed, switch tabs
        onSuccess: () => emit('tabToggle'),
    })

}
</script>
