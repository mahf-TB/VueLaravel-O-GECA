<template>
  <!-- main content page -->
  <div class="mt-2 bg-white p-4 shadow rounded-lg">
        <h2 class="text-gray-500 text-lg font-semibold pb-0">Rechrerche entre deux date</h2>
        <div class="my-1"></div>
        <div class="bg-gradient-to-r from-green-font to-green-pri h-px mb-6"></div>
        <table class="w-full table-auto text-sm">
            <thead>
                <tr class="text-sm leading-normal flex-table">
                    <th
                        class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">
                        <div class="mb-3 space-y-2 w-full text-xs">
                            <label class="font-semibold text-gray-600 py-2">Du</label>
                            <input placeholder="Montant"
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4"
                                required="required" type="date" name="integration[shop_name]" id="integration_shop_name"
                                v-model="montant" />
                        </div>
                    </th>
                    <th
                        class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">
                        <div class="mb-3 space-y-2 w-full text-xs">
                            <label class="font-semibold text-gray-600 py-2">Jusqu'à
                            </label>
                            <input placeholder="Description"
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4"
                                required="required" type="date" name="integration[shop_name]" id="integration_shop_name"
                                v-model="motif" />
                        </div>
                    </th>
                    <th
                        class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light">
                        <div class="mb-3 space-y-2 w-full text-xs">
                            <label class="font-semibold text-gray-600 py-2">Date </label>
                            <input placeholder="Date"
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4"
                                required="required" type="date" name="integration[shop_name]" id="integration_shop_name"
                                v-model="date" />
                        </div>
                    </th>
                </tr>
            </thead>
        </table>
    </div>
  <!-- Tableau de liste de tout les Encaisemment -->
  <TableAvancement :dataList="dataList" />
</template>

<script>
import { jwtDecode } from 'jwt-decode';
import Axios from "@/_service/caller.service";
import TableAvancement from '@/views/DataTable/TableAvancement.vue'

export default {
  name: "Avancement",
  components: {
     TableAvancement
  },
  data() {
    return {
      dataList: null,
      userID: ''

    }
  },
  mounted() {
    this.getAllRecette()
  },
  methods: {
    async getAllRecette() {
      const token = JSON.parse(localStorage.getItem("token"));
      if (token) {
        const decodedToken = jwtDecode(token)
        this.userID = decodedToken.user_id
      }
      var donnee = new FormData();
      donnee.append('userID', parseInt(this.userID));
      Axios.post('/recette.php?action=list', donnee).then((res) => {
        if (res.data.success) {
          console.log("Success...!", res.data.message);
          this.dataList = res.data.donnees
        } else {
          console.log("Error...!", res.data.message);
        }
      }).catch((err) => {
        console.log("error dans l'axios: ", err)
      })

    }
  },

};
</script>