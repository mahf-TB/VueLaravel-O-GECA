<template>
    <div>
        <Dialog v-model:visible="visible" modal header="Formulaire d'ajouter Nouvelle Utilisateur"
            :style="{ width: '50rem' }" :breakpoints="{ '890px': '90vw', '575px': '90vw' }">
            <div class="relative py-8 px-5 md:px-10 bg-white shadow-md rounded border border-gray-400">
                <!-- matricule -->
                <label for="mat" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                    Matricule</label>
                <input id="mat" v-model="user.matricule"
                    class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border"
                    placeholder="XXYYXX" />
                <div class="flex">
                    <!-- nom -->
                    <div class="w-full">
                        <label for="name1" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                            Nom</label>
                        <input id="name1" v-model="user.nom"
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
                <!-- password -->
                <label for="password" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Mot de
                    passe</label>
                <div class="relative mb-5 mt-2">
                    <InputText type="password" v-model="user.motdepasse" placeholder="Mot de passe" toggleMask
                        class="mb-8 text-gray-600 focus:outline-none focus:border focus:border-indigo-700  font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" />
                </div>
                <!-- role -->
                <label for="expiry" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Section
                </label>
                <div class="relative mb-5 mt-2">
                    <MultiSelect v-model="Sections" :options="sectionValues" optionLabel="soa_libelle"
                        placeholder="Select Cities" :filter="true"
                        class="text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" />
                </div>


                <div class="flex items-center justify-start w-full">
                    <button
                        class="focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-400  bg-gray-100 transition duration-150 text-gray-600 ease-in-out hover:border-gray-400 hover:bg-gray-300 border rounded px-8 py-2 text-sm"
                        @click="visible = false">Cancel</button>
                    <button
                        class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 ml-3 transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-8 py-2 text-sm"
                        @click.prevent="SaveUser()"> Enregistrer</button>

                </div>
            </div>

        </Dialog>
        <button @click="visible = true"
            class="bg-green-pri hover:bg-green-sec text-white font-semibold py-2 px-4 mb-5 rounded">
            <i class="fa-solid fa-user-plus"></i> Nouvelle RH
        </button>
    </div>
</template>

<script>
import Axios from "@/_service/caller.service";
import { useToast } from 'primevue/usetoast';

import Dialog from 'primevue/dialog';
import Buttons from 'primevue/button';
import Dropdown from 'primevue/dropdown';
import InputText from 'primevue/inputtext';
import Password from 'primevue/password';
import MultiSelect from "primevue/multiselect";

import { ref } from 'vue';
export default {
    name: 'ajouterUser',
    props: {
        getAllUser: Function
    },
    components: {
        Dialog, Buttons,
        Dropdown, Password,
        InputText, MultiSelect
    },
    data() {
        return {
            sectionValues: null
        }
    },
    mounted() {
        this.getSection()
    },
    methods: {
        getSection() {
            Axios.get('/section').then((response) => {
                if (response.status == 200) {
                    this.sectionValues = response.data.dataSection
                }
            }).catch((error) => {
                console.log("error dans l'axios: ", error)
            })
        }
    },
    setup(props) {
        const Sections = ref(null)
        const visible = ref(false);
        const SecArray = []
        const user = {
            matricule: '',
            nom: '',
            prenom: '',
            email: '',
            motdepasse: '',
            role: 'RH',
        }
        const toast = useToast();
        const SaveUser = () => {
            if (!user.matricule || !user.nom || !user.prenom || !user.email || !user.motdepasse || !user.role) {
              return []

            } else {
                console.log(user)
                var donnee = new FormData();
                donnee.append('matricule', user.matricule);
                donnee.append('nom', user.nom);
                donnee.append('prenom', user.prenom);
                donnee.append('email', user.email);
                donnee.append('password', user.motdepasse);
                donnee.append('role', user.role);

                Axios.post('/auth/addUser', donnee).then((response) => {
                    toast.add({ severity: 'success', summary: 'Successful', detail: `${response.data.message}`, life: 3000 });
                    visible.value = false;
                    props.getAllUser();
                }).catch((error) => {
                    console.log("error dans l'axios: ", error)
                })
            }
        }
        return {
            SaveUser, user, visible, Sections
        }
    }
}
</script>