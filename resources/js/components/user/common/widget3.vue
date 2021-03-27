<template>
<div>
<h5 class="text-center my-2">Learning and Acheivements</h5>
<CRow>
    <CCol sm="12" lg="4">
      <CWidgetSimple header="Design" text="Thinking Ability">
        <CProgress
          animated
          color="danger"
          height="0.8rem"
          :value=getDesign()
          :showValue="true"
        />
      </CWidgetSimple>
    </CCol>
    <CCol sm="12" lg="4">
      <CWidgetSimple header="Development" text="Coding Understanding">
        <CProgress
          animated
          color="primary"
          height="0.8rem"
          :value=getDevelopment()
          :showValue=true
        />
      </CWidgetSimple>
    </CCol>
    <CCol sm="12" lg="4">
      <CWidgetSimple header="Debugging" text="Problem Solving">
        <CProgress
          animated
          color="success"
          height="0.8rem"
          :value=getDebugging()
          :showValue=true
        />
      </CWidgetSimple>
    </CCol>
  </CRow>
</div>
</template>

<script>
export default {
    name: 'ReportActivity',
    data: function(){
      return{
        design: 0,
        develop: 0,
        debug: 0
      }
    },
    async mounted(){
        const udata = await axios.get('/api/info');
        const mdata = udata.data;
        this.design = mdata.total_design;
        this.develop = mdata.total_develop;
        this.debug = mdata.total_debug;
    },
    methods:{
        getDesign(){
            return this.design;
        },
        getDevelopment(){
            return this.develop;
        },
        getDebugging(){
            return this.debug;
        }
    }
}
</script>