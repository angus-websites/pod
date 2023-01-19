
<template>
    <article class="prose prose-zinc" v-html="entry.content">
    </article>
</template>


<script>
export default {
    props: {
        entry: Object
    }
}
</script>
