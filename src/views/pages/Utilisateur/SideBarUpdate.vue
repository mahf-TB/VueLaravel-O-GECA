
<template>
    <div class="card flex justify-content-center">
        <Sidebar v-model:visible="visible" header="Modification d'un utilisateur" position="right"
            class="w-[350px] md:w-20rem lg:w-30rem">

            <Accordion :activeIndex="0">
                <AccordionTab header="Utilisateur">
                    <div class="line-height-3 m-0">
                        <div class="field col-12 md:col-4 pb-3">
                            <span class="field">
                                <label for="inputtext">
                                    <h2 class="text-gray-600 text-sm font-semibold pb-1">Matricule <span
                                            class="text-red-500">*</span> </h2>
                                </label>
                                <input id="inputtext" v-model="user.matricule"
                                    class="mb-5 text-gray-600 focus:outline-none bg-gray-100 font-normal w-full h-10 flex items-center pl-3 text-sm border-green-pri rounded border-b-2" />
                            </span>
                        </div>
                        <div class="field col-12 md:col-4 pb-3">
                            <span class="field">
                                <label for="inputtext">
                                    <h2 class="text-gray-600 text-sm font-semibold pb-1">Nom d'utilisateur <span
                                            class="text-red-500">*</span>
                                    </h2>
                                </label>
                                <input id="inputtext" v-model="user.username"
                                    class="mb-5 text-gray-600 focus:outline-none bg-gray-100 font-normal w-full h-10 flex items-center pl-3 text-sm border-green-pri rounded border-b-2" />
                            </span>
                        </div>
                        <div class="field col-12 md:col-4 pb-3">
                            <span class="field">
                                <label for="inputtext">
                                    <h2 class="text-gray-600 text-sm font-semibold pb-1">Nom <span
                                            class="text-red-500">*</span>
                                    </h2>
                                </label>
                                <input id="inputtext" v-model="user.nom"
                                    class="mb-5 text-gray-600 focus:outline-none bg-gray-100 font-normal w-full h-10 flex items-center pl-3 text-sm border-green-pri rounded border-b-2" />
                            </span>
                        </div>
                        <div class="field col-12 md:col-4 pb-3">
                            <span class="field">
                                <label for="inputtext">
                                    <h2 class="text-gray-600 text-sm font-semibold pb-1">Prenom <span
                                            class="text-red-500">*</span> </h2>
                                </label>
                                <input id="inputtext" v-model="user.prenom"
                                    class="mb-5 text-gray-600 focus:outline-none bg-gray-100 font-normal w-full h-10 flex items-center pl-3 text-sm border-green-pri rounded border-b-2" />
                            </span>
                        </div>
                        <div class="field col-12 md:col-4 pb-3">
                            <span class="field">
                                <label for="inputtext">
                                    <h2 class="text-gray-600 text-sm font-semibold pb-1">Email <span
                                            class="text-red-500">*</span> </h2>
                                </label>
                                <input id="inputtext" v-model="user.email"
                                    class="mb-5 text-gray-600 focus:outline-none bg-gray-100 font-normal w-full h-10 flex items-center pl-3 text-sm border-green-pri rounded border-b-2" />
                            </span>
                        </div>
                        <div class="field col-12 md:col-4 pb-3">
                            <span class="field">
                                <label for="inputtext">
                                    <h2 class="text-gray-600 text-sm font-semibold pb-1">Rôle <span
                                            class="text-red-500">*</span> </h2>
                                </label>
                                <input id="inputtext" v-model="user.role"
                                    class="mb-5 text-gray-600 focus:outline-none bg-gray-100  font-normal w-full h-10 flex items-center pl-3 text-sm border-green-pri rounded border-b-2" />
                            </span>
                        </div>

                        <div class="field col-12 md:col-4 pb-3">
                            <label for="inputtext">
                                <h2 class="text-gray-600 text-sm font-semibold pb-1">UADM <span
                                        class="text-red-500">*</span> </h2>
                            </label>
                            <div class="line-height-3 m-0">
                                <VueMultiselect :model-value="value" @update:model-value="updateSelected" :options="options"
                                    :multiple="true" label="uadm_libelle" track-by="uadm_code"
                                    placeholder="Search or add a tag" />
                            </div>
                        </div>
                        <!-- lallalla -->
                        <table class="w-full table-auto text-sm">
                            <thead>
                                <tr class="text-sm leading-normal  text-white">
                                    <th
                                        class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">
                                        <button @click.prevent="updateUser()"
                                            class="bg-green-pri hover:bg-green-sec text-white font-semibold py-2 px-4 mb-5 rounded">
                                            <i v-if="isLoad" class="pi pi-spin pi-spinner mr-2" style="font-size: 1rem"></i>
                                            Modifier
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </AccordionTab>
            </Accordion>
        </Sidebar>
        <a @click.prevent="open()" title="Suspend user" class="text-green-sec hover:text-green-pri">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
    </div>
</template>

<script>
import Sidebar from 'primevue/sidebar';
import Axios from '@/_service/caller.service';
import Accordion from 'primevue/accordion';
import AccordionTab from 'primevue/accordiontab';

import VueMultiselect from "vue-multiselect";

export default {
    name: 'SideBarUpdate',
    components: { Sidebar, Accordion, AccordionTab, VueMultiselect },
    props: {
        id: Number
    },
    data() {
        return {
            visible: false,
            user: {
                matricule: '',
                username: '',
                nom: '',
                prenom: '',
                email: '',
                role: '',
                uadmArray:[]

            },
            options: [],
            value: [],
            isLoad: false
        };
    },
    mounted() {
        this.getUadm()
        this.getUadmUser()
    },
    methods: {
        async open() {
            this.visible = true
            console.log(this.id)
            try {
                const response = await Axios.get(`/find/${this.id}`)
                var data = response.data.user
                this.user = {
                    matricule: data.matricule,
                    username: data.username,
                    nom: data.nom,
                    prenom: data.prenom,
                    email: data.email,
                    role: data.role,
                }
            } catch (error) {
                console.log("error dans l'axios: ", error)
            }
        },
        async updateUser() {
            console.log(this.id)
            this.isLoad = true
            var SecArray = []
            this.value.forEach(element => { 
                SecArray.push(element.uadm_code)
            });
            this.user.uadmArray = SecArray
            if (SecArray != '') {
                try {
                    const response = await Axios.post(`/update/${this.id}`, this.user)
                    console.log(response.data)

                } catch (error) {
                    console.log("error dans l'axios: ", error)
                } finally {
                    this.isLoad = false
                }
            }
        },
        getUadm() {

            Axios.get('/uadm').then((response) => {
                if (response.status == 200) {
                    this.options = response.data.dataSection
                }
            }).catch((error) => {
                console.log("error dans l'axios: ", error)
            })
        },
        getUadmUser() {

            Axios.get(`/getUserUadm/${this.id}`).then((response) => {
                if (response.status == 200) {
                    this.value = response.data.UadmDeUser
                }
            }).catch((error) => {
                console.log("error dans l'axios: ", error)
            })
        },
        // getUserUadm
        updateSelected(newValue) {
            console.log(typeof newValue);
            this.value = newValue;
            this.$emit("update:modelValue", newValue);
        },
    }
}
</script>