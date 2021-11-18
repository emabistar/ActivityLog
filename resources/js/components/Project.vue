<template>
    <div class="card">
        
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 v-text="project.name"></h4>
                </div>
                  <div class="text-right">
                      
            <button type="button"  class="btn btn-sm btn-success"  @click.prevent=" addEntry(project) ">AddEntry</button>
        
                </div>
                <div class="col-2">
                    
                    <div class="text-right">
                        <button v-show="running" type="button" class="btn btn-sm btn-danger" @click.prevent="stopTimer">Stop</button>
                        <button v-show="!running" type="button" class="btn btn-sm btn-success" @click.prevent="startTimer">Start</button>
                    </div>
                </div>
            </div>
        </div>
        <table class="card-table table">
            <thead>
                <tr>
                    <th>Start date</th>
                    <th>End date</th>
                    <th>Time spent</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(entry,index) in project.entries" :key="index">
                    <td v-text="entry.start"></td>
                    <td v-text="entry.end"></td>
                   
                    <td>
                    <td>
                        <!-- TODO: Calculate time spent -->
                     <strong>{{calculateTimeSpent(entry)}}</strong>
                   
                    </td>
                </tr>
            </tbody>
        </table>
         <add-entry ref="addEntry"></add-entry>
    </div>
</template>

<script>

import moment from "moment";
import AddEntry from "./AddEntry";
export default {
    name: "Project",
     components: {
        'add-entry': AddEntry
    },
    
    props: ['project','id'],
    data: () => ({
        running: false,
         start:'',
        
    }),
    computed:{
       
    },
    methods: {
      
          addEntry(project) {
             this.id = this.project.id  
            this.$refs.addEntry.open(); 
           
        },
        
        startTimer() {
            this.running = true;
            // TODO: Implement start functionality
            axios.post('/entry/start', { 
            start: moment().format("YYYY-MM-DD HH:mm:ss"),
            end:'',
            nane : this.project.name,
            id:this.project.id

           }).then(response =>{
               console.log(response.data)
           }).catch(error=>{
               console.log(error.response.data)
           });
        },
        stopTimer() {
            this.running = false;
            // TODO: Implement stop functionality
            
            axios.post('/entry/stop',{
              id: this.project.id,
              start:'',
              end:moment().format("YYYY-MM-DD HH:mm:ss"),
            }).then(response => {
                console.log(response.data)
            }).catch(error =>{
                console.log(error.response.data)
            })
        },
    
        /***
         * pads a number with "0"
         */
          padNumber: number => (number > 9 ||number === 0) ? number:"0"+number,
         
          /**
           * Get seconds and split it into hours, minutes, seconds
           */
          readableTimeFromseconds : function(seconds){
              const hours = 3600 > seconds ? 0 : parseInt(seconds / 3600,10)
              return {
                  hours:this.padNumber(hours),
                  seconds: this.padNumber(seconds % 60),
                  minutes:this.padNumber(parseInt(seconds/60,10)% 60),

              }
          },
        
        /***
         * Calculate the  total time spent on the project
         */

        calculateTimeSpent:function(entry){
            if(entry.end){
               const started = moment(entry.start)
               const stopped = moment(entry.end)
               const time = this.readableTimeFromseconds(
                   parseInt(moment.duration(stopped.diff(started)).asSeconds())
               )
               return `${time.hours} Hours |${time.minutes} mins|${time.seconds} second`
            }
            return ''
        },
      

       
    }
}
</script>
