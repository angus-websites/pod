<template>
    <textarea
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        :name="field_id" :id="field_id" :class="baseClasses"></textarea>

</template>

<script>
export default {
    name: "TemplateTextarea",
    props: ['field_id', 'modelValue'],
    emits: ['update:modelValue'],
    computed: {
        baseClasses(){
            return "block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm";
        }

    }
}


</script>

