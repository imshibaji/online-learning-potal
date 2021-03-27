<template>
  <CDataTable
    :items="items"
    :fields="fields"
    table-filter
    items-per-page-select
    hover
    sorter
    pagination
    :itemsPerPage="10"
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
          <h3 class="text-center">Payment Details</h3>
          <table class="table">
            <tr>
              <th class="text-center">Buyer Name: {{item.buyer_name}}</th>
              <th class="text-center">Email: {{item.email}}</th>
              <th class="text-center">Phone: {{item.phone}}</th>
              <th class="text-center">Payment Status Check: <a :href="item.longurl" target="blank">Check Details</a></th>
            </tr>
          </table>
        </CCardBody>
      </CCollapse>
    </template>

  </CDataTable>
</template>
<script>
export default {
    name: 'PaymentInfo',
    data() {
        return{
            fields:[],
            items: [],
            details: []
        }
    },
    async mounted(){
       const pay = await axios.get('/admin/api/paymentInfo');
       const payments = pay.data[0];
       const users = pay.data[1];
    //    const courses = pay.data[2];

       this.fields = [
          //  {key: 'payment_id'},
           {key: 'purpose'},
           {key: 'amount'},
           {key: 'user', label: 'Buy for'},
           {key: 'payment_status', label: 'status'},
           {key: 'show_details', label: 'Action'}
       ];

       this.items = payments.map((res)=>{
           const item = res;
           item.user = users[res.user_id - 1].fname +' '+users[res.user_id - 1].lname;
        //    item.course = courses[res.course_id - 1].title;
           return item;
       })

        // console.log(this.items);
        
    },
    methods:{
        toggleDetails (index) {
            const position = this.details.indexOf(index)
            position !== -1 ? this.details.splice(position, 1) : this.details.push(index)
        }
    }
}
</script>