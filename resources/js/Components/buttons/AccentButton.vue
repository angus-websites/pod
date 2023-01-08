<template>
    <a v-if="isLink" :class="[sizeClass, baseClasses]">
        <slot/>
    </a>
    <button v-else :class="[sizeClass, baseClasses]">
        <slot />
    </button>
</template>

<script>
export default {
    name: "AccentButton",
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
                default:
                    return "px-4 py-2"
            }
        },

        baseClasses(){
            return "inline-flex items-center justify-center whitespace-nowrap rounded-md border border-transparent bg-accent text-base font-medium text-accent-text shadow-sm hover:bg-acccent-600";
        }

    }
}


</script>

