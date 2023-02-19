<template>
    <input 
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
    type="text" :name="field_id" :id="field_id" :class="baseClasses">
</template>

<script>
export default {
    name: "TemplateText",
    props: ['field_id', 'modelValue'],
    emits: ['update:modelValue'],
    computed: {
        baseClasses(){
            return "block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm";
        }

    }
}


</script>

