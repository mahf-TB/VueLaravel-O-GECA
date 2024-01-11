<template>
    <div>
        <Dialog v-model:visible="visible" modal header="Information sur un agent" :style="{ width: '70rem' }"
            :breakpoints="{ '1199px': '75vw', '575px': '90vw' }">
            <div class="relative py-8 px-5 md:px-10 bg-white shadow-md rounded border border-gray-400">
                <div class="flex">
                    <div class="w-full">
                        <!-- matricule -->
                        <label for="mat" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                            Matricule<span class="text-red-500">*</span></label>
                        <h4
                            class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border  font-normal w-full h-10 flex items-center pl-3 text-sm bg-gray-200  border-gray-100 rounded border">
                            {{ dataAgent.agent_matricule }}
                        </h4>
                    </div>
                    <!-- prenom -->
                    <div class="w-full ml-1">
                        <label for="name2" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                            Nom et Prenom <span class="text-red-500">*</span></label>
                        <h4
                            class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border  font-normal w-full h-10 flex items-center pl-3 text-sm bg-gray-200  border-gray-100 rounded border">
                            {{ dataAgent.noms }}
                        </h4>
                    </div>
                </div>
                <div class="flex">
                    <!-- nom -->
                    <div class="w-full">
                        <label for="name1" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                            CIN <span class="text-red-500">*</span></label>
                        <h4
                            class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border  font-normal w-full h-10 flex items-center pl-3 text-sm bg-gray-200  border-gray-100 rounded border">
                            {{ dataAgent.cin }}
                        </h4>
                    </div>
                    <!-- prenom -->
                    <div class="w-full ml-1">
                        <label for="name2" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                            Status</label>
                        <h4
                            class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border  font-normal w-full h-10 flex items-center pl-3 text-sm bg-gray-200  border-gray-100 rounded border">
                            {{ dataAgent.status }}
                        </h4>
                    </div>
                </div>
                <div class="flex">
                    <!-- nom -->
                    <div class="w-full">
                        <label for="name1" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                            Corps <span class="text-red-500">*</span></label>
                        <h4
                            class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border  font-normal w-full h-10 flex items-center pl-3 text-sm bg-gray-200  border-gray-100 rounded border">
                            {{ dataAgent.corps }}
                        </h4>

                    </div>
                    <!-- prenom -->
                    <div class="w-full ml-1">
                        <label for="name2" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                            Grade</label>
                        <h4
                            class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border  font-normal w-full h-10 flex items-center pl-3 text-sm bg-gray-200  border-gray-100 rounded border">
                            {{ dataAgent.grade }}
                        </h4>
                    </div>
                </div>
                <div class="flex">
                    <!-- nom -->
                    <div class="w-full">
                        <label for="name1" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                            Dernière Avancement <span class="text-red-500">*</span></label>
                        <h4
                            class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border  font-normal w-full h-10 flex items-center pl-3 text-sm bg-gray-200  border-gray-100 rounded border">
                            {{ dataAgent.dernier_avance }}
                        </h4>
                    </div>
                    <!-- prenom -->
                    <div class="w-full ml-1">
                        <label for="name2" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                            Prochaine Avancement</label>
                        <h4
                            class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border  font-normal w-full h-10 flex items-center pl-3 text-sm bg-gray-200  border-gray-100 rounded border">
                            {{ dataAgent.prochaine_avance }}
                        </h4>
                    </div>
                </div>
                <div class="flex">
                    <!-- nom -->
                    <div class="w-full">
                        <label for="name1" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                            UADM<span class="text-red-500">*</span></label>
                        <h4
                            class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border  font-normal w-full h-10 flex items-center pl-3 text-sm bg-gray-200  border-gray-100 rounded border">
                            {{ dataAgent.uadm }}
                        </h4>
                    </div>
                    <!-- prenom -->
                    <div class="w-full ml-1">
                        <label for="name2" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                            District</label>
                        <h4
                            class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border  font-normal w-full h-10 flex items-center pl-3 text-sm bg-gray-200  border-gray-100 rounded border">
                            {{ dataAgent.district }}
                        </h4>
                    </div>
                </div>
                <div class="flex">
                    <!-- nom -->
                    <div class="w-full">
                        <label for="name1" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                            Section<span class="text-red-500">*</span></label>
                        <h4
                            class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border  font-normal w-full h-10 flex items-center pl-3 text-sm bg-gray-200  border-gray-100 rounded border">
                            {{ dataAgent.section }}
                        </h4>
                    </div>
                    <!-- prenom -->
                    <div class="w-full ml-1">
                        <label for="name2" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                            Minister</label>
                        <h4
                            class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border  font-normal w-full h-10 flex items-center pl-3 text-sm bg-gray-200  border-gray-100 rounded border">
                            {{ dataAgent.ministere }}
                        </h4>
                    </div>
                </div>
            </div>
        </Dialog>

        <a @click.prevent="open()" title="Suspend user" class="text-[#e1b14f] hover:text-[#ebc371]">
            <i class="fa-solid fa-file" style="font-size: 1.3rem"></i>
        </a>
    </div>
</template>
<script>
import Axios from "@/_service/caller.service";
import Dialog from 'primevue/dialog';
import SpeedDial from 'primevue/speeddial';

export default {
    name: 'ModalDetailler',
    props: {
        id: Number
    },
    components: {
        Dialog, SpeedDial
    },
    data() {
        return {
            visible: false,
            dataAgent: {
                agent_matricule: '',
                noms: '',
                cin: '',
                status: '',
                corps: '',
                grade: '',
                dernier_avance: '',
                prochaine_avance: '',
                district: '',
                uadm: '',
                section: '',
                ministere: '',

            }
        }
    },
    mounted() {
    },
    computed: {

    },
    methods: {
       async open() {
            this.visible = true
           console.log(this.id)
            try {
                const response = await  Axios.get(`/indexDetaille/${this.id}`)
                console.log(response.data.DataAgents[0])
                var data = response.data.DataAgents[0];
                this.dataAgent = {
                agent_matricule: data.agent_matricule,
                noms: data.noms,
                cin: data.CIN,
                status: data.status,
                corps: data.corps,
                grade: data.grade,
                dernier_avance: data.dernier_avance,
                prochaine_avance: data.prochaine_avance,
                district: data.district,
                uadm: data.uadm,
                section: data.section,
                ministere: data.ministere,

            }
            } catch (error) {
                console.log("error dans l'axios: ", error)
            } finally {
                this.isLoad = false
            }
        },
      
    }
}

</script>
