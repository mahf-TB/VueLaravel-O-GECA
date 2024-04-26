<template>
    <div>
        <Dialog v-model:visible="visible" modal header="Modifier mes informations" :style="{ width: '45rem' }"
            :breakpoints="{ '1199px': '70vw', '750px': '90vw' }">
            <div class="relative py-8 px-5 md:px-10 bg-white shadow-md rounded border border-gray-400">
                <div class="flex">
                    <div class="w-full">
                        <!-- matricule -->
                        <label for="mat" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                            Matricule<span class="text-red-500">*</span></label>
                        <input id="mat" v-model="user.matricule"
                            class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border"
                            placeholder="XXYYXX" />
                    </div>
                    <!-- username -->
                    <div class="w-full ml-1">
                        <label for="name3" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                            Nom d'utilisateur <span class="text-red-500">*</span></label>
                        <input id="name3" v-model="user.username"
                            class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border"
                            placeholder="James" />
                    </div>
                </div>
                <div class="flex">
                    <!-- nom -->
                    <div class="w-full">
                        <label for="name1" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                            Nom <span class="text-red-500">*</span></label>
                        <input id="name1" v-model="user.nom" style="text-transform:capitalize;"
                            class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border"
                            placeholder="RAKOTO" />
                    </div>
                    <!-- prenom -->
                    <div class="w-full ml-1">
                        <label for="name2" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                            Prenom</label>
                        <input id="name2" v-model="user.prenom"
                            class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border"
                            placeholder="James" />
                    </div>
                </div>
                <!-- email -->
                <label for="email2" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                    Email</label>
                <div class="relative mb-5 mt-2">
                    <div class="absolute text-gray-600 flex items-center px-4 border-r h-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-credit-card" width="20"
                            height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <rect x="3" y="5" width="18" height="14" rx="3" />
                            <line x1="3" y1="10" x2="21" y2="10" />
                            <line x1="7" y1="15" x2="7.01" y2="15" />
                            <line x1="11" y1="15" x2="13" y2="15" />
                        </svg>
                    </div>
                    <input id="email2" v-model="user.email" type="text"
                        class="text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-16 text-sm border-gray-300 rounded border"
                        placeholder="exemple@exemple.com" />
                </div>

                <div class="flex items-center justify-start w-full">
                    <button
                        class="focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-400  bg-gray-100 transition duration-150 text-gray-600 ease-in-out hover:border-gray-400 hover:bg-gray-300 border rounded px-8 py-2 text-sm"
                        @click="visible = false">Cancel</button>
                    <button 
                        class=" focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-700 ml-3 transition duration-150 ease-in-out hover:bg-green-600 bg-green-700 rounded text-white px-8 py-2 text-sm"
                        @click.prevent="ChangeUserInfo()"> Enregistrer</button>
                </div>
            </div>
        </Dialog>
        <button @click="open()"
            class="bg-white w-full hover:bg-green-pri text-[14px] text-green-pri uppercase hover:text-white border border-green-pri transition duration-200 p-[0.5rem]  py-2 px-4 mb-5 rounded">
            <i class="fa-solid fa-pen-to-square mr-2"></i>Modifier
        </button>
    </div>
</template>
<script>
import Axios from "@/_service/caller.service";
import Dialog from 'primevue/dialog';
import SpeedDial from 'primevue/speeddial';
import ImageModal from "./ImageModal.vue";

export default {
    name: 'ModalProfile',
    components: {
        Dialog, SpeedDial, ImageModal,
    },
    data() {
        return {
            visible: false,
            user: {
                matricule: '',
                nom: '',
                prenom: '',
                email: '',
                username: ''
            }
        }
    },
    mounted() {
        try {
            const token = JSON.parse(localStorage.getItem("token"));
            if (token) {
                Axios.get('/auth/user').then(response => {
                    var usr = response.data
                    this.user = {
                        matricule: usr.matricule,
                        nom: usr.nom,
                        prenom: usr.prenom,
                        email: usr.email,
                        username: usr.username,
                    }
                }).catch(error => {
                    console.log("error dans l'axios: ", error)
                })
            }
        } catch (error) {
            console.log(error)
        }
    },
    methods: {
        open() {
            this.visible = true
        },
        // updateUserAuth
        ChangeUserInfo() {
            console.log(this.user)
            Axios.post('/updateUserAuth', this.user).then(response => {
                console.log(response.data)
                this.visible = false
            }).catch(error => {
                console.log("error dans l'axios: ", error)
            })

        }
    }
}

</script>
<style>
/* class="p-button p-ocmponent p-button-icon-only p-speeddial-button p-button-rounded p-speeddial-rotate" */
.p-component>button {
    background: #12b659;
    color: #FFF;
    margin-right: 5px;
}
</style>