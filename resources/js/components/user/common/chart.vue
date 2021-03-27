<template>
<div class="box p-3">
    <h5 class="text-center">Learning Weeks Table</h5>
    <CChartBar
        style="height:300px"
        :datasets=getDataSet()
        :labels="labels"
        :options="{ maintainAspectRatio: false, scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        } }"
    />
</div>
</template>

<script>
export default {
    name: 'LearningChart',
    data: function(){
        return{
            labels: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25],
            target: [20, 22, 13],
            done: [14, 16, 12],
            donot: [6, 7, 1],
            length: 30
        };
    },
    async mounted(){
        const udata = await axios.get('/api/info');
        const mdata = udata.data;
        this.length = mdata.length;
        this.design = mdata.design;
        this.develop = mdata.develop;
        this.debug = mdata.debug;
        this.tasks = mdata.taskName;
        
        this.labels = [];
        for(let i=1; i<(this.length+1); i++){
            this.labels.push(i);
        }
    },
    methods:{
        getDataSet(){
            return [
            {
                data: this.design,
                backgroundColor: '#ff0000',
                label: 'Design',
            },
            {
                data: this.develop,
                backgroundColor: '#0000ff',
                label: 'Development',
            },
            {
                data: this.debug,
                backgroundColor: '#00ff00',
                label: 'Debugging',
            }
            ];
        }
    }
}
</script>