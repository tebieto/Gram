<template>
<div>

		<div :id="'prg' + this.id" style="border:1px solid #ccc; display:none;"></div>
		<div v-if="this.file_count.length>1">
		<span  class="slide_out" @click="slide_out()"><</span>	 
		<span id="in"class="slide_in" @click="slide_in()">></span>
		
		</div>
		
		<div class="post_file_container" v-if="file_index % 2==0" v-for="file in files">
			
			<postvideo :vid="'video' + file.id" :link="file.link" :type="file.mime" v-if="file.type=='video'"></postvideo>
			<img v-else-if="file.type=='image'" class="postFile" :src="file.link" width="100%" height=""  alt="" />
			
		</div>
		
		<div class="post_file_container" v-else v-for="file in files">
			
			<postvideo :vid="'video' + file.id" :link="file.link" :type="file.mime" v-if="file.type=='video'"></postvideo>
			<img  v-else-if="file.type=='image'" class="postFile" :src="file.link" width="100%" height=""  alt="" />
			
		</div>
		
</div>

</template>

<script>

export default {

	mounted() {
	
	this.prog1()
	
	
	
	

	
	},
	
	data() {
		
		return {
		
			type: this.new,
			
			file_index: 0,
			
			file_count: [] ,
			
			
		
		}
		},
	
	props: ['id', 'new'],
	
	methods: {
	
	
	
	prog1() {
	var a = this.id
	var progress = 100
	var id = setInterval(frame,1000)
	
	
	function frame() {
	
	if (progress==400) {
	clearInterval(id)
	}	else {
	progress += 10
	document.getElementById('prg' + a).style.width= progress + 'px'
	
	
		}
	}
	
	
	
	},
	
	
	
	
	slide_in() {
	
	if (this.file_index >= this.file_count.length-1) {
	this.file_index = 0
	} else {
	this.file_index += 1
	
	}
	
	
	},
	
	slide_out() {
	
	if (this.file_index ==0) {
	this.file_index = this.file_count.length-1
	} else {
	this.file_index -= 1
	
	}
	
	
	}
	
	},
	
	computed: {
	
	
		post() {
		if (this.type == 'old') { 
			return this.$store.state.posts.find((post) => {
				return post.id === this.id
			})
			
			}
		else if (this.type == 'new') {
		
		return this.$store.state.new_posts.find((post) => {
				return post.id === this.id
			})
		}
		
		},
		
		files() {
		var index = this.file_index;
		
		this.file_count = this.post.files
		var files = this.post.files.slice(index)
		if(files.length>1) {
		var splice = files.length-1
		files = files.reverse().splice(splice)
		}
	
		if (files.length>0)
		return files
		
		
		}
		
	
		
	},
	
	updated: function(){
	 
	 
	 
	 
	
	}
}

</script>


<style>

.slide_in, .slide_out {

width: 10px;
height: 10px;
font-size: small;
font-weight: bold;
color: rgb(0,102,255);
border-radius: 50%;

cursor: pointer;
padding:1px;
padding-left: 7px;
padding-right: 7px;
padding-bottom: 2px;
position: relative;
top: -5px;
left: 300px;
}

.slide_in:hover, .slide_out:hover {
background: rgba(0, 102, 255,0.5);
color: #fff;


}

.post_file_container img {
margin-bottom: 10px;

}

</style>