<template>
    <DashboardLayout>
        <Stats :features="features" :featureData="featureData" />
        <Leaderboard :features="features" :featureData="featureData" v-if="hasFeature('leaderboard')" class="mt-10"/>
    </DashboardLayout>
</template>

<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import Stats from "@/Components/dashboard/Stats.vue";
import Leaderboard from "@/Components/dashboard/Leaderboard.vue";

const props = defineProps({
    features: Object,
    featureData: Object,
})


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
