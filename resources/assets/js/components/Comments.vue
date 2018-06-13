<template>
<div>
	<p v-if="this.display>1" class="previous_comment" @click="hidecomment"><span class="fake_link">Hide</span></p>
	<p v-if="this.comment_count > this.display" class="previous_comment" @click="prevcomment"><span class="fake_link">View previous {{comment_spell}}</span></p>
	
	<div v-for="comment in comments">
    <div class="comment_wrapper" >
	<img id="avatar" class="comment_avatar" :src="comment.user.avatar" height="30px" width="30px" style="border-radius:50%; " :title="comment.user.name"/>
  
	<comment_content :slug="comment.user.slug" :name="comment.user.name" :content="comment.content"></comment_content>
	</div>
	</div>
	
	<div class="textarea_wrapper">
	
	<img id="avatar" class="send_comment_avatar" :src="auth_user.avatar" height="30px" width="30px" style="border-radius:50%; " :title="auth_user.name"/>
	<div v-if="!show_post_spinner">
	<textarea  class="comment_textarea" rows="2"  :placeholder="'Add a comment...'" v-model="commentbody" v-on:keyup.enter="sendcomment()"></textarea>
	</div>
	
	</div>
	<div class="post_spinner_wrapper pull right" v-if="show_post_spinner">
	<div class="post_spinner"></div>
	</div>
</div>
</template>



<script>

export default {

	mounted() {
	
	
	
	},
	
	data() {
		
		return {
		
			
			type: this.new,
			commentbody: '',
			show_post_spinner:false,
			display: 1,
			comment_count: '',
			comment_spell: ''
		
		}
		},
	
	props: ['id', 'new'],
	
	methods: {
		prevcomment() {
		if(this.comment_count > this.display)
		this.display +=3
		
		},
		
		hidecomment() {
		
		this.display =1
		
		},
		
		sendcomment() {
		this.show_post_spinner=true
		const config = {headers: {'Content-Type': 'multipart/form-data'}};
				axios.post('/add/comment', {content: this.commentbody, postid: this.id})
				.then( (response) => { 
					this.get_new_comment()
					
					})
		
		 this.commentbody=''
		
		
		},
		
		get_new_comment() {
			
			axios.get('/new/comment/' + this.id)
			.then(response => {
			
			console.log(response.data)
			
			var add_auth_comment
			
			if (this.type == 'new') {
			add_auth_comment = 'add_new_post_comment'
			
			}
			else if(this.type == 'old') {
			
			add_auth_comment = 'add_old_post_comment'
			}
			
			response.data.forEach((comment) => {
					this.$store.commit(add_auth_comment, comment)
				})
				
			})
			
			this.show_post_spinner=false
			
			},
	
	
	},
	
	computed: {
	
	auth_user() {
	
		var auth_user = this.$store.state.auth_user
		
		return auth_user
	},
	
		post() {
		if (this.type == 'old') {
			return this.$store.state.posts.find((post) => {
				return post.id === this.id
			})
		}
		else if(this.type == 'new') {
		
		return this.$store.state.new_posts.find((post) => {
				return post.id === this.id
			})
		}
		
		},
		
	
		
		comments() {
		
		var comments = []
		
		this.post.comments.forEach((comment) => {
		
		comments.push(comment)
		})
		
		this.comment_count= comments.length
		
		var difference = this.comment_count - this.display
		if (difference > 1) {
		this.comment_spell = 'comments'
		}else {
		this.comment_spell = 'comment'
		}
		return comments.splice(-this.display)
		
		
		},
	}
		
}

</script>