
<template>
    <Tiptap :content="content" />
</template>


<script>
import Tiptap from '@/Components/Tiptap.vue';
//import Editor from '@/Components/Editor.vue';
//import Tiny from '@/Components/Tiny.vue';

export default {
    components: {
        Tiptap
    },
    props: {
        content: String
    }
}
</script>
