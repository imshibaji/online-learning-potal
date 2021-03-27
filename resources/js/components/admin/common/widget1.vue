<template>
  <!-- <CDataTable
    :items="items"
    :fields="fields"
    column-filter
    table-filter
    items-per-page-select
    hover
    sorter
    pagination
  > -->
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
    <template #status="{item}">
      <td>
        <CBadge :color="getBadge(item.active)">
          {{ (item.active == 1)? 'Active' : 'Inactive'}}
        </CBadge>
      </td>
    </template>
    <template #show_details="{item, index}">
      <td class="py-2">
        <CButton
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
          <table class="table">
            <tr>
              <th>email:</th>
              <th>WhatsApp:</th>
              <th>JoinAt:</th>
              <th>Details:</th>
            </tr>
            <tr>
              <td>{{item.email}}</td>
              <td>{{item.whatsapp}}</td>
              <td>{{item.join}}</td>
              <td><a class="btn btn-outline-success btn-sm" :href="'/admin/user/view/'+item.id" target="blank">View Details</a></td>
            </tr>
          </table>
        </CCardBody>
      </CCollapse>
    </template>
  </CDataTable>
</template>

<script>
export default {
  name: 'UserTable',
  data () {
    return {
      items: [],
      fields: [],
      details: []
    }
  },
  async mounted(){
    const users = await axios.get('/admin/api/udetails');
    this.fields = [
        { key: 'name'},
        { key: 'email' },
        { key: 'mobile' },
        { key: 'whatsapp' },
        { key: 'utype', label:'Role' },
        { key: 'status',  _style:'width:5%;' },
        { key: 'show_details', label:'Actions' }
      ];

    this.items = users.data.map((res)=> {
      return {
        id: res.id,
        name: res.fname +' '+res.lname,
        email: res.email,
        mobile: res.mobile,
        whatsapp: res.whatsapp,
        utype: res.user_type,
        join: res.created_at.split(" ")[0],
        active: res.active,
      }
    });
    // console.log(this.items);

  },
  methods: {
    getBadge (status) {
      return status === 1 ? 'success'
             : status === 0 ? 'secondary'
             : status === 'Pending' ? 'warning'
             : status === 'Banned' ? 'danger' : 'primary'
    },
    toggleDetails (index) {
      const position = this.details.indexOf(index)
      position !== -1 ? this.details.splice(position, 1) : this.details.push(index)
    }
  }
}
</script>