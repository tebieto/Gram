<template>

<div class="col-lg-4">
		
	<div  v-if="this.showHeader==true">		
	<div class="profile-heading profile-bubble"></div>
		<center >
			
			<img  id="avatar" class="profile-avatar" :src="this.avatar"  width="70px" height="70px" style="border-radius: 50%;" alt="" :title="this.name" />
			
			<div class="profile-nav"> <span> <a :href="'/profile/' + this.slug">Posts</a> </span> <span>Friends ({{this.friendsCount}})</span> <span> <a :href="'/followers/' + this.slug">Followers ({{this.followersCount}})</a> </span> <span> <a :href="'/following/' + this.slug">following  ({{this.followingCount}})</a> </span> </div>
			<div class="profile-button"><a  v-if="this.id == auth_user.id" href="/profile/edit/profile">Edit</a><friend :profile_user_id="this.id" v-if="this.id != auth_user.id"></friend></div>
		</center>
		<span class="profile-name">{{this.name}}'s Friends</span>
	</div>
	
		
</div>



</template>



<script>

export default {

props: ['avatar', 'name', 'id', 'slug'],

data() {

return {
start: 0,
trigger:0,
loading: false,
end:false,
friendsCount: '..',
followersCount: '..',
followingCount: '..',
showHeader:false,


}



},

mounted() {

this.countFriends()
this.countFollowers()
this.countFollowing()




},

methods: {

countFriends() {

axios.get('/user/' + this.id + '/friends/' )
			.then(response => {
			
				this.friendsCount= response.data.length
				
				})


},

countFollowers() {

axios.get('/user/' + this.id + '/followers/' )
			.then(response => {
			
				this.followersCount = response.data.length
					this.showHeader=true
				})


},


countFollowing() {

axios.get('/user/' + this.id + '/following/' )
			.then(response => {
				this.followingCount= response.data.length
				
				})


},


add_profile_feed() {

if (this.end ==  false) {

this.loading= true

axios.get('/feed/profile/' + this.id + '/' + this.start)
			.then(response => {
				console.log(response.data)
				
				response.data.forEach((feed) =>{
				
				this.$store.commit('add_profile_feed', feed)
				})
				
				
				
				if (response.data === 'undefined' || response.data.length < 6) {
				if (this.start >= 0) {
				
				this.end = true
				this.loading= false
				
				}
				
				
				}
				
				})



}

}


},

computed: {

auth_user() {

var auth_user =this.$store.state.auth_user
return auth_user


},

profile_feeds() {

var profie_feeds =this.$store.state.profile_feeds
return profie_feeds

}


}



}



</script>


<style>

.profile-nav{

position: absolute;
		top: 15px;
		left: -40px;
		width:1000px;
		font-weight:bold;

}

.profile-name {
font-weight: bold;
position: relative;
top: -40px;
left: 180px;
color: rgb(0, 51, 102);
font-size: medium;
margin-right: 20px;

}

.profile-bubble:before {
  content: "";
  width: 0px;
  height: 0px;
  position: absolute;
  border-left: 10px solid transparent;
  border-right: 10px solid transparent;
  border-top: 10px solid transparent;
  border-bottom: 10px solid #e5e5e5;
  left: 485px;
  top: 15px;
}


.profile-nav span {

margin-left:20px;

}

.profile-button{

position: relative;
top: -50px;
left:32px;

}

.profile-button button {
padding: 1px;
background: rgb(0, 153, 0);
border:none;

}

.profile-button button:hover {
padding: 1px;
background: rgba(0, 153, 0,0.7);

}

.profile-button a {
text-decoration: none;
background: rgb(0, 153, 0);
color:#fff;
padding: 5px;
border-radius: 5px;

}
.profile-button a:hover {

background: rgba(0, 153, 0, 0.7);
}

.profile-feed {
	margin-top: -50px;
    width: 1200px;

}




</style>