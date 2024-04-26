<template>
    <div class="mt-10 mb-10 md:ml-64">
        <div class="container flex flex-col justify-center items-center mt-[150px]">
            <div
                class="relative flex flex-col items-center rounded-[20px] h-[500px] w-[600px] mx-auto p-2 bg-white bg-clip-border shadow-sm shadow-gray-500  dark:text-white ">
                <div class="relative flex h-[150px] w-full justify-center rounded-xl">
                    <div 
                        class="flex h-full w-full justify-center bg-gradient-to-r from-green-font to-green-pri rounded-xl bg-cover" alt="Photo de couverture">
                    </div>
                    <div
                        class="absolute -bottom-12 flex h-[87px] w-[87px] items-center text-green-sec hover:text-gray-500 justify-center rounded-full border-[4px] hover:border-green-sec border-white bg-[#79bd7011] dark:!border-navy-700">
                        <img class="h-full w-full rounded-full object-cover object-center" :src="dataUser.pdp"  alt="Photo de profile" />
                        <ImageModalVue :imagePdp="dataUser.pdp" />
                           
                    </div>
                </div>
                <div class="mt-16 flex flex-col items-center">
                    <h4 class="text-xl font-bold text-green-pri ">
                        {{ dataUser.nom }} {{ dataUser.prenom }} <span class="text-sm text-gray-500">({{ dataUser.username
                        }})</span>
                    </h4>
                    <p class="text-base font-normal text-gray-600">{{ dataUser.role == 'RH' ? 'Resoucce Humaine' :
                        'Administrateur' }}</p>
                </div>
                <div class="bg-gradient-to-r from-green-font to-green-pri w-[550px] h-px  m-3"></div>

                <div class="grid grid-cols-2 gap-4 px-2 w-full">
                    <div
                        class="flex flex-col items-start justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                        <p class="text-sm text-gray-600">Matricule</p>
                        <p class="text-base font-medium text-navy-700 text-green-pri">
                            {{ dataUser.matricule }}
                        </p>
                    </div>
                    <div
                        class="flex flex-col justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                        <p class="text-sm text-gray-600">Email</p>
                        <p class="text-base font-medium text-navy-700 text-green-pri">
                            {{ dataUser.email }}
                        </p>
                    </div>
                    <div
                        class="flex flex-col items-start justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                        <p class="text-sm text-gray-600">Nom</p>
                        <p class="text-base font-medium text-navy-700 text-green-pri">
                            {{ dataUser.nom }}
                        </p>
                    </div>
                    <div
                        class="flex flex-col justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                        <p class="text-sm text-gray-600">Prenom</p>
                        <p class="text-base font-medium text-navy-700 text-green-pri">
                            {{ dataUser.prenom }}
                        </p>
                    </div>
                </div>
                <div class="bg-gradient-to-r from-green-font to-green-pri w-[550px] h-px "></div>
                <div class="flex justify-start w-[540px]">
                    <div class="text-right mt-4 flex  items-center justify-around">
                        <modal-profile></modal-profile>
                        <change-password></change-password>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import Axios from "@/_service/caller.service";
import ModalProfile from '@/components/ProfileModal/ModalProfile.vue';
import ImageModalVue from '@/components/ProfileModal/ImageModal.vue';
import ChangePassword from "@/components/ProfileModal/ChangePassword.vue";
export default {
    name: 'Profile',
    components: {
        ModalProfile,ImageModalVue,ChangePassword
    },
    data() {
        return {
            dataUser: [],
            imagePdp:null
        }
    },
    mounted() {
        try {
            const token = JSON.parse(localStorage.getItem("token"));
            if (token) {
                Axios.get('/auth/user').then(response => {
                    this.dataUser = response.data
                    
                }).catch(error => {
                    console.log("error dans l'axios: ", error)
                })
            }
        } catch (error) {
            console.log(error)
        }
    },

}
</script>