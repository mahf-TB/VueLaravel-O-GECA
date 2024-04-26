<template>
  <div class="mt-10 mb-10  md:ml-56">
    <div class=" h-[330px] ">
      <div class="flex-1 bg-white p-4 h-full shadow rounded-lg ">
        <h2 class="text-gray-500 text-lg font-semibold">Agents ayant de HEE</h2>
        <div class="my-1"></div>
        <div class="bg-gradient-to-r from-green-font to-green-pri h-px mb-1"></div>
        <div class="table-auto overflow overflow-y-auto  h-[250px] " style="position: relative; ">
          <!-- content -->
          <TableHeeDash :dataList="dataList" />
        </div>
      </div>
    </div>
    <!-- main content page -->
    <div class="w-full p-4 mt-10">
      <CardStatVue />
    </div>

  </div>
</template>

<script>
import CardStatVue from '@/components/CardStat.vue'
import Axios from '@/_service/caller.service';
import TableHeeDash from '@/views/DataTable/TableHeeDash.vue';
export default {
  name: 'HomePage',
  components: {
    CardStatVue,TableHeeDash
  },
  data() {
    return {
      dataList:null
    }
  },
  mounted() {
    // this.getCount();
  },
  methods:{

    },
  }


</script>