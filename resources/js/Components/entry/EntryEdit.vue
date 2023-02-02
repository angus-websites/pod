
<template>
    <form @submit.prevent="submitForm">
        <div class="flex flex-col space-y-5">

                <div class="flex flex-col md:flex-row md:space-x-8 space-y-5 md:space-y-0">


                    <!-- Title input -->
                    <div class="flex-1">
                        <label for="email" class="block text-sm font-medium text-gray-700">Title</label>
                        <div class="mt-1">
                          <input v-model.lazy="form.title" type="text" required name="title" id="title" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Just a normal day" />
                        </div>
                    </div>

                    <!-- Date -->
                    <div class="flex-1">
                        <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                        <div class="mt-1">
                          <input v-model.lazy="form.date" required type="date" name="date" id="date" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="01/01/2023" />
                        </div>
                    </div>
                </div>

                <!-- Entry content -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700">Entry content</label>
                    <div class="mt-1">
                      <textarea v-model.lazy="form.content" required rows="4" name="content" id="content" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                      </textarea>
                    </div>
                </div>

                <!-- Save button -->
                <div class="mt-5">
                    <PrimaryButton type="submit" :disabled="form.processing">Save</PrimaryButton>
                </div>
        </div>
    </form>

</template>


<script setup>
import PrimaryButton from "@/Components/buttons/PrimaryButton.vue";
import {useForm} from '@inertiajs/inertia-vue3';

const props = defineProps({
    entry: {
        type: Object,
    },
    create: {
        type: Boolean,
        default: false
    }
});

const form = useForm({
    title: props.entry.title,
    date: props.entry.date,
    content: props.entry.content,
})

function submitForm(){
    /**
     * Submit the form
     * and update the entry
     */
    if (props.create){
        console.log("Storing new entry")
        form.post(route('entries.store'))
    }else{
        form.put(route('entries.update', props.entry.id))
    }


}
</script>
