<template>
    <div class="bg-white p-4 rounded-md mt-4">
        <h2 class="text-gray-500 text-lg font-semibold pb-4"></h2>
        <div class="flex justify-between max-md:flex-col">
            <!-- Recherche input en top -->
            <div class="relative max-w-md w-full mb-5">
                <div class="absolute top-1 left-2 inline-flex items-center p-2">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input v-model="query"
                    class="w-full h-10 pl-10 pr-4 py-1 text-base placeholder-gray-500 border rounded-full focus:shadow-outline"
                    type="search" placeholder="Recherche..." />
            </div>
            <div class="text-right  h-10">
                <Toast />
                <!-- Modal Pour ajouter new User -->
                <ModalAjouterUserVue :getAllUser="getAllUser" />
            </div>
        </div>
        <div class="my-1"></div>
        <div class="bg-gradient-to-r from-green-font to-green-pri h-px mb-6"></div>
        <div class="overflow-x-scroll">
            <table class="w-full container table-auto text-sm">
                <thead>
                    <tr class="text-sm leading-normal bg-green-font text-white">
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">
                            Matricule
                        </th>
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">
                            Username
                        </th>
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">
                            Nom
                        </th>
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">
                            Prenom
                        </th>
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">
                            Email
                        </th>
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">
                            Role
                        </th>
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">
                            Date création
                        </th>
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-gray-400" v-for="(data, index) in paginatedData" v-bind:key="index">
                        <td class="py-2 px-4 border-b border-grey-light">{{ data.matricule }}</td>
                        <td class="py-2 px-4 border-b border-grey-light">{{ data.username }}</td>
                        <td class="py-2 px-4 border-b border-grey-light">{{ data.nom }}</td>

                        <td class="py-2 px-4 border-b border-grey-light">{{ data.prenom }}</td>

                        <td class="py-2 px-4 border-b border-grey-light">{{ data.email }}</td>

                        <td class="py-2 px-4 border-b border-grey-light">{{ data.role }}</td>
                        <td class="py-2 px-4 border-b border-grey-light">{{ new Date(data.created_at).toLocaleDateString()  }}</td>
                        <td class="py-2 px-4 border-b border-grey-light text-center">
                            <div class="inline-flex items-center space-x-3">
                                <SideBarUpdate :id="data.id" />
                                <a @click.prevent="deleteUser(data.id)"
                                    class="text-[#ff3e3e] hover:text-[#ff3e3e]">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                                <ModalDetailler />
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="text-left mt-4">
            <Paginator :rows="itemsPerPage" :totalRecords="dataList.length"
                template="FirstPageLink PrevPageLink CurrentPageReport NextPageLink LastPageLink"
                currentPageReportTemplate="Affichage {first} de {last} à {totalRecords}" @page="handlePagination" />
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
    name: 'TableRecette',
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
        this.getAllUser();
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
        getAllUser() {
            Axios.get('/getUser').then((response) => {
                if (response.status == 200) {
                    console.log(response.data.dataUser)
                    this.dataList = response.data.dataUser
                }
            }).catch((error) => {
                console.log("error dans l'axios: ", error)
            })
        },
        EditUser(item) {
            console.log(item)
        },
        async deleteUser(item) {
            const result = await Swal.fire({
                title: 'Êtes-vous sûr de vouloir supprimer?',
                text: "Cette action est irréversible!",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Annuler',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, supprimer!'
            });
            if (result.isConfirmed) {
                Axios.delete(`/delete/${item}`).then((response) => {
                    if (response.data.status == 200) {
                        console.log(response.data.message)
                        this.getAllUser()
                    }
                }).catch((error) => {
                    console.log("error dans l'axios: ", error)
                })
            }


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