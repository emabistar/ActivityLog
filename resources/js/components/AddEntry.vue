<template>
<div class="">
  
    <div class="modal" tabindex="-1" role="dialog" ref="modal">
 
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add  Entry</h5>
                    <button type="button" class="close" @click.prevent="closeModal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                     <div class="form-group">
                    </div>
                    <div class="form-group">
                       
                        <label for="entry_start">Entry Start</label>
                        <input  type="datetime-local" step="1" name="entry_start" id="entry_start" class="form-control" v-model="entryStart" />
                      
                    </div>
                     
                    <div class="form-group">
                        <label for="entry_end">Entry End</label>
                        <input  type="datetime-local" step="1"  name="entry_end" id="entry_end" class="form-control" v-model="entryEnd" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click.prevent="closeModal">Cancel</button>
                    <button type="button"   class="btn btn-success" @click.prevent="submit">Save entry</button>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>
<script>
import moment from "moment";
export default {
    
    data: () => ({
        project: null,
        entryStart: '',
        entryEnd:'',
        projectId:'',
        id:''

    }),
  
    methods: {
        open(project) {
           $(this.$refs.modal).modal('show');
           
        },
        closeModal() {
           $(this.$refs.modal).modal('hide');
            this.entryStart = '',
            this.entryEnd ='',
            this.projectId=''
           
        },
       
        submit() {
            let currentObj = this;
            axios.post('/entry/add', {
                start: this.entryStart,
                end :this.entryEnd,
                id:window.location.pathname.split('/')[2] 
                //id: this.projectId
            }).then(response=>{
                console.log(response.data)
                 this.project = response.data
                 currentObj.output = response.data;
                // flash('Project  Created successfully','success')
            }).catch(error=>{
                currentObj.output = error.response.data.errors;
                flash('The name has already been taken.','danger')
            });
            $(this.$refs.modal).modal('hide');
        }
    }
}
</script>
