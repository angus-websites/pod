<template>
  <div class="lg:flex lg:items-center lg:justify-between">
    <div class="min-w-0 flex-1">
      <EntryBreadcrumbs :title="title" />
      <Heading1>{{title}}</Heading1>
    </div>
  </div>
</template>

<script setup>
import EntryBreadcrumbs from "@/Components/entry/EntryBreadcrumbs.vue";
import Heading1 from "@/Components/headings/Heading1.vue";
const props = defineProps({
    title: {
        type: String,
    }
})

</script>
