<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div id="post" class="panel panel-default" @mouseout="scrollToEnd">
			  <div class="new_panel-heading">
			  <img src="http://localhost:8000/icons/make_post.png" width="16px" height="16px"  alt="" />
			  <span class="make_post bubble"><b> Make Post</b></span>
			  </div>
              <div class="panel-body">
                 <img id="avatar" class="post_avatar":src="auth_user_avatar" width="40px" height="40px" style="border-radius: 50%;" alt="" :title="auth_user_name" /> 
				
				<span v-if="not_working">&nbsp; Choose photo or video</span><br>
				 <textarea  v-if="!not_working" class="custom_textarea" rows="1" v-model="content" :placeholder="'Add a comment...'"></textarea>
				 
		    <div  id="uploadedContainer" v-if="showUploaded.length>0 || uploadDelay.length>0">
				 
				 <div class="showUploaded" v-for="file in uploadedFile">
				 <Upload_details :link="file.URL" :type="file.type" :mime="file.mime"></upload_details>

				 </div>
				 
				 <div class="spinner_wrapper" v-for=" file in this.uploadDelay">
				 <div class="spinner"></div>
				 </div>
				 
			</div>
	
				 <hr>
				<input type="file" ref="image"  style="display:none;" accept="image/*" v-on:change="imageChange">
				<span class="post_icon" title="Choose file" @click="showImagePicker" ><img  id="" src="http://localhost:8000/icons/picture_icon.png" width="15px" height="15px"  alt="" /><span class="post_icon_text"><b> Photo</b></span></span>
				<input type="file" ref="video" style="display:none;" accept="video/*" v-on:change="videoChange">
				<span class="post_icon" title="Choose file" @click="showVideoPicker"><img id="" src="http://localhost:8000/icons/video_icon.png" width="15px" height="15px"  alt="" /><span class="post_icon_text"><b> Video </b></span></span>

				<button v-if="!show_post_spinner" class="post_button pull-right" :disabled="not_working" @click="create_post()">Post</button>
                <div class="post_spinner_wrapper pull right" v-if="show_post_spinner">
				 <div class="post_spinner"></div>
				 </div>
				
				</div>
            </div>
        </div>
    </div>
</div>
</template>

<script>

	export default {
		
		mounted() {
		
		},
		
		data() {
			return {
				content: '',
				not_working: true,
				attachment: false,
				form: new FormData,
				uploadedFile: [],
				uploadDelay: [],
				sendingPost: false,
				show_post_spinner:false
				
				
			
			}
		},
		
		methods: {
		
		videoChange(e) {
		if(this.uploadedFile.length>1) {
		var container = this.$el.querySelector("#uploadedContainer");
			container.scrollTop = 5000;
		}
		let selected=e.target.files[0];
		
		if (!selected) {
		return 0
		}
		
		
		
		let selectedFile=e.target.files[0];
		
		this.uploadDelay.push('File')
		console.log(this.uploadDelay);
		
		
		this.attachment=selectedFile;
		
		this.form.append('vid', this.attachment);
		const config = {headers: {'Content-Type': 'multipart/form-data'}};
		
		axios.post('/upload/video', this.form, config).then(response=>{
		//success
		
				console.log (response.data)
				
				if (response.data == 0) {
			this.uploadDelay=this.uploadDelay.splice(1)
			
			return
			
			}
				var upload = response.data
					this.$store.commit('add_upload', upload)
		
					this.uploadDelay=this.uploadDelay.splice(1)
					
					var container = this.$el.querySelector("#uploadedContainer");
					container.scrollTop = 5000;
					
					
		
		})
				.catch(response=>{
				//errors
				});
		
		},
		
		imageChange(e) {
		
		if(this.uploadedFile.length>1) {
		var container = this.$el.querySelector("#uploadedContainer");
			container.scrollTop = 5000;
		}
		
		console.log((this.startedUpload))
		let selected=e.target.files[0];
		
		if (!selected) {
		return 0
		}
		
		
		this.uploadDelay.push('File')
		console.log(this.uploadDelay);
		
		
		
		let selectedFile=e.target.files[0];
		
		
		this.attachment=selectedFile;
		this.form.append('img', this.attachment);
		const config = {headers: {'Content-Type': 'multipart/form-data'}};
		
		axios.post('/upload/image', this.form, config).then(response=>{
		//success
		
		
			console.log (response.data)
			if (response.data == 0) {
			this.uploadDelay=this.uploadDelay.splice(1)
			
			return
			
			}
					var upload = response.data
					this.$store.commit('add_upload', upload)
				
				
				this.uploadDelay=this.uploadDelay.splice(1)
				
				var container = this.$el.querySelector("#uploadedContainer");
				container.scrollTop = 5000;
				
				
		
		})
				.catch(response=>{
				//errors
				});
		
		},
		
		scrollToEnd() {    	
		
		
		},
		
		showImagePicker() {
		
		this.$refs.image.click();
		
		},
		
		showVideoPicker() {
		
		this.$refs.video.click();
		
		},
		
			create_post() {
				this.show_post_spinner=true
				const config = {headers: {'Content-Type': 'multipart/form-data'}};
				axios.post('/create/post', {content: this.content})
				.then( (response) => { 
					console.log(response.data)
					
					this.content = ''
					
					
					this.save_post_files()
					
				 
				})
			},
			
			
			save_post_files() {
			this.sendingPost=true
			axios.get('/feed')
			.then(response => {
				
			response.data.forEach((post) => {
					console.log (post.id)
				this.uploadedFile.forEach((file) => {
					
					axios.get('/add/' + post.id + '/' + file.ext + '/' + file.link)
					
					
						})
				this.sendingPost=false
				this.get_new_post()
				})
			
			this.get_new_post()
			})
			
			},
			
			get_new_post() {
			
			axios.get('/feed')
			.then(response => {
				console.log (response.data)
			
				response.data.forEach((post) => {
					this.$store.commit('add_new_post', post)
				})
			})
			this.show_post_spinner=false
			}
		
		},
		
		computed: {
		
		showUploaded() {
		
		var uploaded = this.$store.getters.all_uploads
		
		if(uploaded.length>0 && this.uploadDelay.length==0)
		this.not_working = false
		else
		this.not_working = true
		
		this.uploadedFile= uploaded
		return uploaded
		
		},
		
		time_of_day() {
		
		var today= new Date();
	
		var hours= today.getHours();
		
		
		if(hours <  12){
		hours = 'Good Morning'
		}
		
		if(hours < 16){
		hours = 'Good afternoon'
		} 
		
		
		if(hours >= 16){
		hours = 'Good Evening'
		}
		
		
		
		return hours
		},
		
		auth_user_avatar () {

		var auth_avatar = this.$store.state.auth_user.avatar
		
		return auth_avatar
		},
		
		auth_user_name () {
		
		var auth_name = this.$store.state.auth_user.name
		if (auth_name) {
		return auth_name.split(' ').slice(0,1)
		}
		}
		
		},
		
		watch: {
		
			content() {
				
			}
		
		}
		
	}
