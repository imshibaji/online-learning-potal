<template>
<CDataTable
    :items="all_items"
    :fields="fields"
    table-filter
    items-per-page-select
    sorter
    pagination
    :itemsPerPage="5"
  >

    <template #show_details="{item, index}">
      <td class="py-2">
        <CButton
          class="btn-block"
          color="primary"
          variant="outline"
          square
          size="sm"
          @click="toggleDetails(index)"
        >
          {{details.includes(index) ? 'Hide' : 'Show'}}
        </CButton>
      </td>
    </template>

    <template #details="{item, index}">
      <CCollapse :show="details.includes(index)">
        <CCardBody>
          <h3 class="text-center">Report Section</h3>
          <table class="table">
            <tr>
              <th class="text-center">Design: {{item.assesment.design}}</th>
              <th class="text-center">Develop: {{item.assesment.development}}</th>
              <th class="text-center">Debug: {{item.assesment.debug}}</th>
              <th class="text-center">Total: {{item.assesment.total}}</th>
            </tr>
          </table>
            <div class="container">
                <CRow v-for="report in item.assesment.report" :key="report.title">
                    <CCol class="box">
                        <h6>Qid: {{report.qid}}</h6>
                        <div v-html="report.title"></div>
                        <h6 class="text-black">Answer:</h6>
                        <div v-html="report.user_answer"></div>
                        <hr>
                        <div><strong>Remark:</strong> {{report.remark}}</div>
                        <hr>
                        <h6>Correct Answer</h6>
                        <div v-html="report.answer"></div>
                    </CCol>
                </CRow>
            </div>
        </CCardBody>
      </CCollapse>
    </template>

</CDataTable>
</template>

<style scoped>
.box{
    /* border: 1px solid blue; */
    background-clip: #eee;
    padding: 15px;
    margin: 5px 0px;
}
</style>

<script>
export default {
    name: 'UsersAssesment',
    data(){
        return{
            fields: [],
            items: [],
            users: [],
            topics: [],
            courses: [],
            details: [],
            all_items: []
        }
    },
    async mounted(){
        const assesment = await axios.get('/admin/api/assesment');

        this.fields = [
            {key: 'id'},
            {key: 'user'},
            {key: 'course'},
            {key: 'topic'},
            {key: 'show_details'}
        ];

        this.items = assesment.data[0];
        this.users = assesment.data[1];
        this.topics = assesment.data[2];
        this.courses = assesment.data[3];
    
        this.all_items = this.items.map((req)=>{
            return {
                id: req.id,
                user: this.users[req.user_id - 1].fname+ ' '+this.users[req.user_id - 1].lname,
                topic: this.topics[req.topic_id - 1].title,
                course: this.courses[this.topics[req.topic_id - 1].course_id - 1].title,
                assesment: JSON.parse(req.assesment)
            };
        });

        // console.log(this.all_items);
        
    },
    methods:{
        toggleDetails (index) {
            const position = this.details.indexOf(index)
            position !== -1 ? this.details.splice(position, 1) : this.details.push(index)
        }
    }
}
</script>