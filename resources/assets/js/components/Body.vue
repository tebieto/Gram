<template>

    <span >
		<span class="post_content">
							
			  <span class="fake_link"><a :href="'/profile/' + this.slug">{{this.name}}</a> </span> {{content.slice(0,post_length)}}<span  @click="show_all_post" v-if="content.length>post_length">...<span class="read_more">see more</span></span>
		</span>
		
		
    </span>

</template>



<script>

export default {

props: ['content', 'name', 'slug'],
data() {

	return {
	post_length: 150
	
	}

},

methods: {

	show_all_post() {
		if (this.post_length==150) {
		this.post_length= this.content.length
		} else {
		this.post_length = this.post_length + 50
		}
		
		
		}





}

}
</script>




<style>


.post_content {

word-wrap: break-word;

}

.read_more {
color: rgb(51,102,153);
cursor:pointer

}

</style>