</script>

<style>
.custom_textarea, .custom_textarea:focus{
outline:0px !important;
-webkit-appearance:none;
border:none;
margin:auto;
width:90%;
resize:none;
background:transparent;

}	

.make_post {
color: rgba;
position: relative;
top: 3px;

}

.bubble:before {
  content: "";
  width: 0px;
  height: 0px;
  position: absolute;
  border-left: 10px solid transparent;
  border-right: 10px solid transparent;
  border-top: 10px solid transparent;
  border-bottom: 10px solid #eee;
  right: 25px;
  top: 9px;
}

.new_panel-heading{
width: 100%;

background: #ddd;
padding: 10px;

}

.post_icon {

border: 1px solid rgb(234,231,255);
padding: 10px;
border-radius: 30%;
font-size: 10px;
cursor: pointer;
background:#e5e5e5;
}

.post_icon_text{
position:relative;
top:1px;


}

.post_icon:hover{


background: rgb(234,231,255)

}




#post {



}

.helpers {
width:70%;

}

.post_button {
background:rgb(0, 51, 0);
border:none;
border-radius: 5%;
color:#fff;
font-weight:bold;

}

.post_button:hover{
background: rgba(0, 51, 0, 0.9);
}

.post_button:disabled{
background: rgba(0, 51, 0, 0.5);
}

.uploadedFile, #uploadInfo{
border: 1px solid #ccc;
margin: 5px;
padding: 1px;

float:left;

position: relative;
    z-index: 1;

}



#uploadInfo {

width:100px;
height:100px;
background: rgba(0, 0, 0, 0.5);
color: #fff;
margin-left:-105px;

position: relative;
    z-index: 2;

}


.uploadDelete {

width:8px;
height:8px;
padding-left:5px;
padding-right: 5px;
margin-left:70px;
cursor:pointer;
border: 1px solid #ccc;
border-radius: 100%;
color:  #ccc;
}

.uploadDelete:hover {
border: 1px solid #fff;
color:  #fff;
}

#uploadedContainer {

border : 1px solid transparent;

height: 122px;

overflow-y: auto;

overflow-x: hidden;

}
.spinner_wrapper{
width:100px;
height:100px;
background: #ccc;
margin:5px;
float:left;


}
.spinner {
width:70px;
height:70px;
border: 2px solid #f3f3f3;
border-top: 3px solid rgb(0,51,0);
border-radius: 50%;
margin: auto;
margin-top: 15px;


animation: spin 1s infinite linear

}

@keyframes spin {
	from {
	transform: rotate(0deg);
	} to {
	
	transform:rotate(360deg);
	}
	
	}
	
.post_spinner_wrapper{
background: #fff;
width:15px;
height:15px;
margin:5px;
float:right;
}
.post_spinner {
width:15px;
height:15px;
border: 2px solid #f3f3f3;
border-top: 1px solid  rgb(0,51,0);
border-radius: 50%;
margin: auto;



animation: spin 0.2s infinite linear

}

@keyframes spin {
	from {
	transform: rotate(0deg);
	} to {
	
	transform:rotate(360deg);
	}
	
	}




</style>