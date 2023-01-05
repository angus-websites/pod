
<template>

    <PageContainer>
        <Breadcrumbs :pages="[{ name: 'Entries', href: route('entries.index'), current: false },{ name: entry.data.title, href: '#', current: true }]" />
        <p>Title: {{ entry.data.title }}</p>
        <p>Content</p>
        <textarea>
            {{ entry.data.content }}
        </textarea>
    </PageContainer>

</template>


<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import PageContainer from "@/Components/_util/PageContainer.vue";
import Breadcrumbs from "@/Components/_util/Breadcrumbs.vue";

export default {
    layout: AppLayout,
    components: {
        PageContainer,
        Breadcrumbs
    },
    props: {
        entry: Object
    }

}
</script>
