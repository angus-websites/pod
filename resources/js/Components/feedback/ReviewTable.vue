<template>
    <div v-if="answers.length > 0" class="-mx-4 mt-10 ring-1 ring-gray-300 sm:mx-0 sm:rounded-lg overflow-auto">
        <table class="table table-fixed min-w-full divide-y divide-gray-300">
            <thead>
                <tr>
                    <th scope="col" class="py-3.5 w-2/12 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">#</th>
                    <th scope="col" class="px-3 w-8/12 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">Answer</th>
                    <th scope="col" class="px-3 w-2/12 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">Count</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(count, answer, a) in uniqueAnswers()" :key="a">

                    <td class="py-3.5 pl-4 pr-3 text-left text-sm text-gray-900 sm:pl-6">
                        {{ a + 1 }}
                    </td>
                    <td class="px-3 py-3.5 text-left text-sm text-gray-900">
                        <p class="line-clamp-6">{{ answer }}</p>
                    </td>
                    <td class="px-3 py-3.5 text-left text-sm text-gray-900">
                        <p class="line-clamp-6">{{ count }}</p>
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

function uniqueAnswers(){
    const counts = {};
    for (const answer of props.answers) {
        counts[answer.answer] = counts[answer.answer] ? counts[answer.answer] + 1 : 1;
    }
    return counts
}
</script>
