<template>
    <DashboardLayout>

        <div class="flex flex-col space-y-5">
            <template v-if="hasFeature('streaks')" >
                <!-- Streak -->
                <div class="mx-auto text-center p-5 rounded-md max-w-sm shadow-md bg-secondary">
                    <dt class="text-base leading-7 text-slate-200">Current streak</dt>
                    <dd class="order-first text-3xl font-semibold tracking-tight text-slate-50 sm:text-5xl">{{featureData.streak}} days</dd>
                </div>
            </template>

            <template v-if="hasFeature('total word count')" >
                <!-- Total word count -->
                <div class="mx-auto text-center p-5 rounded-md max-w-sm shadow-md bg-secondary">
                    <dt class="text-base leading-7 text-slate-200">Total word count</dt>
                    <dd class="order-first text-3xl font-semibold tracking-tight text-slate-50 sm:text-5xl">{{featureData['total word count']}} words</dd>
                </div>
            </template>
        </div>
    </DashboardLayout>
</template>

<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";

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