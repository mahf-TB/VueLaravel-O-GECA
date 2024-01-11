<template>
    <div class="mt-8 bg-white p-4 shadow rounded-lg">
        <div class="bg-white p-4 rounded-md mt-4">
            <div class="flex justify-between items-center max-md:flex-col">
                <h2 class="text-gray-500 text-lg font-semibold pb-4">
                    <button @click="visible = true"
                        class="bg-green-pri hover:bg-green-sec text-white font-semibold py-2 px-4  rounded">
                        <i class="fa-solid fa-user-plus"></i> Exporter
                    </button>
                </h2>
                    <!-- Liste des agents à renouveler leur contrat. -->
                <!-- Recherche input en top -->
                <div class="relative max-w-md w-full mb-5">
                    <div class="absolute top-1 left-2 inline-flex items-center p-2">
                        <i class="fas fa-search text-gray-400 "></i>
                    </div>
                    <input v-model="query"
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
                            uadm
                        </th>
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-right">
                            Details
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-gray-400" v-for="(data, index) in paginatedData" v-bind:key="index">
                        <td class="py-2 px-4 border-b border-grey-light">{{ data.agent_matricule }}</td>
                        <td class="py-2 px-4 border-b border-grey-light">{{ data.noms }}</td>
                        <td class="py-2 px-4 border-b border-grey-light "> {{ data.status }}</td>
                        <td class="py-2 px-4 border-b border-grey-light "> {{ data.corps }}</td>
                        <td class="py-2 px-4 border-b border-grey-light "> {{ data.grade }}</td>
                        <td class="py-2 px-4 border-b border-grey-light "> {{data.debut_contrat }}</td>
                        <td class="py-2 px-4 border-b border-grey-light ">{{data.fin_contrat}}</td>
                        <td class="py-2 px-4 border-b border-grey-light "> {{ data.section }}</td>
                        <td class="py-2 px-4 border-b border-grey-light"> {{ data.ministere }}</td>
                        <td class="py-2 px-4 border-b border-grey-light text-center"> 
                            <ModalDetailler />
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="text-left mt-4">
                <Paginator :rows="itemsPerPage" :totalRecords="dataList.length"
                    template="FirstPageLink PrevPageLink CurrentPageReport NextPageLink LastPageLink"
                    currentPageReportTemplate="Affichage {first} de {last} à {totalRecords}"
                    @page="handlePagination"/>
            </div>
        </div>
    </div>
</template>
<script>
import Paginator from 'primevue/paginator';
import ModalDetailler from '@/components/ModalDetailler.vue';

    export default {
    name: 'TableRecette',
    props: {
        dataList: Array,
    },
    components: { Paginator , ModalDetailler},
    data() {
        return {
            currentPage: 1,
            itemsPerPage: 10,
            query: '',
            first:0
        };
    },
    computed: {
     paginatedData() {
            if (this.query != '') {
                const query = this.query.toLowerCase();
                return this.dataList.filter(item => {
                    return item.agent_matricule.toLowerCase().includes(query)
                        || item.noms.toLowerCase().includes(query)
                        || item.fin_contrat.toLowerCase().includes(query)
                });
            }
            if (!this.dataList) {
                return [];
            }
            const endIndex = this.first + this.itemsPerPage;
            return  this.dataList.slice(this.first, endIndex);
        },
        isDateVide() {
            return function (data, donnee) {
                return data.dernier_avance == null ? '' : donnee;
            };
        },
    },
    methods: {
        handlePagination(event){
            
            this.first = event.first
        }
    },
}
</script>