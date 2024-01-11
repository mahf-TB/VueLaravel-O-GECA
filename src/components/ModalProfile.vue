<template>
    <div>
        <Dialog v-model:visible="visible" modal header="Modification des information " :style="{ width: '50rem' }"
            :breakpoints="{ '1199px': '75vw', '575px': '90vw' }">
        <div>
            <img src="" alt="">
        </div>
        </Dialog>

        <!-- class="bg-green-pri hover:bg-green-pri hover:text-white text-green-pri border  border-green-pri transition duration-200 font-bold py-2 px-4 rounded" -->
        <div :style="{ position: 'relative', height: '50px' }" class="text-white   transition duration-200 font-bold ">
                <SpeedDial :model="items" class="hover:text-white  border-green-pri" direction="right" :style="{ top: 'calc(50% - 2rem)',  }" />
        </div>
    </div>
</template>
<script>
import Axios from "@/_service/caller.service";
import Dialog from 'primevue/dialog';
import SpeedDial from 'primevue/speeddial';

export default {
    name: 'ModalProfile',
    components: {
        Dialog, SpeedDial
    },
    data() {
        return {
            visible: false,
            items: [
                {
                    label: 'Add',
                    icon: 'pi pi-pencil',
                    alt : 'modifier u',
                    command: () => {
                        this.$toast.add({ severity: 'info', summary: 'Add', detail: 'Data Added' });
                    }
                },
                {
                    label: 'Update',
                    icon: 'pi pi-external-link',
                    alt : 'modifier',
                    command: () => {
                        this.$toast.add({ severity: 'success', summary: 'Update', detail: 'Data Updated' });
                    }
                },
                {
                    label: 'Delete',
                    icon: 'pi pi-trash',
                    command: () => {
                        this.$toast.add({ severity: 'error', summary: 'Delete', detail: 'Data Deleted' });
                    }
                },
            ]

        }
    }
}

</script>
<style>
/* class="p-button p-ocmponent p-button-icon-only p-speeddial-button p-button-rounded p-speeddial-rotate" */
.p-component > button{
    background: #12b659;
    color:#FFF;
    margin-right: 5px;
}
</style>