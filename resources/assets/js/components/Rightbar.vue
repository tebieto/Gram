<template>
<div class="right-container">
<div class="right-wrapper">
<p></p>
<p style="font-weight:bold;">Followers</p>
<div  class="followers" v-for="follower in this.followers">
<img id="avatar" :src="follower.avatar" height="30px" width="30px" style="border-radius:50%; " :title="follower.name"/>
<a  :href="'/profile/' + follower.slug">{{follower.name.slice(0, 10)}}...</a>
</div>

<br>


<p style="font-weight:bold;">Following</p>

<div class="following" v-for="follow in this.following">
<img id="avatar" :src="follow.avatar" height="30px" width="30px" style="border-radius:50%; " :title="follow.name"/>
<a  :href="'/profile/' + follow.slug">{{follow.name.slice(0, 10)}}...</a>
</div>

<br>

<p style="font-weight:bold;">Contacts</p>

<div class="contacts" v-for="contact in this.friends">
<img id="avatar" :src="contact.avatar" height="30px" width="30px" style="border-radius:50%; " :title="contact.name"/>
<a  :href="'/profile/' + contact.slug">{{contact.name.slice(0, 10)}}...</a>
</div>

</div>
</div>
</template>


<script>

export default {

data() {

return {
friends: [],
followers: [],
following:[],

}



},

mounted() {

this.get_auth_friends()
this.get_auth_followers()
this.get_auth_following()




},


methods: {

get_auth_friends() {

axios.get('/auth/friends')
			.then(response => {
			
			response.data.forEach((friend) => {
			this.friends.push(friend)
			
			})
			
			})

},
get_auth_followers(){

axios.get('/auth/followers')
			.then(response => {
			response.data.forEach((follower) => {
			this.followers.push(follower)
			
			})
			
			})


},

get_auth_following(){

axios.get('/auth/following')
			.then(response => {
			response.data.forEach((follow) => {
			this.following.push(follow)
			
			})
			
			})

}


}



}





</script>

<style>
.contacts, .followers, .following {

margin:10px;
margin-left:-7px;
background:#eee;
padding: 5px;
font-size:small;


}

.contacts:hover, .followers:hover, .following:hover {

background: #ddd;


}

p{
font-size:small;

}

.contacts a, .followers a, .following a {

text-decoration: none;

}


</style>