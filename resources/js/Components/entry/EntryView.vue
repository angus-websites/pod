
<template>

    <div class="flex flex-col space-y-5">
      <div v-for="item in entry.template.fields">
        <p v-if="entry.data[item.id]"><u>{{item.label}}:</u> {{entry.data[item.id]}}</p>
        <br>
      </div>
    </div>
</template>


<script setup>
import {
  CalendarIcon,
} from '@heroicons/vue/20/solid'

const props = defineProps({
    entry: {
        type: Object,
    }
})
</script>
