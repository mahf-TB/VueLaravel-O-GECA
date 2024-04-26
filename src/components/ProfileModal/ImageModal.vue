<template>
    <div>
        <Dialog v-model:visible="visible" modal header="Ajouter une photo de profile"
            :style="{ width: '500px', height: '540px' }">
            <div class="bg-white  text-center max-w-[500px] max-h-[550px]">
                <h7 class="text-[18px] text-gray-400 mt-2 mb-2">Votre photo de profil aide les autres utilisateurs à vous
                    reconnaître
                    et vous permet de savoir quand vous êtes connecté à votre compte.</h7>
                <img class="mt-5 w-[250px] h-[250px] object-cover rounded-full shadow-lg mx-auto" :src="imageFile"
                    alt="product designer">
                <div class="flex items-center justify-around m-8 mb-2">
                    <label for="image-input" v-if="!isSave"
                        class="bg-green-pri hover:bg-green-sec text-white uppercase  py-2 px-4  rounded">
                        <input id="image-input" type="file" @change="handleFileChange" multiple class="hidden" />
                        <i class="fa-solid fa-pen mr-2"></i> Modifier
                    </label>
                    <button v-if="isSave" @click.prevent="uploadImage()"
                        class="bg-green-pri hover:bg-green-sec text-white uppercase py-2 px-4  rounded">
                        <i class="fa-solid fa-pen mr-2"></i> Enregistrer
                    </button>
                    <button @click.prevent="supprime()"
                        class="bg-green-pri hover:bg-green-sec text-white uppercase  py-2 px-4  rounded">
                        <i class="fa-solid fa-trash-can mr-2"></i> Supprimer
                    </button>
                </div>
            </div>
        </Dialog>
        <i @click="open()" class="fa-solid fa-camera-rotate absolute bottom-1 -right-1 text-[18px] cursor-pointer"></i>
    </div>
</template>
<script>
import Axios from "@/_service/caller.service";
import Dialog from 'primevue/dialog';
import SpeedDial from 'primevue/speeddial';
export default {
    name: 'ImageModal',
    components: {
        Dialog, SpeedDial
    },
    props:{
        imagePdp:Object
    },
    data() {
        return {
            visible: false,
            image: '',
            imgURL:null ,
            isSave: false
        }
    },
    computed: {
        imageFile() {
            if (this.image == '') {
                return this.imagePdp;
            }
            this.imgURL = URL.createObjectURL(this.image)
            console.log(this.imgURL)
            return this.imgURL;
        }
    },
    methods: {
        open() {
            this.visible = true
        },
        handleFileChange(event) {
            console.log(event)
            if (event.target.files.length == 0) {
                return;
            }
            console.log(event.target.files[0].type)
            if (event.target.files[0].type.match("image/*")) {
                this.image = event.target.files[0];
                if (this.image) {
                    this.isSave = true
                }
                this.imgURL = URL.createObjectURL(this.image)
            }
        },

        uploadImage() {
            var donnee = new FormData();
            donnee.append('image', this.image);
            Axios.post('/importImage', donnee).then((response) => {
                console.log(response.data)
                if (response.data.status == 200) {
                    
                    this.visible = false
                }
            }).catch((error) => {
                console.log("error dans l'axios: ", error)
            })
        },
        supprime() {
            this.image = '';
            this.isSave = false
        }
    }
}

</script>

<style>
/* .p-dialog-header-close {
    display: ;
} */
</style>