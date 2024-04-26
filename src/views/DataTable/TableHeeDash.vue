<template>
    <div class="bg-white  rounded-md ">
        <h2 class="text-gray-500 text-lg font-semibold"></h2>
        <div class="overflow-x-scroll">
            <table class="container table-auto text-sm ">
                <thead>
                    <tr class="text-sm leading-normal bg-green-font w-full text-white ">
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
                            Date de Naissance
                        </th>
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">
                            Status
                        </th>
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">
                            HEE Libelle
                        </th>
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">
                            UADM
                        </th>
                        <th
                            class="py-2 px-4  bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">
                            Section
                        </th>
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-center">
                             Ministère
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-gray-400" v-for="(data, index) in dataList" v-bind:key="index">
                        <td class="py-2 px-4 border-b border-grey-light">{{ data.agent_matricule }}</td>
                        <td class="py-2 px-4 border-b border-grey-light">{{ data.noms }}</td>
                        <td class="py-2 px-4 border-b border-grey-light">{{ data.date_naissance }}</td>

                        <td class="py-2 px-4 border-b border-grey-light">{{ data.status }}</td>

                        <td class="py-2 px-4 border-b border-grey-light">{{ data.hee }}</td>

                        <td class="py-2 px-4 border-b border-grey-light">{{ data.uadm }}</td>
                        <td class="py-2 px-4 border-b border-grey-light">{{ data.section }}</td>
                        <td class="py-2 px-4 border-b border-grey-light">{{ data.ministere }}</td>
                        
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>

import Swal from 'sweetalert2';
import Axios from "@/_service/caller.service";
import SideBarUpdate from '../pages/Utilisateur/SideBarUpdate.vue';
import Toast from 'primevue/toast';
import ModalAjouterUserVue from '../pages/Utilisateur/ModalAjouterUser.vue';
import ModalDetailler from '../pages/Utilisateur/ModalDetailler.vue';
import Paginator from 'primevue/paginator';
export default {
    name: 'TableHeeDash',
    components: {
        Toast, SideBarUpdate, ModalAjouterUserVue,
        Paginator, ModalDetailler
    },
   
    data() {
        return {
            dataList: [],
            itemsPerPage: 10,
            first: 0,
            query: '',
        }
    },
    mounted() {
        this.getAgentHee()
    },
    computed: {
        paginatedData() {
            if (this.query != '') {
                const query = this.query.toLowerCase();
                return this.dataList.filter(item => {
                    return item.nom.toLowerCase().includes(query)
                        || item.prenom.toLowerCase().includes(query)
                        || item.matricule.toLowerCase().includes(query)
                        || item.email.toLowerCase().includes(query)
                        || item.created_at.toLowerCase().includes(query);
                });

            }
            if (!this.dataList) {
                return [];
            }
            const endIndex = this.first + this.itemsPerPage
            return this.dataList.slice(this.first, endIndex);
        }
    },
    methods: {
        getAgentHee() {
            Axios.get('/indexHee').then((response) => {
                if (response.data.code == 200) {
                    this.dataList = response.data.DataAgents
                }
            }).catch((error) => {
                console.log("error dans l'axios: ", error)
            })
        },
        open(item) {
            console.log(item)
        },
        handlePagination(event) {
            this.first = event.first
        }
    }
}
</script>