
<template>
    <form @submit.prevent="submitForm">
        <div class="flex flex-col space-y-5">

            <!-- Fields in template -->
            <div v-for="field in entry.template.fields">
                <label :for="field.id" class="block text-sm font-medium text-gray-700">{{field.label}}</label>
                <div class="mt-1">

                    <!-- Title-->
                    <input v-if="field.id == 'title'" v-model.lazy="form.title" type="text" :name="field.id" :id="field.id" :class="getInputClass('text')">

                    <input v-else-if="field.type == 'text'" v-model.lazy="form.content[field.id]" type="text" :name="field.id" :id="field.id" :class="getInputClass('text')">
                    <input v-else-if="field.type == 'date'" v-model.lazy="form.content[field.id]" type="date" :name="field.id" :id="field.id" :class="getInputClass('text')">
                    <textarea v-else-if="field.type == 'textarea'" v-model.lazy="form.content[field.id]" :name="field.id" :id="field.id" :class="getInputClass('textarea')"></textarea>


                </div>
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
import {useForm} from '@inertiajs/inertia-vue3';
import { toRef, toRefs } from 'vue'

const props = defineProps({
    entry: {
        type: Object,
    }
});

// Define emits so we can switch tabs after save
const emit = defineEmits(['tabToggle'])

// We use content instead of 'data' as it seems to be a keyword
const form = useForm({
    title: props.entry.title,
    content: props.entry.data,
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
    
    // Update
    form.put(route('entries.update', props.entry.id))

    // Switch tabs
    emit('tabToggle')

}
</script>
