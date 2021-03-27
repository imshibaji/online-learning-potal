<template>
<div>
<LearningActivity></LearningActivity>

<ReportActivity></ReportActivity>

</div>
</template>

<script>
import LearningActivity from './common/widget2';
import ReportActivity from './common/widget3';

export default {
    name: 'App',
    components:{
      LearningActivity,
      ReportActivity
    }
}
</script>
