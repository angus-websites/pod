
<template>

    <PageContainer>
        <EntryHeader :title="entry.data.title" :date="entry.data.date" />
        <hr class="my-5">
        <textarea>
            {{ entry.data.content }}

        </textarea>
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
    }

}
</script>
