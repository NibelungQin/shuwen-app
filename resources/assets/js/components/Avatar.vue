<template>
    <div style="text-align: center">
        <my-upload field="img"
                   @crop-success="cropSuccess"
                   @crop-upload-success="cropUploadSuccess"
                   @crop-upload-fail="cropUploadFail"
                   v-model="show"
                   :width="300"
                   :height="300"
                   url="/avatar"
                   :params="params"
                   :headers="headers"
                   img-format="png"></my-upload>
        <img :src="imgDataUrl" class="img-circle" style="width: 80px">
        <div style="margin-top: 20px;"> <button class="btn btn-default" @click="toggleShow">修改头像</button></div>
    </div>
</template>

<script>
    // import 'babel-polyfill'; // es6 shim
    import myUpload from 'vue-image-crop-upload';
    export default {
        props:['avatar'],
        data(){
            return {
                show: true,
                params: {
                    _token: Laravel.csrfToken,
                    name: 'avatar'
                },
                headers: {
                    smail: '*_~'
                },
                imgDataUrl: this.avatar
            }
        },
        components: {
            'my-upload': myUpload
        },
        methods: {
            toggleShow() {
                this.show = !this.show;
            },
            /**
             * crop success
             *
             * [param] imgDataUrl
             * [param] field
             */
            cropSuccess(imgDataUrl, field){
                console.log('-------- crop success --------');
                this.imgDataUrl = imgDataUrl;
            },
            /**
             * upload success
             *
             * [param] jsonData  server api return data, already json encode
             * [param] field
             */
            cropUploadSuccess(jsonData, field){
                console.log('-------- upload success --------');
                console.log(jsonData);
                console.log('field: ' + field);
            },
            /**
             * upload fail
             *
             * [param] status    server api return error status, like 500
             * [param] field
             */
            cropUploadFail(status, field){
                console.log('-------- upload fail --------');
                console.log(status);
                console.log('field: ' + field);
            }
        }
    }
</script>

<style scoped>

</style>
