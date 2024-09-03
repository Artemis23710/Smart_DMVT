<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

import { ref } from 'vue';
import InputError from '@/components/InputError.vue';
import InputLabel from '@/components/InputLabel.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';
import TextInput from '@/components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import axios from 'axios';
</script>

<template>
    <AuthenticatedLayout>
        <div  ref="licenseContainer" class="license-container">
            <div class="license-header">
                <h1 style="font-size:34px;">DRIVER LICENSE</h1>
                <hr style="border:none; height:5px; background-color: #0063a0;">
            </div>
            <br>
            <div class="license-body">
                <div class="license-photo">
                    <img :src="license.userphoto ? `/storage//Photos/Licensephoto/${license.userphoto}` : '../../../../../public/Images/avatar.jpg'"
                        alt="User Photo" id="officerimg" />
                </div>
                <div class="license-info">
                    <div class="license-details">
                        <p><strong class="license-detailstitle">DL</strong> <strong
                                class="license-detail-record">{{ license.liceno }}</strong></p>
                        <p style="margin-right:40px;"><strong class="license-detailstitle">CLASS</strong> <strong
                                class="license-detail-record">{{ license.licensclasss }}</strong></p>
                    </div>
                    <p><strong class="license-detailstitle">EXP</strong> <strong
                            class="license-detail-record">{{ formatDate(license.doe) }}</strong></p>
                    <p><strong class="license-detailstitle">LN</strong> <strong
                            class="license-detail-record">{{ license.surname }}</strong></p>
                    <p><strong class="license-detailstitle">FN</strong> <strong
                            class="license-detail-record">{{ license.othername }}</strong></p>
                    <p class="addresstitle">{{ license.address }}</p>
                    <p><strong class="license-detailstitle">DOB</strong> <strong
                            class="license-detail-record">{{ formatDate(license.dob) }}</strong></p>
                </div>
            </div>
            <div class="license-footer">
                <p><strong class="license-footertitle">SEX</strong> <strong
                        class="license-footer-record">{{ license.sex }}</strong>
                    <strong class="license-footertitle">HAIR</strong><strong class="license-footer-record">N/A</strong>
                    <strong class="license-footertitle">EYES</strong> <strong
                        class="license-footer-record">{{ license.eyes }}</strong></p>
                <p><strong class="license-footertitle">HGT</strong> <strong
                        class="license-footer-record">{{ license.height }}</strong>
                    <strong class="license-footertitle">WGT</strong><strong
                        class="license-footer-record">{{ license.weight }}</strong>
                    <strong class="license-footertitle">ISS</strong> <strong
                        class="license-footer-record">{{ formatDate(license.doi) }}</strong>
                </p>
            </div>
        </div>
        <br>
        <br>
        <div class="row justify-content-center"> 
            <div class="col-4">
                <div class="card text-center"> 
                    <div class="card-body">
                        <button @click="downloadPDF" class="btn btn-danger">
                            <i class="material-icons">picture_as_pdf</i> Download PDF
                        </button>
                    </div>
                </div>
            </div>
        </div>

     
    </AuthenticatedLayout>
</template>

<style scoped>
        .license-container {
            width: 850px;
            border-radius: 10px;
            background-color: #c6e7f1;
            padding: 20px;
            margin: 0 auto;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .license-header h1{
            text-align: center;
            margin-bottom: 15px;
        }

        .license-header  {
            margin: 0;
            color: #0063a0;
            font-weight: bold;
           
        }

        .license-details {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            margin-top: 10px;
        }

        .license-body {
            display: flex;
        }

        .license-photo {
            flex: 1;
        }
        .license-photo img {
            width: 200px;
            height: 220px;
            border-radius: 5px;
            border: 2px solid #2a7eb1;
            margin-left: 10px;
        }

        .license-info {
            flex: 2;
            margin-left: 15px;
        }

        .license-detailstitle{
            font-size: 24px;
            color: #0063a0;
            font-weight: bold;
            margin-right: 5px;

        }
        .license-detail-record{
            font-size: 30px;
            color: #000102;
            font-weight: bold;
        }

        .addresstitle{
            font-size: 20px;
            color: #000102;
            font-weight: bold;
        }
        .license-footer {
            margin-top: 15px;
            margin-left: 300px;
            font-size: 14px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }
        .license-footertitle{
            font-size: 24px;
            color: #0063a0;
            font-weight: bold;
            margin-right: 5px;
        }
        .license-footer-record{
            font-size: 24px;
            color: #000102;
            font-weight: bold;
            margin-right: 20px;
        }
    


</style>

<script>
   import html2pdf from 'html2pdf.js';
   export default {
       props: {
           license: Object,
       },
       methods: {
           formatDate(date) {
               const options = {
                   year: 'numeric',
                   month: '2-digit',
                   day: '2-digit'
               };
               return new Date(date).toLocaleDateString(undefined, options);
           },
           downloadPDF() {
               const element = this.$refs.licenseContainer;

               const opt = {
                   margin: 1,
                   filename: `License_${this.license.liceno}.pdf`,
                   image: {
                       type: 'jpeg',
                       quality: 0.98
                   },
                   html2canvas: {
                       scale: 2
                   },
                   jsPDF: {
                       unit: 'in',
                       format: 'letter',
                       orientation: 'landscape'
                   } // Change orientation to landscape
               };

               html2pdf().from(element).set(opt).save();
           }

       }
    };
</script>
