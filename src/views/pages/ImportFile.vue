<template>
  <div class="mt-10 mb-10 md:ml-64">
    <div class="bg-white-500  sm:px-8 md:px-16 sm:py-8">
      <main class="container mx-auto max-w-screen-lg h-full">
        <!-- file upload modal -->
        <article aria-label="File Upload Modal" class="relative h-full flex flex-col bg-white shadow-xl rounded-md">
          <!-- scroll area -->
          <section class="h-full overflow-auto p-8 w-full flex flex-col">
            <header class="border-dashed border-2 border-gray-400 py-12 flex flex-col justify-center items-center">
              <p class="mb-3 font-semibold text-gray-900 flex flex-wrap justify-center">
                <span>Faites glisser et déposez votre</span>&nbsp;<span>fichiers n'importe où ou</span>
              </p>
              <input id="hidden-input" type="file" @change="handleFileChange" multiple class="hidden" />
              <label for="hidden-input"
                class="mt-2 rounded-sm px-3 py-1 bg-gray-200 hover:bg-gray-300 focus:shadow-outline focus:outline-none">
                Télécharger un fichier
              </label>
            </header>
            <h1 class="pt-8 pb-3 font-semibold sm:text-lg text-gray-900">
              Télécharger
            </h1>
            <ul id="gallery" class="flex flex-1 flex-wrap -m-1">
              <li v-if="empty" class="h-full w-full text-center flex flex-col justify-center items-center">
                <span class="text-small text-gray-500">Aucun fichier sélectionné</span>
              </li>
              <li v-if="emptyFile" class="block p-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 xl:w-1/8 h-24">
                <article tabindex="0"
                  class="group w-full h-full rounded-md focus:outline-none focus:shadow-outline elative bg-gray-100 cursor-pointer relative shadow-sm">
                  <section
                    class="flex flex-col rounded-md text-xs break-words w-full h-full z-20 absolute top-0 py-2 px-3">
                    <h1 class="flex-1 group-hover:text-blue">{{ name }}</h1>
                    <div class="flex">
                      <span class="p-1 text-blue-800">
                        <i>
                          <svg class="fill-current w-4 h-4 ml-auto pt-1" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24">
                            <path d="M15 2v5h5v15h-16v-20h11zm1-2h-14v24h20v-18l-6-6z" />
                          </svg>
                        </i>
                      </span>
                      <p class="p-1 size text-xs text-gray-700">{{ size }}</p>
                      <button @click="deleteFile()"
                        class="delete ml-auto focus:outline-none hover:bg-gray-300 p-1 rounded-md text-gray-800">
                        <svg class="pointer-events-none fill-current w-4 h-4 ml-auto" xmlns="http://www.w3.org/2000/svg"
                          width="24" height="24" viewBox="0 0 24 24">
                          <path class="pointer-events-none"
                            d="M3 6l3 18h12l3-18h-18zm19-4v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.316c0 .901.73 2 1.631 2h5.711z" />
                        </svg>
                      </button>
                    </div>
                  </section>
                </article>
              </li>
            </ul>
          </section>
          <!-- sticky footer -->
          <footer class="flex justify-end px-8 pb-8 pt-4">
            <button @click="submitFile()" :disabled="save" :class="classeSave"
              class="flex justify-between items-center rounded-sm px-3 py-1 bg-green-pri text-white focus:shadow-outline focus:outline-none">
              <i v-if="isLoad" class="pi pi-spin pi-spinner mr-2" style="font-size: 1rem"></i>Importer Maintenant
            </button>
            <button @click.prevent="reinitAgents()"
              class="ml-3 rounded-sm px-3 py-1 bg-red-600 hover:bg-red-500 text-white focus:shadow-outline focus:outline-none">
              Reinitialliser
            </button>
            <Toast />
          </footer>
        </article>
      </main>
    </div>
  </div>
</template>
  
<script>
import ProgressBar from 'primevue/progressbar';
import { useToast } from 'primevue/usetoast';
import Axios from "@/_service/caller.service";
import Toast from 'primevue/toast';
import Swal from 'sweetalert2';

export default {
  name: 'ImportFile',
  components: {
    ProgressBar,
    Toast
  },
  data() {
    return {
      selectedFile: null,
      empty: true,
      emptyFile: false,
      name: '',
      size: '',
      value: 0,
      isLoad: false,
      save:true,
      classeSave:'disabled:opacity-75'
    }
  },
  methods: {
    handleFileChange(event) {
      this.selectedFile = event.target.files[0];
      console.log(this.selectedFile)
      if (this.selectedFile) {
        this.classeSave =''
        this.save=false
        this.empty = false
        this.emptyFile = true
        this.name = this.selectedFile.name
        this.size = this.selectedFile.size > 1024
          ? this.selectedFile.size > 1048576
            ? Math.round(this.selectedFile.size / 1048576) + "Mo"
            : Math.round(this.selectedFile.size / 1024) + "Ko"
          : this.selectedFile.size + "o";
      }
    },
    deleteFile() {
      this.selectedFile = null;
      if (this.selectedFile == null) {
        this.empty = true
        this.emptyFile = false
      }
    },
    submitFile() {
      if (!this.selectedFile) {
        console.error('Aucun fichier sélectionné.');
        return;
      }
      const formData = new FormData();
      formData.append('file_agents', this.selectedFile);
      this.classeSave ='disabled:opacity-75'
      this.isLoad = true
      this.save=false
      Axios.post('/import', formData).then((response) => {
        console.log(response.data);
        if (response.data.status == 201) {
          this.isLoad = false
          Swal.fire({
            title: 'Successfuly...!',
            text: "importation des données success!",
            icon: 'success',
            timer: 1000
          });
          this.deleteFile()
        } else if (response.data.status == 500) {
          this.isLoad = false
          Swal.fire({
            title: 'Error...!',
            title: `Echec lors de l'importation`,
            icon: 'error',
            timer: 1000
          })
        }
      }).catch((error) => {
        console.log("error dans l'axios: ", error)
        Swal.fire({
            title: 'Error...!',
            title: `Bad error: ${error.message}`,
            icon: 'error',
            timer: 4000
          })
        this.isLoad = false
      })

    },

  },
  // reinit
  setup() {
    const toast = useToast();

    const reinitAgents = async () => {
      const result = await Swal.fire({
        title: 'Êtes-vous sûr de vouloir supprimer tout agents?',
        text: "Cette action est irréversible!",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Annuler',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Oui, vider-le!'
      });
      if (result.isConfirmed) {
        Axios.get('/auth/reinit').then((response) => {
          if (response.data.status == 201) {
            console.log(response.data.message)
            toast.add({ severity: 'success', summary: 'Successful', detail: `${response.data.message}`, life: 3000 });
          }
        }).catch((error) => {
          console.log("error dans l'axios: ", error)
        })
      }
    }
    return {
      reinitAgents
    }
  }
}
</script>
