<template>
<div>
<div class="py-3">
<CTabs variant="tabs">
    <CTab title="Activities" active>
        <UsersActivity />
    </CTab>
    <CTab title="All User">
        <UserTable />
    </CTab>
    <CTab title="Assesments">
        <UsersAssesment />
    </CTab>
    <CTab title="Payment Information">
        <PaymentInfo />
    </CTab>
  </CTabs>
       
</div>
</div> 
</template>

<script>
import UserTable from './widget1';
import UsersAssesment from './widget3';
import UsersActivity from './widget5';
import PaymentInfo from './widget6';

export default {
    name: 'QuickView',
    components:{
        UserTable,
        UsersAssesment,
        UsersActivity,
        PaymentInfo
    }
}
</script>