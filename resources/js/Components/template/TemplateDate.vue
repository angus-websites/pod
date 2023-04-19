<template>
    <input
    :value="newValue"
    @input="$emit('update:modelValue', $event.target.value)"
    type="date" :name="field.id" :id="field.id" :class="baseClasses" :required="field.required">
</template>

<script>
export default {
    name: "TemplateDate",
    props: ['field', 'modelValue'],
    emits: ['update:modelValue'],
    created() {
        if (!this.$props.modelValue){
            const today = new Date().toISOString().slice(0,10)
            this.$props.modelValue = today
            this.$emit('update:modelValue', today)
        }
    },
    computed: {
        baseClasses(){
            return "block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm";
        },
        newValue()
        {

            return this.modelValue ? this.modelValue : new Date().toISOString().slice(0,10);
        }

    }
}


</script>

