<template>
<div>
<UserActivity></UserActivity>
<LearningActivity></LearningActivity>

<ReportActivity></ReportActivity>

</div>
</template>

<script>
import UserActivity from './common/widget1';
import LearningActivity from './common/widget2';
import ReportActivity from './common/widget3';

export default {
    name: 'App',
    components:{
      UserActivity,
      LearningActivity,
      ReportActivity
    }
}
</script>
