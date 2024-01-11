<template>
    <div>
        <Dialog v-model:visible="visible" modal header="Modification des information " :style="{ width: '50rem' }"
            :breakpoints="{ '1199px': '75vw', '575px': '90vw' }">
            <div>
                <h3>Hello dans les Utilisateur Detailler</h3>
            </div>
        </Dialog>
        <a @click.prevent="open()" title="Suspend user" class="text-[#e1b14f] hover:text-[#ebc371]">
            <i class="fa-solid fa-file"></i>
        </a>
    </div>
</template>
<script>
import Axios from "@/_service/caller.service";
import Dialog from 'primevue/dialog';
import SpeedDial from 'primevue/speeddial';

export default {
    name: 'ModalDetailler',
    // props:{
    //     text:String
    // },
    components: {
        Dialog, SpeedDial
    },
    data() {
        return {
            visible: false,
        }
    },
    methods: {
        open() {
            this.visible = true
        }
    }
}

</script>