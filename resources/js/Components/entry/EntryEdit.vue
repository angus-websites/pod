
<template>
    <div class="flex flex-col space-y-5">

        <div class="flex flex-col md:flex-row md:space-x-8 space-y-5 md:space-y-0">
            
            
            <!-- Title input -->
            <div class="flex-1">
                <label for="email" class="block text-sm font-medium text-gray-700">Title</label>
                <div class="mt-1">
                  <input type="email" name="email" id="email" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Just a normal day" :value="entry.title" />
                </div>
            </div>

            <!-- Date -->
            <div class="flex-1">
                <label for="email" class="block text-sm font-medium text-gray-700">Date</label>
                <div class="mt-1">
                  <input type="date" name="date" id="date" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="01/01/2023" :value="entry.date" />
                </div>
            </div>
        </div>

        <!-- Entry content -->
        <div>
            <label for="comment" class="block text-sm font-medium text-gray-700">Entry content</label>
            <div class="mt-1">
              <textarea rows="4" name="content" id="content" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                  {{ entry.content }}
              </textarea>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    props: {
        entry: Object
    }
}
</script>
