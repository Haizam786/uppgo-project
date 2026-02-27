<template>
    <div class="layout-px-spacing">

            <div class="row layout-top-spacing" id="cancel-row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="statbox panel box box-shadow">
                        <div class="panel-body">
                            <div class="hd-header-wrapper">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <h4 class="">{{$t('Scan_QR_Code')}}</h4>
                                        <p class="">{{$t('click_to_star_cam')}}</p>
                                        
                                        <video id="video" width="580" height="400" poster="@/assets/images/video-cam-placeholder.jpg"></video>

                                        <div class="row mx-4 my-3 d-flex justify-content-center">
                                            <div class="col-6">
                                                <b-input v-model="data" size="sm" id="company-address" disabled></b-input>
                                            </div>
                                        </div>

                                        <div class="row my-3">
                                            <div class="col">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button v-if="isStarted" @click="startCamera" type="button" class="btn btn-primary" disabled>{{$t('start')}}</button>
                                                    <button v-else @click="startCamera" type="button" class="btn btn-primary">{{$t('start')}}</button>
                                                    <button v-if="isStarted" @click="stopCamera" type="button" class="btn btn-danger">{{$t('stop')}}</button>
                                                    <button v-else @click="stopCamera" type="button" class="btn btn-danger" disabled>{{$t('stop')}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>                
</template>

<script>
    

    export default{
        data(){
            return{
                video: null,
                data: null,
                canvas:  document.createElement('canvas'),

                isStarted: false,
            }
        },

        mounted(){
            this.video = document.getElementById('video');
            
        },

        methods: {
            startCamera() {
                this.isStarted = true;

                navigator.mediaDevices.getUserMedia({ video: true })
                .then(stream => {
                    this.video.srcObject = stream;
                    this.video.play();
                    this.tick();
                });

            },

            stopCamera(){

                const stream = this.video.srcObject;
                const tracks = stream.getTracks();

                tracks.forEach(function(track) {
                    track.stop();
                });

                this.video.srcObject = null;
                this.isStarted = false;
            },

            tick() {
                
                if(this.isStarted){
                    console.log("inside tick");
                    const ctx = this.canvas.getContext('2d');

                    video.addEventListener('loadedmetadata', () => {
                        this.canvas.width = this.video.videoWidth;
                        this.canvas.height = this.video.videoHeight;
                    });

                    ctx.drawImage(this.video, 0, 0, this.canvas.width, this.canvas.height);
                    const imageData = ctx.getImageData(0, 0, this.canvas.width, this.canvas.height);
                    const code = jsQR(imageData.data, imageData.width, imageData.height);

                    if (code) {
                        this.data = code.data
                        this.sendQR()
                        return
                    }
                    requestAnimationFrame(this.tick);
                }
            },

            //Send encrypted qr data to backend
            sendQR() {

                axios
                    .post(`${this.data}`)
                    .then((res) => {
                        if (res.status == 200 && res.data == 1) {
                                Swal.fire({
                                icon: "success",
                                title: "Attendance Marked Successfully!",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        }
                    })
                    .catch((err) => {
                        if (err.response.status == 422) {
                            this.errors = err.response.data.errors;
                        }
                    });
            },


        }
    }
</script>