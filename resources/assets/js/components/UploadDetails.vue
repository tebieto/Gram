<template>

			<div class="uploaded_file_container">
				 <img  v-if="this.type=='image'" class="uploadedFile" :src="this.link" width="100" height="100"  alt="" />
				
				 <video v-if="this.type=='video'" class="uploadedFile" width="100" height="100" controls >
				 <source :src="this.link" :type="this.mime">
				</video>
				 <div id="uploadInfo" ><span class="uploadDelete" @click="removeUploaded"><b>x</b></span></div>
			</div>

</template>



<script>
export default {
mounted() {

console.log(this.link);
console.log(this.type);

},

data() {
			return {
		
			
			}
		},
		
props: ['link', 'type', 'mime'],

methods: {
	removeUploaded() {	
	this.$store.commit('remove_uploaded', {
				filelink: this.link
				})	
		
		}
		
	}
		
}

</script>

<style>

.uploaded_file_container #uploadInfo {

visibility: hidden;

}

.uploaded_file_container:hover #uploadInfo {

visibility: visible;

}

</style>