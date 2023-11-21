<template>
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
            <!-- <div class="mt-6 mb-3 flex gap-14 md:!gap-14">
                <div class="flex flex-col items-center justify-center">
                    <p class="text-2xl font-bold text-green-pri ">17</p>
                    <p class="text-sm font-normal text-gray-600">Posts</p>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <p class="text-2xl font-bold text-green-pri ">
                        9.7K
                    </p>
                    <p class="text-sm font-normal text-gray-600">Followers</p>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <p class="text-2xl font-bold text-green-pri ">
                        434
                    </p>
                    <p class="text-sm font-normal text-gray-600">Following</p>
                </div>
            </div> -->
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
                    <p class="text-sm text-gray-600">Tele</p>
                    <p class="text-base font-medium text-navy-700 text-green-pri">
                        {{ dataUser.telephone }}
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
                    <button @click.prevent="enregistrement()"
                        class="bg-white hover:bg-green-pri hover:text-white text-green-pri border  border-green-pri transition duration-200 font-bold py-2 px-4 rounded">
                        Modifier
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import { jwtDecode } from 'jwt-decode';

export default {
    name: 'Profile',
    data() {
        return {
            dataUser: []
        }
    },
    mounted() {
        try {
            const token = JSON.parse(localStorage.getItem("token"));
            if (token) {
                const decodedToken = jwtDecode(token)
                this.dataUser = decodedToken
                console.log(this.dataUser)
            }
        } catch (error) {
            console.log(error)
        }
    },

}
</script>