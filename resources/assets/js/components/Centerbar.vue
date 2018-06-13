<template>
<div class="right-container">
<div class="center-wrapper" v-if="suggestions.length>0">

<p style="font-weight:bold; padding-left: 10px; margin-bottom:0px;"> Suggestions</p>
<div v-for="suggestion in suggestions">
<div class="suggested">
<div class="suggest-heading">
<img id=" " :src="suggestion.avatar" height="50px" width="50px" style="border-radius:50%; " :title="suggestion.name"/>

</div>
<div><a :href="'/profile/' + suggestion.slug">{{suggestion.name.slice(0,11)}}<span v-if="suggestion.name.length>11">...</span></a></div>
<div class="suggested-status"><friend :profile_user_id="suggestion.id"></friend></div>
</div>


</div>

<div class="footer"><small><span><a href="#">Privacy</a> . <a href="#">Terms</a> . <a href="#">Cookies </a> .  <a href="#">About</a> . <a href="#">Help </a> .</span></small></div>
</div>


</div>
</template>




<script>

export default {

data() {

return {

suggestions: []


}



},

mounted() {

this.get_suggestions()


},


methods: {

get_suggestions() {

	axios.get('/user/suggestions')
			.then(response => {
			
			if(response.data.length>0) {
			response.data.forEach((suggestion) => {
			this.suggestions.push(suggestion)
			
			})
			
			} else {
			
			this.get_all_suggestions()
			
			}
			
			console.log(this.suggestions)
			
			})


},

get_all_suggestions() {

	axios.get('/all/suggestions')
			.then(response => {
			
			response.data.forEach((suggestion) => {
			this.suggestions.push(suggestion)
			
			})
			
			})


}



}



}


</script>

<style>

.suggested {
height: 150px;
width: 150px;
border-radius: 20px 20px 0px 0px;
background: #eee;

border: 1px solid #eee;
margin-bottom: 20px;
margin-left: 0px;

}

.suggested img {

position: relative;

left: 45px;

top: 20px;

}

.center-wrapper a {

position: relative;

left: 35px;

top: 30px;
text-decoration: none;


}

.center-wrapper button, .suggested-status span {

position: relative;

left: 37px;
padding:1px;
top: 40px;
text-decoration: none;
width: 70px;

}
.center-wrapper button {
background: transparent;
color: rgb(0, 51, 0);
border: 1px solid rgb(0, 51, 0);
font-size:small;

}

.center-wrapper button:hover {
background: rgb(0, 51, 0);

}

.suggest-heading {
border-radius: 5px 5px 0px 0px;
background: rgb(0, 51, 0);

}

.center-wrapper{
padding-left:20px;
margin-left: -49px;
width: 380px;

border-radius: 2px 2px 0px 0px;
padding-top: 5px;

margin-bottom: 20px;

}

.center-wrapper .suggested {
margin: 10px;
}

.footer{
position: absolute;
top: 500px;
left:-53px;
}

</style>