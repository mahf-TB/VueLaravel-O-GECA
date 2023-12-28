
<template>
    <div class="card flex justify-content-center">
        <Sidebar v-model:visible="visible" header="Modification d'un utilisateur" position="right"
            class="w-[350px] md:w-20rem lg:w-30rem">
            <div class="mt-8 bg-white p-4 shadow rounded-lg">
                <div class="field col-12 md:col-4 pb-5">
                    <span class="field">
                        <label for="inputtext">
                            <h2 class="text-gray-600 text-sm font-semibold pb-1">Matricule <span class="text-red-500">*</span> </h2>
                        </label>
                        <input id="inputtext" v-model="user.matricule"
                            class="mb-5 text-gray-600 focus:outline-none  font-normal w-full h-10 flex items-center pl-3 text-sm border-green-pri rounded border-b-2" />
                    </span>
                </div>
                <div class="field col-12 md:col-4 pb-5">
                    <span class="field">
                        <label for="inputtext">
                            <h2 class="text-gray-600 text-sm font-semibold pb-1">Nom <span class="text-red-500">*</span> </h2>
                        </label>
                        <input id="inputtext" v-model="user.nom"
                            class="mb-5 text-gray-600 focus:outline-none  font-normal w-full h-10 flex items-center pl-3 text-sm border-green-pri rounded border-b-2" />
                    </span>
                </div>
                <div class="field col-12 md:col-4 pb-5">
                    <span class="field">
                        <label for="inputtext">
                            <h2 class="text-gray-600 text-sm font-semibold pb-1">Prenom <span class="text-red-500">*</span> </h2>
                        </label>
                        <input id="inputtext" v-model="user.prenom"
                            class="mb-5 text-gray-600 focus:outline-none  font-normal w-full h-10 flex items-center pl-3 text-sm border-green-pri rounded border-b-2" />
                    </span>
                </div>
                <div class="field col-12 md:col-4 pb-5">
                    <span class="field">
                        <label for="inputtext">
                            <h2 class="text-gray-600 text-sm font-semibold pb-1">Email <span class="text-red-500">*</span> </h2>
                        </label>
                        <input id="inputtext" v-model="user.email"
                            class="mb-5 text-gray-600 focus:outline-none  font-normal w-full h-10 flex items-center pl-3 text-sm border-green-pri rounded border-b-2" />
                    </span>
                </div>
                <div class="field col-12 md:col-4 pb-5">
                    <span class="field">
                        <label for="inputtext">
                            <h2 class="text-gray-600 text-sm font-semibold pb-1">Rôle <span class="text-red-500">*</span> </h2>
                        </label>
                        <input id="inputtext" v-model="user.role"
                            class="mb-5 text-gray-600 focus:outline-none  font-normal w-full h-10 flex items-center pl-3 text-sm border-green-pri rounded border-b-2" />
                    </span>
                </div>
                <!-- lallalla -->
                <table class="w-full table-auto text-sm">
                    <thead>
                        <tr class="text-sm leading-normal  text-white">
                            <th
                                class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">
                                <button 
                                    class="bg-green-pri hover:bg-green-sec text-white font-semibold py-2 px-4 mb-5 rounded">
                                    Modifier
                                </button>
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </Sidebar>
        <a @click.prevent="open()" title="Suspend user" class="text-green-sec hover:text-green-pri">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
    </div>
</template>

<script>
import Sidebar from 'primevue/sidebar';
import Axios from '@/_service/caller.service';
export default {
    name:'SideBarUpdate',
    components: { Sidebar },
    props:{
        id:Object
    },
    data() {
        return {
            visible: false,
            user:{
                matricule: 'mahefabien@gmail.com',
                nom: 'mahefabien@.com',
                prenom: 'mahefabien@gmail.com',
                email: '@gmail.com',
                role: 'mahefabien@gmail.com',

            }
        };
    },
    methods: {
        async open() {
            this.visible = true
            console.log(this.id)
            try {
                const response = await Axios.get(`/find/${this.id}`)
                var data = response.data.user
                this.user = {
                    matricule : data.matricule,
                    nom : data.nom,
                    prenom : data.prenom,
                    email : data.email,
                    role : data.role,
                }
            } catch (error) {
                console.log("error dans l'axios: ", error)
            }
        }
    }
}
</script>