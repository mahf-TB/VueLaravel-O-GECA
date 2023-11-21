<template>
    <!-- main content page -->
    <div class="mt-8 bg-white p-4 shadow rounded-lg">
        <h2 class="text-gray-500 text-3xl font-semibold pb-1">Filtre</h2>
        <div class="my-1"></div>
        <div class="bg-gradient-to-r from-green-font to-green-pri h-px mb-6"></div>
        <table class="w-full table-auto text-sm">
            <thead>
                <!-- <tr class="text-sm leading-normal flex-table">
                    <th
                        class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light">
                        <div class="mb-3 space-y-2 w-full text-xs">
                            <label class="font-semibold text-gray-600 py-2">Montant</label>
                            <input placeholder="Montant"
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4"
                                required="required" type="number" name="integration[shop_name]" id="integration_shop_name"
                                v-model="montant" />
                        </div>
                    </th>
                    <th
                        class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light">
                        <div class="mb-3 space-y-2 w-full text-xs">
                            <label class="font-semibold text-gray-600 py-2">Description
                            </label>
                            <input placeholder="Description"
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4"
                                required="required" type="text" name="integration[shop_name]" id="integration_shop_name"
                                v-model="motif" />
                        </div>
                    </th>
                    <th
                        class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light">
                        <div class="mb-3 space-y-2 w-full text-xs">
                            <label class="font-semibold text-gray-600 py-2">Date </label>
                            <input placeholder="Date"
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4"
                                required="required" type="date" name="integration[shop_name]" id="integration_shop_name"
                                v-model="date" />
                        </div>
                    </th>
                </tr> -->
            </thead>
        </table>
    </div>

    <!-- main content page -->
    <TableUserVue />
</template>

<script>
import TableUserVue from '@/views/DataTable/TableUser.vue'
export default {
    name: 'UserListe',
    components: {
        TableUserVue
    }
}
</script>