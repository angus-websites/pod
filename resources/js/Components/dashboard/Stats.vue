<template>
    <div>
        <dl class="mt-5 flex flex-col md:flex-row justify-around gap-5">
            <div v-for="item in stats" :key="item.name" class="relative flex-1 overflow-hidden rounded-lg bg-white p-5 shadow">
                <dt>
                    <div class="absolute rounded-md bg-indigo-500 p-3">
                        <component :is="item.icon" class="h-6 w-6 text-white" aria-hidden="true" />
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-500">{{ item.name }}</p>
                </dt>
                <dd class="ml-16 flex items-baseline justify-between">
                    <div>
                        <p class="text-2xl font-semibold text-gray-900">{{ item.stat }}</p>
                    </div>

                    <!-- Rank -->
                    <div v-if="hasFeature('ranked')" class="flex align-baseline gap-x-2">
                        <span class="text-sm text-gray-500">Rank</span>
                        <span class="inline-flex items-center rounded bg-primary px-2 py-0.5 text-xs font-medium text-white">{{item.rank}}</span>
                    </div>

                </dd>
            </div>
        </dl>
    </div>
</template>

<script setup>
import { DocumentTextIcon, StarIcon, Bars3CenterLeftIcon } from '@heroicons/vue/24/outline'

const props = defineProps({
    features: Object,
    featureData: Object,
})

let stats = [{
    name: 'Number of entries',
    icon: DocumentTextIcon,
    rank: props.featureData['entry count']['rank'],
    stat: `${props.featureData['entry count']['data']} entries`}];

stats = [
    ...stats,
    ...(hasFeature("streaks") ? [{
        name: 'Streak',
        icon: StarIcon,
        stat: `${props.featureData['streak']['data']} days`,
        rank: props.featureData['streak']['rank'],
        }]
        : []),
    ...(hasFeature("total word count") ? [{name: 'Total word count',
        icon: Bars3CenterLeftIcon,
        rank: props.featureData['total word count']['rank'],
        stat: `${props.featureData['total word count']['data']} words` }] : [])
];


function hasFeature(feature){
    /**
     * Does the user have access
     * to this feature?
     */
    for (var i = 0; i < props.features.length; i++) {
        if (props.features[i].name == feature){
            return true;
        }
    }
}

</script>
