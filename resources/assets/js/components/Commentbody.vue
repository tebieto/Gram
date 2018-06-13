<template>
<div  class="comment_body comment_bubble">
	<span class="fake_link"><a :href="'/profile/' + this.slug">{{this.name}}</a></span>&nbsp;<span>{{this.content.slice(0, display)}}</span><span class="read_more" v-if="this.content.length>display" @click="more_comments">...see more</span>
</div>
</template>


<script>
export default {

data() {
return {

display: 150,


}


},

props: ['name', 'content', 'slug'], 


methods: {

more_comments() {
if (this.display ==150) {
this.display = this.content.length
}
else if (this.display<this.content.length) 
 this.display +=50

}



},




}

</script>