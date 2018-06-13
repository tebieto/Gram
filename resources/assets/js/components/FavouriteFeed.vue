<template>
	<div class="container" id="scroll" @scroll="handleScroll">
		<div class="row">
			<div class="col-md-8 col-lg-offset-2">
			
				<div class="panel panel-default">
				<div class="panel-body">
				<b>Posts you like</b>
				</div>
				</div>
				
				<div class="panel panel-default" v-for="post in new_posts">
					<div class="panel-heading">
						<img id="avatar" :src="post.user.avatar" height="40px" width="40px" style="border-radius:50%; " :title="post.user.name"/>
						<get_time :get_time="post.created_at"></get_time>
						<span class="auth_name"><a  :href="'/profile/'+post.user.slug">{{post.user.name}}</a></span>
						
						
					</div>
					
					
					<div class="panel-body">
					
					
					
					<media :id="post.id" :new="'new'"></media>
					
					<like :id="post.id" :new="'new'"></like>
					<br>
					<div v-if="post.content">
					
					<div  class="post_body comment_bubble">
					  <content_body :slug="post.user.slug" :name="post.user.name" :content="post.content"></content_body>
					</div>
					</div>
					<comments :id="post.id" :new="'new'"></comments>
						
					</div>
					
				</div>
			
			
				<div class="panel panel-default" v-for="post in posts" v-on:mouseleave="suggest(post.user.id)">
					<div class="panel-heading">
						<img id="avatar" :src="post.user.avatar" height="40px" width="40px" style="border-radius:50%; " :title="post.user.name"/>
						<get_time :get_time="post.created_at"></get_time>
						<span class="auth_name"><a  :href="'/profile/'+post.user.slug">{{post.user.name}}</a></span>
						
						
					</div>
					<div class="panel-body">
					
					
					
					<media :id="post.id" :new="'old'"></media>
					
					<like :id="post.id" :new="'old'"></like>
					<br>
					<div v-if="post.content">
					
					<div  class="post_body comment_bubble">
					  <content_body :slug="post.user.slug" :name="post.user.name" :content="post.content"></content_body>
					</div>
					</div>
					<comments :id="post.id" :new="'old'"></comments>
				
					</div>
				</div>
	<div class="panel  helpers" align="center" id="none" v-if="none">You have not liked any post</div>
	<div class="panel  helpers" align="center" id="loading" v-if="loading">
		<div class="panel-heading">
        
			<div class="animated-avatar"></div>
			<div class="animated-name"></div>
			<div class="animated-time"></div>
		
		</div>
		<div class="panel-body">
		
			<div class="animated-content"></div><br>
			<div class="animated-content"></div><br>
			<div class="animated-content"></div>
			
		</div>
   </div>	
				  
				  
				  
				  <div class="panel helpers" align="center" id="end" v-if="end">No more contents, refresh browser</div>
				  
			</div>
		</div>
	</div>

</template>

<script>
	
	export default {
		mounted() {
			this.get_feed()
			
			this.scroller()
			
			console.log(this.currentVideo)
			
			window.onbeforeunload = function () {
			window.scrollTo(0, 0);
			
			}
			
			   	
		
    

			
			
			
		},
		
		data() {
		
		return {
		
		start: 0,
		
		
		
		trigger: 0,   // how far from the bottom to trigger infinite scroll

		end    : false, // no more resources
		
		loading: false,
		
		loaded: false,
		
		popular: false,
		
		none: false,
		currentVideo: false
		
		
		}
		
		
		},
		
		methods: {
		
		suggest(id) {
		
		axios.get('/suggest/' + id)
			.then(response => {
				console.log (response.data)
				
				})
		
		},
		
		fetch_video_id(){
		var togglevideo = this.$store.getters.recent_videoid
		this.currentVideo= togglevideo
		},	
			
		get_feed() {
			
			if (this.end ==  false) {
			
			
			
			this.loading = true
			
			
			axios.get('/feeds/favourite/' + this.start)
			.then(response => {
				console.log (response.data)
				
			
				response.data.forEach((post) => {
				
					
					this.$store.commit('add_post', post)
				})
				
				
				this.loaded = true
				this.loading = false
				
				if (response.data === 'undefined' || response.data.length == 0) {
				if (this.start > 0) {
				
				this.end = true
				this.loading= false
				
				}
				
				
				}
			})
			}
		
		},
		
		
		scroller() {
		
		 window.onscroll = event => {
			
			
			var d = document.documentElement;
			var offset = d.scrollTop + window.innerHeight;
			var height = d.scrollHeight - this.trigger;
			
			
			
			this.fetch_video_id()
            if(this.currentVideo && this.currentVideo!= 'undefined') {
			var mediaplayer
	        mediaplayer = document.getElementById(this.currentVideo)
			var stick=mediaplayer.offsetTop +250
			if (window.pageYOffset >= stick) {
			mediaplayer.pause()
			
			}
			
            
			
			}
			if (offset >= height) {
			
				  
                  this.start = this.start + 5
				  
				  this.get_feed();
				  
				 
				  
				  
			   
		}
	}
		
		},
		
		
		
		handleScroll: function(e) {
            
			var d = e.srcElement;
			var topPosition = d.scrollTop;
			var offset = topPosition + 300;
			var height = d.scrollHeight;
            console.log('offset = ' + offset);
			console.log('height = ' + height);

			if (offset === height) {
			console.log('At the bottom');
			
			}
			
		}
			
		
	},
		
				computed: {
				
		
				
		auth_user_id(){
		
		var auth_user_id = this.$store.state.auth_user.id
		
		return auth_user_id
	},
	
	auth_user_avatar() {
	
		var auth_user_avatar = this.$store.state.auth_user.avatar
		
		return auth_user_avatar
	},
				
		
			
			posts() {
				
				var posts = this.$store.getters.all_posts
				
				
				if (this.loaded == true) {
				if(posts.length>0) {
				this.none = false
				} else {
				
				this.none = true
				}
				
				}
				
				
				
				if(posts.length<100) {
				this.popular = true
				}
				
				
				
				
				return posts;
			},
			
			new_posts() {
				
				var new_posts = this.$store.getters.all_new_posts
				
				
				
				
				return new_posts.reverse();
			},
			
			
			
			
			
		}
	}
