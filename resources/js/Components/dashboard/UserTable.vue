<template>
  <div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex-auto">
        <h2 class="text-lg font-semibold leading-6 text-gray-900">Users</h2>
        <p class="mt-2 text-sm text-gray-700">A list of all the users in your account including their name, title, email and role.</p>
    </div>
    <div class="mt-8 flow-root">
      <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
          <table class="min-w-full divide-y divide-gray-300">
            <thead>
              <tr>
                <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500 sm:pl-0">Name</th>
                <th scope="col" class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">Email</th>
                <th scope="col" class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">Groups</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
              <tr v-for="user in users.data" :key="user.id">
                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{ user.name }}</td>
                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">{{ user.email }}</td>
                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">
                  <div class="flex items-center flex-row gap-x-2">
                    <span v-for="group in user.groups" :style="{ backgroundColor: group.bg, color: group.fg}" class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium">{{group.name}}</span>
                    <p v-if="user.groups.length < 1">NO GROUP</p>
                  </div>
                </td>
              </tr>
            </tbody>
                <tfoot>
                    <!-- Pagination -->
                    <nav v-if="users.data.length > 0" class="flex items-center justify-between bg-white py-3" aria-label="Pagination">
                        <div class="hidden sm:block">
                            <p class="text-sm text-gray-700">
                                Page
                                {{ ' ' }}
                                <span class="font-medium">{{users.meta.current_page}}</span>
                                {{ ' ' }}
                                of
                                {{ ' ' }}
                                <span class="font-medium">{{users.meta.last_page}}</span>
                            </p>
                        </div>
                        <div class="flex flex-1 justify-between sm:justify-end">
                            <Link preserve-scroll v-if="users.links.prev" :href="users.links.prev" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</Link>
                            <Link preserve-scroll v-if="users.links.next"  :href="users.links.next" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</Link>
                        </div>
                    </nav>
                </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
  const props = defineProps({
      users: Object
  })
</script>
