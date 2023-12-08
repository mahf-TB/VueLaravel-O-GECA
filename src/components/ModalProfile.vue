<template>
    <div>
        <Dialog v-model:visible="visible" modal header="Modification des information "
            :style="{ width: '50rem' }" :breakpoints="{ '1199px': '75vw', '575px': '90vw' }">

        </Dialog>

        <button @click="visible = true"
            class="bg-white hover:bg-green-pri hover:text-white text-green-pri border  border-green-pri transition duration-200 font-bold py-2 px-4 rounded">
            Modifier
        </button>
    </div>
</template>
<script>
import Axios from "@/_service/caller.service";
import Dialog from 'primevue/dialog';
export default {
    name: 'ModalProfile',
    components: {
        Dialog
    },
    data() {
        return {
            visible: false
        }
    }
}

</script>