<template>
<div>
<UserActivity></UserActivity>
<CoursesList></CoursesList>
</div>
</template>

<script>
import UserActivity from './common/widget1';
import CoursesList from './common/courses';
export default {
    name: 'App',
    components:{
      UserActivity,
      CoursesList
    }
}
</script>
