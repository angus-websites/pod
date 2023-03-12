<template>
    <div>
        <Editor 
        :initial-value="modelValue"
        @selectionChange="handlerFunction"
        api-key="ljfuynz3a61fqanmksvqwvil07uc83jbc1ntm6pk31w1n78g" 
        :init="{
            height: 500,
            menubar: false,
            plugins: [
            'autolink lists link wordcount'
            ],
        }"
        />
    </div>
</template>

<script>
import Editor from '@tinymce/tinymce-vue'
export default {
    name: "TemplateRaw",
    props: ['field', 'modelValue'],
    components: {
        Editor
    },
    emits: ['update:modelValue'],
    methods: {
        handlerFunction: function(event, editor){
            // This ensures the two way v-model works
            this.$emit("update:modelValue", editor.getContent())
        },
    },
    computed: {
        baseClasses(){
            return "block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm";
        }

    }
}


</script>

