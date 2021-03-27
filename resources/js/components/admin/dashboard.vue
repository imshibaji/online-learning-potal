<template>
<div>
  <CRow>
    <CCol col="12" sm="3">
      <CWidgetIcon
        :header="'₹'+formatPrice(income)"
        text="Income"
        color="primary">
        <CIcon name="cil-speedometer"/>
      </CWidgetIcon>
    </CCol>

    <CCol col="12" sm="3">
      <CWidgetIcon
        :header="'₹'+formatPrice(expanse)"
        text="Expanses"
        color="danger">
        <CIcon name="cil-money"/>
      </CWidgetIcon>
    </CCol>

     <CCol col="12" sm="3">
      <CWidgetIcon
        :header="online"
        text="Online Users"
        color="success">
        <CIcon name="cil-people"/>
      </CWidgetIcon>
    </CCol>

    <CCol col="12" sm="3">
      <CWidgetIcon
        :header="allUser"
        text="Total Users"
        color="dark">
        <CIcon name="cil-user-follow"/>
      </CWidgetIcon>
    </CCol>
  </CRow>


<CRow>
  <CCol>
    <ChartWidget />
  </CCol>
</CRow>
<CRow>
  <CCol>
    <QuickView />
  </CCol>
</CRow>
</div>
</template>

<script>
import ChartWidget from './common/widget2';
import QuickView from './common/widget4';

export default {
    name: 'App',
    components:{
      ChartWidget,
      QuickView
    },
    data(){
      return{
        income: 0,
        expanse: 0,
        online: '0',
        allUser: '0'
      }
    },
    async mounted(){
      this.getDatas();
      
      setInterval(this.getDatas, 36000);
    },
    methods: {
        async getDatas(){
          const users = await axios.get('/admin/api/users');
          const income = await axios.get('/admin/api/income');
          const expanse = await axios.get('/admin/api/expanse');
          const online = await axios.get('/admin/api/online');

          this.income = income.data;
          this.expanse = expanse.data;
          this.online = online.data.toString();
          this.allUser = users.data.length.toString();
          // console.log(this.online);
        },
        formatPrice(value) {
            // let val = (value/1).toFixed(2).replace('.', ',')
            let val = (value/1).toFixed(2);
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        }
    }
}
</script>
