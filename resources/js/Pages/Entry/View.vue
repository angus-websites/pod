
<template>

    <PageContainer>
        <EntryHeader :title="entry.data.title" :date="entry.data.date" :showEditButton="showEditButton" @showEditButton="handleEditButtonClicked" />
        <hr class="my-5">
        <!-- Dynamic view for edit or view -->
        <component :is="currentView" v-bind="currentProperties"></component>
        <tiptap />

    </PageContainer>

</template>


<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import PageContainer from "@/Components/_util/PageContainer.vue";
import Breadcrumbs from "@/Components/_util/Breadcrumbs.vue";
import EntryHeader from "@/Components/entry/EntryHeader.vue";
import Tiptap from '@/Components/Tiptap.vue';
import EntryView from '@/Components/entry/EntryView.vue';
import EntryEdit from '@/Components/entry/EntryEdit.vue';

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
            showEditButton: true,
            currentView: EntryView
        }
    },
    computed: {
      currentProperties: function() {
        return { "content":  this.entry.data.content}
      }
    },
    methods: {
        handleEditButtonClicked(s){
            /**
             * This is called when the header
             * edit / save button is clicked
             */
            this.showEditButton = s;

            // Change the view depending on the button
            if (s === false){
                this.currentView = EntryEdit;
            }else{
                this.currentView = EntryView;
            }
        }
    }

}
</script>
