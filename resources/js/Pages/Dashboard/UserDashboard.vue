<template>
    <DashboardLayout>
        <div class="my-10">
            <dl class="mt-5 justify-around flex flex-col sm:flex-row gap-y-16 sm:gap-y-0">
                <div v-for="stat in stats" class="mx-auto flex max-w-xs flex-col gap-y-4 text-center">
                    <dt class="text-base leading-7 text-gray-600">{{ stat.name }}</dt>
                    <dd class="text-3xl font-semibold tracking-tight text-gray-900 sm:text-5xl">{{ stat.stat }}</dd>
                </div>
            </dl>
        </div>

    </DashboardLayout>
</template>

<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";

const props = defineProps({
    features: Object,
    featureData: Object,
})


let stats = [{name: 'Number of entries', stat: `${props.featureData['entry count']} entries`}];

stats = [
  ...stats,
  ...(hasFeature("streaks") ? [{name: 'Streak', stat: `${props.featureData['streak']} days` }] : []),
  ...(hasFeature("total word count") ? [{name: 'Total word count', stat: `${props.featureData['total word count']} words` }] : [])
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