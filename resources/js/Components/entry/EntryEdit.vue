
<template>
    <textarea>
        {{ content }}
    </textarea>
    <tiptap />

</template>


<script>
import Tiptap from '@/Components/Tiptap.vue';

export default {
    components: {
        Tiptap
    },
    props: {
        content: String
    }
}
</script>
