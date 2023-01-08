
<template>
    <Editor />
</template>


<script>
//import Tiptap from '@/Components/Tiptap.vue';
import Editor from '@/Components/Editor.vue';

export default {
    components: {
        Editor
    },
    props: {
        content: String
    }
}
</script>
