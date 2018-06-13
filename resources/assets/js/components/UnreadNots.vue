<template>
	
	<span class="notifications" @click="shownoty">
		
		<img v-if="clicked"src="http://localhost:8000/icons/white_notify_icon.png" width="20px" height="20px"  alt="" />
		<img v-if="!clicked"src="http://localhost:8000/icons/notify_icon.png" width="20px" height="20px"  alt="" />
		<span v-if="all_nots_count>0" class="noty_badge" width="20px" height="5px" style="border-radius: 30%;">{{all_nots_count}}</span>
		<div v-if="clicked" class="fixed_noty" style="float:left">
		
		
		<div class="show_notification noty_bubble" @click.stop>
		<div class="custom-heading"><b>Notifications</b></div>
		<div class="notyscroll">
		<div class="custom-body" v-for="not in all_nots">
		<img :src="not.data.avatar" width="30px" height="30px" style="border-radius:50%"id="avatar" alt="" /><a :href="'/profile/' + not.data.slug">{{not.data.name}}</a>{{not.data.message}} <small><get_time :get_time="not.created_at"></get_time> ago.</small> <span><friend :profile_user_id="not.data.id"></friend></span></div> 
		<div class="custom-body" v-if="all_nots.length<1">You currently do not have any new notification.</div>
		</div>
		<div class="custom-body custom-footer"><center><a href="http://localhost:8000/notifications">See All</a></center></div>
		</div>
		
		</div>
	</span>
	
</template>

<script>

	export default	{
		data() {
			
			return {
			clicked: false,
			
			
			}
		
		
		},
		mounted() {
		
			this.get_unread()
		
		},
		
		methods: {
			shownoty(){
			this.mark_as_read()
			this.$store.commit('clear_not_count')
			if (this.clicked==false) {
			
			this.clicked= true
			
			
			
			
			} else {
			
			this.clicked= false
			
			}
			
			
			},
			get_unread() {
				axios.get('/get_unread').then(response=> {
				if(response.data.length>0) {
				response.data.forEach((not) => {
					this.$store.commit('add_new_not', not)
				})
				}
				
				});
			},
			
			mark_as_read(){
			
			axios.get('/mark/notifications').then(nots=> {
				
				
				});
			
			
			}
		},
		
		computed: {
			all_nots_count() {
				return this.$store.getters.all_nots_count
			},
			
			all_nots(){
			
				return this.$store.state.new_nots.reverse()
			
			},
		}
		
		}
</script>

<style>
.noty_badge {
background: red;
color: white;
padding-left: 3px;
padding-right: 3px;
position: relative;
top:-5px;
left: -15px;
font-size:small;
cursor:pointer;

}
.noty_badge a:hover{
cursor: pointer;
}

.notifications{
		background:none;
		
	}
	
.fixed_noty{
position:fixed;
top:0px;
left:0px;
background:transparent;
width:1500px;
height:1200px;
z-index:2
}

.show_notification{
background: rgb(255,255,255);
position:fixed;
top:47px;
left:620px;
min-width:400px;


border-radius: 4px;
box-shadow: 1px 1px 2px 1px #ccc;
}

.notyscroll{
max-height:400px;
overflow-y:auto;
}

.notifications img{
cursor: pointer;

}

.custom-body a {

color:blue;
margin:0px;
}
.custom-footer a {

color: rgba(0,0,0,0.3);
}
.custom-heading, .custom-body {
min-width:15px;
padding:5px;

}

.custom-body{
border-top:1px solid #ddd;

}



</style>