<template>
    <div class="mt-8 bg-white p-4 shadow rounded-lg">
        <div class="bg-white p-4 rounded-md mt-4">
            <div class="flex justify-between  items-center max-md:flex-col">

                <h2 class="text-gray-500 text-lg  font-semibold pb-3">
                    <button @click="exportExcel()"
                        class="bg-green-pri hover:bg-green-sec text-white font-semibold py-2 px-4  rounded">
                        <i class="fa-solid fa-file-excel mr-1"></i> Exporter

                    </button>
                </h2>
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
            <div class="overflow-x-scroll">

                <table ref="exportable_table" class="w-full container  table-auto text-sm ">
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
                                Dernière Avancement
                            </th>
                            <th
                                class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">
                                CORPS
                            </th>
                            <th
                                class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">
                                Grade
                            </th>
                            <th
                                class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">
                                PROCHAINE AVANCEMENT
                            </th>
                            <th
                                class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">
                                SOA libelle
                            </th>
                            <th
                                class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">
                                UADM
                            </th>
                            <th
                                class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-right">
                                Details
                            </th>
                        </tr>
                    </thead>
                    <tbody class="overflow-x-scroll ">

                        <tr class="hover:bg-gray-400 " v-for="(data, index) in paginatedData" v-bind:key="index">
                            <td class="py-2 px-4 border-b border-grey-light">{{ data.agent_matricule }}</td>
                            <td class="py-2 px-4 border-b border-grey-light">{{ data.noms }}</td>
                            <td class="py-2 px-4 border-b border-grey-light "> {{ data.status }}</td>
                            <td class="py-2 px-4 border-b border-grey-light "> {{ new
                                Date(data.dernier_avance).toLocaleDateString() }}</td>
                            <td class="py-2 px-4 border-b border-grey-light "> {{ data.corps }}</td>
                            <td class="py-2 px-4 border-b border-grey-light "> {{ data.grade }}</td>
                            <td class="py-2 px-4 border-b border-grey-light ">{{ isDateVide(data, data.prochaine_avance) }}
                            </td>
                            <td class="py-2 px-4 border-b border-grey-light "> {{ data.section }}</td>
                            <td class="py-2 px-4 border-b border-grey-light "> {{ data.ministere }}</td>
                            <td class="py-2 px-4 border-b border-grey-light text-center">
                                <ModalDetailler :id="data.id" />
                            </td>
                        </tr>


                    </tbody>
                </table>

            </div>
            <div class="text-left mt-4">
                <Paginator :rows="itemsPerPage" :totalRecords="length"
                    template="FirstPageLink PrevPageLink CurrentPageReport NextPageLink LastPageLink"
                    currentPageReportTemplate="Affichage {first} de {last} à {totalRecords}" @page="handlePagination" />
            </div>
        </div>
    </div>
</template>
<script>
import Paginator from 'primevue/paginator';
import ProgressSpinner from 'primevue/progressspinner';
import ModalDetailler from '@/components/Detailler/ModalDetaillerAvenant.vue';
import * as XLSX from 'xlsx';

export default {
    name: 'TableRecette',
    props: {
        dataList: Array,
    },
    components: {
        ProgressSpinner,
        Paginator, ModalDetailler
    },
    data() {
        return {
            itemsPerPage: 10,
            length: null,
            first: 0,
            query: '',
            name: ''
        }
    },
    computed: {
        paginatedData() {
            if (this.query != '') {
                const query = this.query.toLowerCase();
                var data = this.dataList.filter((item) => {
                    return item.agent_matricule.toLowerCase().includes(query)
                        || item.noms.toLowerCase().includes(query)
                        || item.prochaine_avance.toLowerCase().includes(query)
                });
                this.length = data.length
                const endIndex = this.first + this.itemsPerPage;
                return data.slice(this.first, endIndex);
            }
            if (!this.dataList) {
                return [];
            }
            this.length = this.dataList.length
            const endIndex = this.first + this.itemsPerPage;
            return this.dataList.slice(this.first, endIndex);
        },
        isDateVide() {
            return function (data, donnee) {
                return data.grades_duree == null ? '' : new Date(donnee).toLocaleDateString()
            };
        },
        open() {
            alert('hello guys')
        }

    },
    methods: {
        handlePagination(event) {
            this.first = event.first
        },
        exportExcel() {
            var dataEx = this.dataList.map(item => ({
                "MATRICUKLE AGENT": item.agent_matricule,
                "NOMS": item.noms,
                "STATUS": item.status,
                "CORPS": item.corps,
                "GRADE": item.grade,
                "DERNIERE AVANCE": item.dernier_avance,
                "PROCHAINE AVANCE": item.prochaine_avance,
                "UADM": item.ministere,
                "SECTION": item.section,
            }));
            var ws = XLSX.utils.json_to_sheet(dataEx);

            var wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, 'Nouveau Titre de la Feuille');

            return XLSX.writeFile(wb,  'ListeAgents Agance.xlsx');
        }


    }
}
</script>