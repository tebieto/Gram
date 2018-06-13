<template>
	<div class="container" id="scroll" @scroll="handleScroll">
		<div class="row">
			<div class="col-md-8 col-lg-offset-2">
			
			
			<div class="panel panel-default" align="center" id="" v-if="this.alert==true && friends.length==0">User has no follower at the moment</div>
				<div class="panel panel-default user_friends" v-if="this.showFeed==true">
					<div class="center-wrapper">
						<div class="suggested" v-for="friend in friends">
							<div class="suggest-heading">
								<img id=" " :src="friend.avatar" height="50px" width="50px" style="border-radius:50%; " :title="friend.name"/>

							</div>
								<div><a :href="'/profile/' + friend.slug">{{friend.name.slice(0,11)}}<span v-if="friend.name.length>11">...</span></a></div>
								<div class="suggested-status"><friend :profile_user_id="friend.id"></friend></div>
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
			this.get_friends()
			
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
		
		alert:false,
		
		showFeed:false,
		
		popular: false,
		
		none: false,
		currentVideo: false
		
		
		}
		
		
		},
		
		props: ['id'],
		
		methods: {
		
		suggest(id) {
		
		axios.get('/suggest/' + id)
			.then(response => {
				console.log (response.data)
				
				})
		
		},
		

			
		get_friends() {
			
			if (this.end ==  false) {
			
			
			
			this.loading = true
			
			
			axios.get('/user/' + this.id + '/followers/' + this.start )
			.then(response => {
				console.log (response.data)
				
			
				response.data.forEach((friend) => {
				
					
					this.$store.commit('add_friend', friend)
					this.showFeed=true
				})
				
				this.alert=true
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
			
			
			if (offset >= height) {
			
				  
                  this.start = this.start + 12
				  
				  this.get_friends();
				  
				 
				  
				  
			   
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
				
		
			
			friends() {
				
				var friends = this.$store.getters.all_friends
				
				
				if (this.loaded == true) {
				if(friends.length>0) {
				this.none = false
				} else {
				
				this.none = true
				}
				
				}
				
				
				
				if(friends.length<100) {
				this.popular = true
				}
				
				
				
				
				return friends;
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

.user_friends .suggested{

float:left

}

.user_friends .center-wrapper{

width: 110%;
padding-left: 55px;
}

.panel, .panel-default {
background: #eee;

}

</style>
