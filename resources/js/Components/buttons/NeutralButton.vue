<template>
    <Link v-if="isLink" :class="[sizeClass, baseClasses]">
        <slot/>
    </Link>
    <button v-else :class="[sizeClass, baseClasses]">
        <slot />
    </button>
</template>

<script>
export default {
    name: "PrimaryButton",
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
            return "inline-flex items-center justify-center whitespace-nowrap rounded-md border border-transparent bg-[#F1F1F2] text-base font-medium text-[#676767] shadow-sm hover:bg-[#E7E7E7]";
        }

    }
}


</script>

