<template>
<div>
<!-- <CChartBar
    style="height:200px"
    :datasets="[
      {
        data: this.new_users,
        backgroundColor: '#3490dc',
        label: 'New Users',
      },
      {
        data: this.active_users,
        backgroundColor: '#38c172',
        label: 'Active Users',
      },
      {
        data: this.page_views,
        backgroundColor: '#f6993f',
        label: 'Page Views',
      }
    ]"
    :labels="this.labels"
    :options="{ maintainAspectRatio: false  }"
  /> -->

  <CChartBar
    style="height:200px"
    :datasets="[
      {
        data: this.new_users,
        backgroundColor: '#3490dc',
        label: 'New Users',
      },
      {
        data: this.active_users,
        backgroundColor: '#38c172',
        label: 'Active Users',
      }
    ]"
    :labels="this.labels"
    :options="{ maintainAspectRatio: false  }"
  />
</div>
</template>

<script>
export default {
    name: 'ChartWidget',
    data(){
      return{
        labels: [],
        new_users: [],
        // page_views: [],
        active_users: []
      }
    },
    async mounted(){
      
      this.chartData();
    },
    methods:{
      async chartData(){
        const chartDatas = await axios.get('/admin/api/chart');
        const datas = chartDatas.data;
        this.labels = datas.labels;
        this.new_users = datas.new_users;
        // this.page_views = datas.page_views;
        this.active_users = datas.active_users;
      }
    }
}
</script>