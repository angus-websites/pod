
<template>

    <PageContainer>
        <EntryHeader :title="entry.data.title" :date="entry.data.date" :showEditButton="showEditButton" @showEditButton="handleEditButtonClicked" />
        <hr class="my-5">
        <!-- Dynamic view for edit or view -->
        <component :is="currentView" v-bind="currentProperties"></component>

    </PageContainer>

</template>


<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import PageContainer from "@/Components/_util/PageContainer.vue";
import Breadcrumbs from "@/Components/_util/Breadcrumbs.vue";
import EntryHeader from "@/Components/entry/EntryHeader.vue";
import EntryView from '@/Components/entry/EntryView.vue';
import EntryEdit from '@/Components/entry/EntryEdit.vue';
import { markRaw } from "vue";

export default {
    layout: AppLayout,
    components: {
        PageContainer,
        Breadcrumbs,
        EntryHeader,
    },
    props: {
        entry: Object
    },
    data() {
        let readView = markRaw(EntryView);
        return {
            showEditButton: true,
            editView: markRaw(EntryEdit),
            readView: readView,
            currentView: readView,

        }
    },
    computed: {
      currentProperties: function() {
        return { "entry":  this.entry.data}
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
                this.currentView = this.editView;
            }else{
                this.currentView = this.readView;
            }
        }
    }

}

</script>
