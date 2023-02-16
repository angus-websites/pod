<template>
  <div class="lg:flex lg:items-center lg:justify-between">
    <div class="min-w-0 flex-1">
      <EntryBreadcrumbs title="New Entry" />
      <Heading1>New Entry</Heading1>
      <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">
        <div class="mt-2 flex items-center text-sm text-gray-500">
            Select a template and enter the details for this new entry
        </div>
      </div>
    </div>
    <div class="mt-5 flex lg:mt-0 lg:ml-4">
    </div>
  </div>
</template>

<script setup>
import EntryBreadcrumbs from "@/Components/entry/EntryBreadcrumbs.vue";
import Heading1 from "@/Components/headings/Heading1.vue";

</script>
