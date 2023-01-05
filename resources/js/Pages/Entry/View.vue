
<template>

    <p v-if="entry">{{ entry.data.title }}</p>

    <PageContainer>
        Content
    </PageContainer>

</template>


<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import PageContainer from "@/Components/_util/PageContainer.vue";
export default {
    layout: AppLayout,
    components: {
        PageContainer
    },
    props: {
        entry: Object
    }

}
</script>
