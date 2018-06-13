<template>
<div class="left-container">
<div class="rightbar-vertical"></div>
<div class="leftbar-vertical"></div>
<div class="left-wrapper" v-if="showLeftBar==true">
<p></p>
<p style="font-weight:bold;">Your profile </p>

<div class="leftbar-auth">
<div class="auth-heading" >
<img id="avatar" :src="auth_user.avatar" width="40px" height="40px"  style="border-radius:50%;" alt="" :title="auth_user.name"/>
<a :href="'/profile/' + auth_user.slug">View</a>
</div>
</div>
<br>

<p style="font-weight:bold;" > Shortcuts</p>


<p class="side_bar"><img src="http://localhost:8000/icons/followers_icon.png" width="20px" height="20px"  alt="" /><a :href="'followers/' + auth_user.slug"> Followers ({{followersCount}})</a></p>
<p class="side_bar"><img src="http://localhost:8000/icons/following_icon.png" width="20px" height="20px"  alt="" /><a :href="'following/' + auth_user.slug"> Following ({{followingCount}})</a></p>
<p class="side_bar"><img src="http://localhost:8000/icons/unlike_icon.png" width="20px" height="20px"  alt="" /><a :href="'favourite'"> Likes</a></p>
<p class="side_bar"><img src="http://localhost:8000/icons/settings_icon.png" width="20px" height="20px"  alt="" /><a href="profile/edit/profile"> Settings</a></p>
<p class="side_bar"><img src="http://localhost:8000/icons/friends_icon.png" width="20px" height="20px"  alt="" /><a :href="'friends/' + auth_user.slug"> Friends ({{friendsCount}})</a></p>
<br>

<p style="font-weight:bold;">Explore</p>
<p class="side_bar"><img src="http://localhost:8000/icons/feed_icon.png" width="20px" height="20px"  alt="" /><a :href="'home'"> Friends News</a></p>
<p class="side_bar"><img src="http://localhost:8000/icons/feed_icon.png" width="20px" height="20px"  alt="" /><a :href="'newsfeed'"> Public News</a></p>



</div>

</div>
</template>

<script>

export default {

data() {

return {

friendsCount: '..',
followersCount: '..',
followingCount: '..',
showLeftBar:false,


}


},

props: ['id'],

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
				this.showLeftBar=true
				
				})


},

countFollowers() {

axios.get('/user/' + this.id + '/followers/' )
			.then(response => {
			
				this.followersCount = response.data.length
				
				})


},


countFollowing() {

axios.get('/user/' + this.id + '/following/' )
			.then(response => {
				this.followingCount= response.data.length
				
				})


},



},

computed: {

auth_user() {

var auth_user= this.$store.state.auth_user
return auth_user

}


}

}


</script>

<style>
.side_bar{
margin-left:0px;
padding:5px;
padding-right:15px;
background:transparent;
border:1px solid #eee;
font-size: small;
border-radius:0px;

}

.side_bar:hover{
background: rgba(0,0,0,0.1);
border:1px solid #eee;
}

.side_bar img {
	 margin-top: -4px;
	}
.side_bar a {
     font-size:small;
	 text-decoration: none;
	 color:rgb(0, 51, 0);
	}
	
.leftbar-auth {


}

.leftbar-auth img {

position: relative;
top: 0px;
left:0px;
}

.leftbar-auth a {

position: relative;
top: 2px;
left:0px;
color: rgb(0,51,0);
border: 1px solid rgb(0,51,0);
padding: 2px;
border-radius: 5px;
text-decoration:none;
font-size:small
}

.leftbar-auth a:hover {
background: rgb(0,51,0);
color:#fff

}

.auth-heading {


}

.left-wrapper a{

z-index:2;

}

.leftbar-vertical, .rightbar-vertical{
position: fixed;
right: 0px;
top:-15px;
width:50px;
height: 700px;
background: rgb(0,51,0);
}
.leftbar-vertical {
left:0px;

}
</style>    