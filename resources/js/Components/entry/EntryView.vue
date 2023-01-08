
<template>
    <article class="prose prose-zinc" v-html="content">
    </article>
</template>


<script>
export default {
    props: {
        content: String
    }
}
</script>
