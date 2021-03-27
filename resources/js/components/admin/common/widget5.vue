<template>
<div>
    <table class="table">
        <thead>
            <tr>
                <th>Client Ip</th>
                <th>User and Location</th>
                <th>Page Information</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in items" :key="item.id">
                <td>
                    <div>{{item.client_ip}}</div>
                    <div>{{ deviceInfo(item.user_agent, 'os') }}</div>
                </td>
                <td>
                    <div>{{item.user.id}}| {{item.user.fname}} {{item.user.lname}}</div>
                    <div>{{item.city}}, {{item.region}}, {{item.country}}</div>
                </td>
                <td class="wrapword">
                    <div>{{item.page_name}}</div> 
                    <div>Path: {{item.page_path}}</div>
                    <div>Reffer: {{item.referer}} </div>
                </td>
                <td>
                    <div>Timezone: {{item.timezone}}</div>
                    <div>{{new Date(item.created_at).toString().slice(0, -30) }}</div>
                </td>
            </tr>
        </tbody>
    </table>

    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li v-bind:class="{ disabled: !prev }" class="page-item">
                <a class="page-link" style="cursor: hand" @click="pageBtn(prev)" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            <!-- <li v-for="item in items" :key="item.id" class="page-item">
                <a class="page-link" href="#">{{item.id}}</a>
            </li> -->
            <li v-bind:class="{ disabled: !next }" class="page-item">
                <a class="page-link" @click="pageBtn(next)">Next</a>
            </li>
        </ul>
    </nav>
</div> 
</template>
<style scoped>
.page-link{
    cursor: pointer;
}
.wrapword {
    width: 35%;
    white-space: -moz-pre-wrap !important;  /* Mozilla, since 1999 */
    white-space: -webkit-pre-wrap;          /* Chrome & Safari */ 
    white-space: -pre-wrap;                 /* Opera 4-6 */
    white-space: -o-pre-wrap;               /* Opera 7 */
    white-space: pre-wrap;                  /* CSS3 */
    word-wrap: break-word;                  /* Internet Explorer 5.5+ */
    word-break: break-all;
    white-space: normal;
}
</style>
<script>
export default {
    name: 'UsersActivity',
    data(){
        return{
            items: [],
            prev: '',
            next: '',
            users: []
        }
    },
    async mounted(){
        this.pageBtn();
        setInterval(this.pageBtn, 36000);
    },
    methods:{
        async pageBtn(url){
            const activity = await axios.get(url || '/admin/api/activity');
            const deleteActivityData = await axios.get('/del_activity');
            const userDatas = await axios.get('/admin/api/users');
            this.users = userDatas.data;
            this.items = activity.data.data;

            console.log('Max Activity Count: '+deleteActivityData.data);
            
            this.items = this.items.map((item) =>{
                this.users.forEach((user)=>{
                    if(user.id == item.user_id){
                        item['user'] = user;
                    }
                });
                if(item.user_id == null){
                    item['user'] = {id:'', fname:'Guest', lname:'User'};
                }
                //  console.log(item);
                return item;
            });

            this.prev = activity.data.prev_page_url;
            this.next = activity.data.next_page_url;
            this.page = activity.data.path;

            // console.log(activity);
            
        },
        deviceInfo(userAgent) {
            var ua = userAgent;
            var msie = false;
            var ff = false;
            var chrome = false;
            var browser = '';
    
            //Javascript Browser Detection - Internet Explorer
            if (/MSIE (\d+\.\d+);/.test(ua)) //test for MSIE x.x; True or False
            {
                var msie = (/MSIE (\d+\.\d+);/.test(ua)); //True or False
                var ieversion = new Number(RegExp.$1); //gets browser version
                browser = ("ie: " + msie + ' version:' + ieversion);
            }
    
            //Javascript Browser Detection - FireFox
            else if (/Firefox[\/\s](\d+\.\d+)/.test(navigator.ua))//test for Firefox/x.x or Firefox x.x
            {
                var ff = (/Firefox[\/\s](\d+\.\d+)/.test(navigator.ua)); //True or False
                var ffversion = new Number(RegExp.$1) //gets browser version
                browser = ("FF: " + ff + ' version:' + ieversion);
            }
    
            //Javascript Browser Detection - Chrome
            else if (ua.lastIndexOf('Chrome/') > 0) {
                var version = ua.substr(ua.lastIndexOf('Chrome/') + 7, 2);
                browser = ("chrome " + version);
            }
    
            //Javascript Browser Detection - Safari
            else if (ua.lastIndexOf('Safari/') > 0) {
                var version = ua.substr(ua.lastIndexOf('Safari/') + 7, 2);
                browser = ("Safari " + version);
            }
    
            //Javascript Browser Detection - Android
            else if (ua.indexOf("Android") >= 0) {
                var androidversion = parseFloat(ua.slice(ua.indexOf("Android") + 8));
                if (androidversion < 2.3) {
                    // do whatever
                    browser = ("Android JSBrowser "+ androidversion);
                }
            }
    
            //Javascript Browser Detection - Mobile
            else if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(ua)) {
    
                // Check if the orientation has changed 90 degrees or -90 degrees... or 0
                window.addEventListener("orientationchange", function () {
                    return (window.orientation);
                });
            }

            // This script sets OSName variable as follows:
            // "Windows"    for all versions of Windows
            // "MacOS"      for all versions of Macintosh OS
            // "Linux"      for all versions of Linux
            // "UNIX"       for all other UNIX flavors 
            // "Unknown OS" indicates failure to detect the OS

            var OSName="Unknown OS";
            if (ua.indexOf("Win")!=-1) OSName="Windows";
            if (ua.indexOf("Mac")!=-1) OSName="MacOS";
            if (ua.indexOf("X11")!=-1) OSName="UNIX";
            if (ua.indexOf("Linux")!=-1) OSName="Linux";

            return [OSName, browser];
        }
    }
}
</script>