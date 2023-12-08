<template>
    <!-- main content page -->

  <div class="mt-10 mb-10 md:ml-64">
    <div class="mt-8 bg-white p-4 shadow rounded-lg">
        <h2 class="text-gray-500 text-3xl font-semibold pb-1">Filtre</h2>
        <div class="my-1"></div>
        <div class="bg-gradient-to-r from-green-font to-green-pri h-px mb-6"></div>
        <table class="w-full table-auto text-sm">
            <thead>
               
            </thead>
        </table>
    </div> 
    <!-- main content page -->
    <TableUserVue />
    </div>
</template>

<script>
import TableUserVue from '@/views/DataTable/TableUser.vue'
export default {
    name: 'UserListe',
    components: {
        TableUserVue,
    }
}
</script>