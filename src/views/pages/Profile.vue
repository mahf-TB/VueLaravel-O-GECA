<template>
    <div class="mt-10 mb-10 md:ml-64">
        <div class="container flex flex-col justify-center items-center mt-[150px]">
            <div
                class="relative flex flex-col items-center rounded-[20px] h-[500px] w-[600px] mx-auto p-4 bg-white bg-clip-border shadow-3xl shadow-shadow-500 dark:!bg-navy-800 dark:text-white dark:!shadow-none">
                <div class="relative flex h-32 w-full justify-center rounded-xl bg-cover">
                    <img src='https://horizon-tailwind-react-git-tailwind-components-horizon-ui.vercel.app/static/media/banner.ef572d78f29b0fee0a09.png'
                        class="absolute flex h-32 w-full justify-center rounded-xl bg-cover">
                    <div
                        class="absolute -bottom-12 flex h-[87px] w-[87px] items-center justify-center rounded-full border-[4px] border-white bg-[#79bd7011] dark:!border-navy-700">
                        <img class="h-full w-full rounded-full"
                            src='https://horizon-tailwind-react-git-tailwind-components-horizon-ui.vercel.app/static/media/avatar11.1060b63041fdffa5f8ef.png'
                            alt="" />
                    </div>
                </div>
                <div class="mt-16 flex flex-col items-center">
                    <h4 class="text-xl font-bold text-green-pri ">
                        {{ dataUser.nom }} {{ dataUser.prenom }}
                    </h4>
                    <p class="text-base font-normal text-gray-600">{{ dataUser.role }}</p>
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
                    <div class="text-right mt-4">
                        <modal-profile></modal-profile>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import Axios from "@/_service/caller.service";
import ModalProfile from '@/components/ModalProfile.vue';
export default {
    name: 'Profile',
    components: {
        ModalProfile
    },
    data() {
        return {
            dataUser: []
        }
    },
    mounted() {
        try {
            const token = JSON.parse(localStorage.getItem("token"));
            if (token) {
                Axios.get('/auth/user').then(response => {
                    console.log(response.data)
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