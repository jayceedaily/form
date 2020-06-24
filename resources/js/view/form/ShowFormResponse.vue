<template>
<div class="columns">
    <div class="column is-8 is-offset-2">
        <div class="card">
            <div class="card-content">
                <div class="columns">
                    <div class="column">

                    </div>
                </div>
                <div class="columns">
                    <div class="column">
                        <button class="button" @click="handleDownload">Download responses</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';

export default {
    name: 'ShowFormResponse',
    created: function() {
        this.loadSheetsForm();
    },
    computed: {
        ...mapGetters({form:'form/selected'})
    },
    methods : {
        ...mapActions({ loadSheetsForm:'form/loadSheets',
                        downloadResponseForm: 'form/downloadResponse'}),

        handleDownload: function() {
          axios({
                    url: '/api/form/'+this.form.id+'/download',
                    method: 'GET',
                    responseType: 'blob',
                }).then((response) => {
                     var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                     var fileLink = document.createElement('a');
                     fileLink.href = fileURL;
                     fileLink.setAttribute('download', response.headers['content-disposition'].split('filename=')[1]);
                     document.body.appendChild(fileLink);

                     fileLink.click();
                });
        }
    }


}
</script>

<style>

</style>
