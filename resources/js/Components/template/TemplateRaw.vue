<template>
    <div>
        <Editor
        :initial-value="modelValue"
        @selectionChange="handlerFunction"
        api-key="ljfuynz3a61fqanmksvqwvil07uc83jbc1ntm6pk31w1n78g"
        :init="{
            branding: false,
            min_height: 300,
            height: 400,
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
    }
}


</script>

