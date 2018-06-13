<template>

	<div>
	
	<div max-width="20px" max-height="20px">
	<span class="react_icons"><img src="http://localhost:8000/icons/unlike_icon.png" width="20px" height="20px"  v-if="auth_user_click_like===true" @click="unlike()" alt="" />
	
	<img src="http://localhost:8000/icons/like_icon.png" width="20px" height="20px"  v-else-if="auth_user_click_like===false" @click="like()" alt="" />
	
	<img src="http://localhost:8000/icons/like_icon.png" width="20px" height="20px"  v-else-if="!auth_user_likes_post" @click="like()" alt="" />

	<img src="http://localhost:8000/icons/unlike_icon.png" width="20px" height="20px"  v-else @click="unlike()" alt="" />
	&nbsp;<span class="likers_count">{{likers_count}}</span><span class="likers_count">{{just_like}}</span>
	</span>
	</div>
	<!--
	<span class="text-center" v-for="like in sliced_likers" >
	<img class="like_avi" id="avatar" :src="like.user.avatar"  height="20px" width="20px" style="border-radius:50%;" :title="like.user.name"/>
	
	</span>
	<img class="like_avi" v-if="show_auth_avatar===true" id="avatar" :src="auth_user_avatar"  height="30px" width="30px" style="border-radius:50%;" :title="auth_user_name"/>
	
	-->
	</div>
</template>

<script>

export default {

	mounted() {
	
	
	
	},
	
	data() {
		
		return {
		
			auth_user_click_like: '',
			show_auth_avatar: false,
			type: this.new,
			just_like: ' '
		
		}
		},
	
	props: ['id', 'new'],
	
	methods: {
	
		like() {
			if (this.type=='new') {
			this.just_like = 1 + ' Like'
			this.show_auth_avatar=true
			}
			this.auth_user_click_like=true
			
			if(this.auth_user_likes_post==false || this.type=='new') {
			axios.get('/like/' + this.id)
			.then(resp=> {
			if (this.type == 'old') {
			if (resp.data != false) {
				this.$store.commit('update_post_likes', {
				id: this.id,
				like: resp.data
				})
				
				
				this.show_auth_avatar=false
				
				}
				
				}
				
			})
			
			}
			
			
		
		},
		
		
		unlike() {
		if (this.type=='new') {
		this.just_like = ' '
		}
		if(this.auth_user_likes_post==true || this.type=='new') {
		
		if (this.type == 'old') {
		this.$store.commit('unlike_post', {
				post_id: this.id,
				id: this.auth_id
				})
				
				}
				
		this.auth_user_click_like=false
		
		axios.get('/unlike/' + this.id)
			.then(resp=> {
			
			
			
			
			})
			
			}
		 
		
		}
	
	
	},
	
	computed: {
	
	
		post() {
		if (this.type == 'old') 
			return this.$store.state.posts.find((post) => {
				return post.id === this.id
			})
		
		},
		
	
		
		likers() {
		if (this.type == 'old')  {
		var likers = []
		
		this.post.likes.forEach((like) => {
		
		likers.push(like.user.id)
		})
		
		return likers
		
		}
		},
		
		sliced_likers() {
		
		if (this.type == 'old') {
	
		var sliced_likers = this.post.likes.slice(-12)
		
		return sliced_likers
		
		}
		
		},
		
		likers_count() {
		
		if (this.type == 'old') {
		
		var likers_count = this.post.likes.length
		if (likers_count >0) {
		var likes
		if (likers_count==1) {
		likes = 'Like'
		}else {
		likes = 'Likes'
		}
		likers_count = likers_count + ' '+ likes
		
		return likers_count
		
		}
		
		return likers_count =''
		
		
		}
		
		},
		
		auth_user_avatar(){
		
		
		
		var auth_user_avatar = this.$store.state.auth_user.avatar
		
		return auth_user_avatar
	},
		auth_user_name(){
		
		var auth_user_name = this.$store.state.auth_user.name
		
		return auth_user_name
	},
		
		auth_user_likes_post() {
		
		if (this.type == 'old') {
		
		var check_index = this.likers.indexOf (
			this.$store.state.auth_user.id
		)
		if (check_index === -1)
		
		
			return false
			
			
		else
			return true
			
			}
		
		}
	
	}
}

</script>

<style>

.react_icons, .like_avi{

cursor:pointer;


}
.likers_count {
color : blue;
cursor: pointer

}

</style>