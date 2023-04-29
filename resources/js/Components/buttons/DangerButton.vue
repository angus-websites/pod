<template>
    <Link v-if="isLink" :class="[sizeClass, baseClasses]">
        <slot/>
    </Link>
    <button v-bind="$attrs" v-else :class="[sizeClass, baseClasses]">
        <slot />
    </button>
</template>

<script>
export default {
    name: "DangerButton",
    props: {
        size: {
            default: "m",
        },
        isLink: {
            default: false,
        }
    },


    computed: {
        sizeClass() {
            switch (this.size){
                case "l":
                    return "px-8 py-3 md:py-4 md:px-10 md:text-lg"
                case "s":
                    return "px-2 py-1 text-sm"
                default:
                    return "px-4 py-2"
            }
        },

        baseClasses(){
            return "inline-flex items-center justify-center whitespace-nowrap rounded-md border border-transparent bg-red-400 text-base font-medium text-white shadow-sm enabled:hover:bg-red-500 disabled:opacity-50";
        }

    }
}


</script>

