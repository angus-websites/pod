<template>
    <DashboardLayout>

        <div v-if="loading || !featureData" class="mx-auto text-center mt-10">
            <PulseLoader></PulseLoader>
        </div>

        <template v-if="featureData">
            <Stats :features="features" :featureData="featureData" />
            <Leaderboard :features="features" :featureData="featureData" v-if="hasFeature('leaderboard')" class="mt-10"/>
        </template>
    </DashboardLayout>
</template>

<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import Stats from "@/Components/dashboard/Stats.vue";
import Leaderboard from "@/Components/dashboard/Leaderboard.vue";
import {Inertia} from "@inertiajs/inertia";
import {ref, onMounted} from "vue";
import PulseLoader from 'vue-spinner/src/PulseLoader.vue'

const props = defineProps({
    features: Object,
    featureData: Object,
})

let loading = ref(false)

// On load fetch the feature data
onMounted(() => {
    Inertia.reload({
        only: ['featureData'],
        onStart: (visit) => {
            console.log("starting request")
            loading.value=true;
        },
        onFinish: (visit) =>{
            loading.value=false
            console.log("finishing request")
        }
    })
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
