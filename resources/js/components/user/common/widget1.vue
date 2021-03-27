<template>
<div>
    <CRow>
    <CCol col="12" sm="3">
      <CWidgetIcon
        :header=getTotalAmt()
        text="Total Paid Amount"
        color="primary">
        <CIcon name="cil-money"/>
      </CWidgetIcon>
    </CCol>

    <CCol col="12" sm="3">
      <CWidgetIcon
        :header=getDueAmt()
        text="Balance Amount"
        color="info">
        <CIcon name="cil-wallet"/>
      </CWidgetIcon>
    </CCol>

     <CCol col="12" sm="3">
      <CWidgetIcon
        :header=getTotalLearningPoints()
        text="Learning Points"
        color="success">
        <CIcon name="cil-school"/>
      </CWidgetIcon>
    </CCol>

    <CCol col="12" sm="3">
      <CWidgetIcon
        :header=getGems()
        text="Gems"
        color="dark">
        <CIcon name="cil-gem"/>
      </CWidgetIcon>
    </CCol>
  </CRow>
</div>
</template>

<script>
export default {
    name: 'UserActivity',
    mounted(){
      axios.get('/api/info').then(res =>{
        const user = res.data;
        this.totalAmt = user.totalAmt;
        this.dueAmt = user.dueAmt;
        this.learning = user.learning;
        this.earning = user.earning;
      });
    },
    data: function(){
      return {
        totalAmt: '0',
        dueAmt: '0',
        learning: '0',
        earning: '0'
      };
    },
    methods:{
        getTotalAmt(){
            return '₹'+ this.totalAmt;
        },
        getDueAmt(){
            return '₹'+this.dueAmt;
        },
        getTotalLearningPoints(){
            return ''+this.learning;
        },
        getGems(){
            return ''+this.earning;
        },
    }
}
</script>