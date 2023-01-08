
<template>

    <PageContainer>
    <EntryHeader :title="entry.data.title" :date="entry.data.date" :showEditButton="showEditButton" />
        <hr class="my-5">
        <article class="prose prose-zinc" v-html="entry.data.content">
        </article>
        <tiptap />

    </PageContainer>

</template>


<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import PageContainer from "@/Components/_util/PageContainer.vue";
import Breadcrumbs from "@/Components/_util/Breadcrumbs.vue";
import EntryHeader from "@/Components/entry/EntryHeader.vue";
import Tiptap from '@/Components/Tiptap.vue';

export default {
    layout: AppLayout,
    components: {
        PageContainer,
        Breadcrumbs,
        EntryHeader,
        Tiptap
    },
    props: {
        entry: Object
    },
    data() {
        return {
            showEditButton: false
        }
    }

}
</script>