</script>
<style>
#scroll {


}


#end, #none {



}

#loading, #end, #none {
padding: 10px;
border: 1px solid #eee;

font-weight: bold;
color: #999999;
margin-bottom: 30px;
}

.auth_name {
	font-weight: bold;	
	position :relative;
	top: -63px;
	left: 47px;
	}
	
.title #title_text {
visibility: hidden;
    width: 120px;
    background-color: black;
    color: #fff;
    text-align: center;
    
    padding: 5px;
    
    /* Position the tooltip */
    position: relative;
	z-index: 1;
    top: 40px;
    left: -100px;

}
.title:hover #title_text{
visibility: visible;

}

.panel {
margin-top: -10px;


}




@keyframes placeHolderShimmer{
    0%{
        background-position: -468px 0
    }
    100%{
        background-position: 468px 0
    }
}

.animated-avatar, .animated-content, .animated-name,.animated-time {
    animation-duration: 1s;
    animation-fill-mode: forwards;
    animation-iteration-count: infinite;
    animation-name: placeHolderShimmer;
    animation-timing-function: linear;
    background: #f6f7f8;
    background: linear-gradient(to right, #eeeeee 8%, #dddddd 18%, #eeeeee 33%);
    background-size: 800px 104px;
    height: 96px;
    position: relative;
}

.animated-avatar {

width: 40px;

height: 40px;

border-radius: 50%;

position:relative;

left: -206px;

}

.animated-name {

width: 120px;

height: 5px;

position:relative;

left: -121px;

top: -26px

}

.animated-time {

width: 120px;

height: 5px;

position:relative;

left: -121px;

top: -23px

}


.animated-content {

height: 10px;


}

.textarea_wrapper{
margin:10px;
}
.comment_textarea, .comment_textarea:focus{
outline:0px !important;
-webkit-appearance:none;
border: none;
width:80%;
resize:none;
padding:10px 0px 0px 10px;;
margin-left:20px;
border-radius:25px;
border: 1px solid #ddd;

}

.comment_body, .post_body {
background:#eee;
width:auto;
min-width:10%;
max-width: 80%;
border-radius: 25px;
padding:5px;
color:#000;
overflow-wrap:break-word;
white-space: pre-wrap;
word-wrap: break-word;
display: inline-block;
}

.comment_body{
background:#fff;
margin-left: 3px;
padding:10px;

}

.post_body{
position:relative;
top: -14px;
left:0px;
background:#transparent;
max-width: 100%;
}
#avatar {
z-index:2

}

.comment_avatar{
float:left;


}

.send_comment_avatar{
position:relative;
float:left;
top: 0px;
left:15px;
}

.fake_link{

cursor: pointer;
color: rgb(0,51,102);
font-weight:bold;

}
.textarea_wrapper{
margin-top:20px;

}	

.comment_wrapper{
position:relative;
margin:10px;

}

.panel-body a {

color: rgb(0, 51, 102);

}

</style>
