<template>
<div class="">

    <div class="modal" tabindex="-1" role="dialog" ref="modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add  Project</h5>
                    <button type="button" class="close" @click.prevent="closeModal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="project_name">Projects name</label>
                        <input type="text" name="project_name" id="project_name" class="form-control" v-model="projectName" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click.prevent="closeModal">Cancel</button>
                    <button type="button" class="btn btn-success" @click.prevent="submit">Save project</button>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>

export default {
  
    data: () => ({
        projectName: '',
        output:'',

    }),
     
    methods: {
       
        open() {
           $(this.$refs.modal).modal('show');
        },
        closeModal() {
            $(this.$refs.modal).modal('hide');
            this.projectName = '';

        },
        submit() {
            let currentObj = this;
            axios.post('/projects/add', {  
                name: this.projectName,   
            }).then(response=>{
                 currentObj.output = response.data;
                // flash('Project  Created successfully','success')
            }).catch(error=>{
                currentObj.output = error.response.data.errors.name;
                flash('The name has already been taken.','danger')
            });
             
            $(this.$refs.modal).modal('hide');
        }
    }
}
</script>
