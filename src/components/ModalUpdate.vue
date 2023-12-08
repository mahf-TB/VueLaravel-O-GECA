<template>
    <div>
        <Dialog v-model:visible="visible" modal header="Modification des information " :style="{ width: '50rem' }"
            :breakpoints="{ '1199px': '75vw', '575px': '90vw' }">
            <div>
                <a @click.prevent="EditUser()" title="Edit" class="text-green-pri hover:text-green-sec">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
            </div>
        </Dialog>
        <a @click="visible = true" title="Edit" class="text-green-pri hover:text-green-sec">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>

    </div>
</template>
<script>
import Axios from "@/_service/caller.service";
import Dialog from 'primevue/dialog';
export default {
    name: 'ModalUpdate',
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