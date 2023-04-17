<template>
    <div v-if="answers.length > 0" class="-mx-4 mt-10 ring-1 ring-gray-300 sm:mx-0 sm:rounded-lg">
        <table class="table table-fixed min-w-full divide-y divide-gray-300">
            <thead>
                <tr>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">#</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">Answer</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(answer, a) in answers" :key="a" :class="a % 2 === 0 ? undefined : 'bg-gray-50'">

                    <td class="py-3.5 pl-4 pr-3 text-left text-sm text-gray-900 sm:pl-6">
                        {{ a }}
                    </td>
                    <td class="px-3 py-3.5 text-left text-sm text-gray-900 lg:table-cell">
                        {{ answer.answer }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div v-else>
        <p class="text-red-500">No answers</p>
    </div>
</template>
<script setup>

const props = defineProps({
    answers: Object,
})
</script>
