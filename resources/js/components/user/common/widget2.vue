<template>
<div>
<h1 class="text-center">{{ getTitle() }}</h1>
<p class="text-center">{{ getMessage() }}</p>
<h4 class="text-center">{{ getSkills()}} Skills + {{getTasks()}} Tasks = {{getLearnings()}} Learning Point</h4>

<LearningChart />

</div>
</template>

<script>
import LearningChart from './chart';

export default {
    name: "LearningActivity",
    components:{
        LearningChart
    },
    data: function(){
      return{
        title: '',
        skills: 0,
        tasks: 0,
        learnings: 0,
        message: '',
      }
    },
    async mounted(){
        const udata = await axios.get('/api/info');
        const mdata = udata.data;
        this.title = mdata.title;
        this.skills = mdata.skills;
        this.tasks = mdata.tasks;
        this.learnings = mdata.learn;
        this.message = mdata.message;
    },
    methods:{
      getTitle(){
        return this.title;
      },
      getSkills(){
        return this.skills;
      },
      getTasks(){
        return this.tasks;
      },
      getLearnings(){
        return this.learnings;
      },
      getMessage(){
        return this.message;
      }
    }
}
</script>