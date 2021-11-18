<template>
    <div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-10">
                        <h4>Projects</h4>
                    </div>
                    <div class="col-2">
                        <div class="text-right">
                            <button type="button" class="btn btn-sm btn-success" @click.prevent="addProject">Add project</button>
                        </div>
                    </div>
                </div>
            </div>
            <table class="card-table table">
                <thead>
                <tr>
                    <th>Project Name</th>
                    <th>Entries </th>
                    <th>Total hours</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    <tr v-for="(project) in projects" :key="project.id"  >
                        <td v-text="project.name"></td>
                        <td v-text="project.entries.length"></td>
                        <td>
                        <!-- TODO: Calculate total hours spent -->
                            <strong>{{readableTimeFromseconds(total_second)}}</strong>
                             
                        </td>
                        <td class="text-right">
                            <button type="button"  class="btn btn-sm btn-danger" @click.prevent="deleteProject(project)" >delete </button>
                            <button type="button" class="btn btn-sm btn-dark" @click.prevent="editProject(project)">Edit</button>
                            <a :href="`/projects/${project.id}`" class="btn btn-sm btn-secondary" >Details</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <add-entry ref="addEntry"></add-entry>
        <add-project ref="add"></add-project>
        <edit-project ref="edit"></edit-project>
    </div>
</template>

<script>
import Swal from 'sweetalert2'
import AddProject from "./AddProject";
import EditProject from "./EditProject";
import AddEntry from "./AddEntry";
import moment from "moment";
export default {
    name: "Projects",
    components: {
        'add-project': AddProject,
        'edit-project': EditProject,
        'add-entry': AddEntry
    },
    props: ['projects'],
     data () {
        return{
            total:[],
            total_second :0,
            projects : [],
            id:''
           
        }
    },
    computed:{
      
    },
    created(){
        this.total = my_total
        this.total_second = this.total[0].totalsecond
    },
    methods: {
        deleteProject(project){     
        this.id = project.id,
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if(result.value){
        axios.post('/projects/'+project.id).then((response)=>{
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
                 this.projects = this.projects
                 .filter(project =>project.id !=this.id);
             
                }).catch(()=>{
                    Swal.fire(
                    'Failed!',
                    'The was something wrong.',
                    'warning'
                )});
                 }
             });
             
         },
        
        addProject() {
            this.$refs.add.open(); 
            
        },
        editProject(project) {
            this.$refs.edit.open(project);
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
                  h:this.padNumber(hours),
                  m: this.padNumber(seconds % 60),
                  s:this.padNumber(parseInt(seconds/60,10)% 60),
              }
          },
          /***
         * Calculate the  total time spent on the project
         */

        
        
    }
}
</script>
