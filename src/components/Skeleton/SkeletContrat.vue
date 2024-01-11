<template>
    <div class="mt-8 bg-white p-4 shadow rounded-lg">
        <div class="bg-white p-4 rounded-md mt-4">
            <div class="flex justify-between items-center max-md:flex-col">
                <h2 class="text-gray-500 text-lg font-semibold pb-4">
                    <button @click="visible = true"
                        class="bg-green-pri hover:bg-green-sec text-white font-semibold py-2 px-4  rounded">
                        <i class="fa-solid fa-user-plus"></i> Export
                    </button>
                </h2>
                <!-- Recherche input en top -->
                <div class="relative max-w-md w-full mb-5">
                    <div class="absolute top-1 left-2 inline-flex items-center p-2">
                        <i class="fas fa-search text-gray-400 "></i>
                    </div>
                    <input
                        class="w-full h-10 pl-10 pr-4 py-1 text-base placeholder-gray-500 border rounded-full focus:shadow-outline"
                        type="search" placeholder="Recherche..." />
                </div>

            </div>
            <div class="my-1"></div>
            <div class="bg-gradient-to-r from-green-font to-green-pri h-px mb-6"></div>
            <table class="w-full container table-auto text-sm">
                <thead>
                    <tr class="text-sm leading-normal bg-green-font text-white">
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">
                            Matricule
                        </th>
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">
                            Noms
                        </th>
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">
                            Status
                        </th>
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">
                            corps
                        </th>
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">
                            Grade
                        </th>
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">
                            Debut Contrat
                        </th>
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">
                            Fin Contrat
                        </th>
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">
                            Soa Libelle
                        </th>
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">
                            Ministere
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-gray-400" v-for="(index) in dataCard" v-bind:key="index">
                        <td class="py-2 px-4 border-b border-grey-light">
                            <Skeleton></Skeleton>
                        </td>
                        <td class="py-2 px-4 border-b border-grey-light">
                            <Skeleton></Skeleton>
                        </td>
                        <td class="py-2 px-4 border-b border-grey-light ">
                            <Skeleton></Skeleton>
                        </td>
                        <td class="py-2 px-4 border-b border-grey-light ">
                            <Skeleton></Skeleton>
                        </td>
                        <td class="py-2 px-4 border-b border-grey-light ">
                            <Skeleton></Skeleton>
                        </td>
                        <td class="py-2 px-4 border-b border-grey-light ">
                            <Skeleton></Skeleton>
                        </td>
                        <td class="py-2 px-4 border-b border-grey-light ">
                            <Skeleton></Skeleton>
                        </td>
                        <td class="py-2 px-4 border-b border-grey-light ">
                            <Skeleton></Skeleton>
                        </td>
                        <td class="py-2 px-4 border-b border-grey-light">
                            <Skeleton></Skeleton>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="text-left mt-4">
                <Paginator :rows="10" :totalRecords="0"
                    template="FirstPageLink PrevPageLink CurrentPageReport NextPageLink LastPageLink"
                    currentPageReportTemplate="Affichage {first} de {last} à {totalRecords}"
                    @page="handlePagination"/>
            </div>
        </div>
    </div>
</template>
  
<script>
import Paginator from 'primevue/paginator';
import Skeleton from 'primevue/skeleton';
export default {
    name: 'SkeletContrat',
    components: {
    Skeleton,
    Paginator
},
    data() {
        return {
            dataCard: 10

        }
    },
    mounted() {


    },
}
</script>