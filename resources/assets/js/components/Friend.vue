<template>
    
                    <div>
                       <span class="text-center" v-if="loading">
					   Loading...
					   </span>
					   
					   <div v-if="!loading">
					   <button class="btn btn-success" v-if="status == 0" @click="add_friend">Follow</button>
					   <button class="btn btn-success" v-if="status == 'pending'"  @click="accept_friend">Accept</button>
					   <span class="text-success" v-if="status == 'waiting'">Request sent</span>
					   <span class="text-success" v-if="status == 'friends'">Friends</span>
					   </div>
                    </div>
           
</template>

<script>
    export default {
	
        mounted() {
				axios.get('/check_relationship_status/'+ this.profile_user_id).then(response=> {
		console.log(response.data)
		var checked = response.data
		this.status = checked.status
		this.loading = false
		});
        },
		props: ['profile_user_id'],
		
		data() {
		
		return {
		
			status: '',
			loading: true
		}
		},
		
		methods: {
		add_friend() {
		
		this.loading = true
		axios.get('/add_friend/'+ this.profile_user_id).then(response=> {
		console.log(response.data)
		var checked = response.data
		if(checked == 1) {
		this.status = 'waiting'
		
		$.notify(
		"You request has been sent", { position:"top right" }
		);
		this.loading = false
		}
		});
		
		},
		
		accept_friend() {
		
		this.loading = true
		axios.get('/accept_friend/'+ this.profile_user_id).then(response=> {
		console.log(response.data)
		var checked = response.data
		if(checked == 1) {
		this.status = 'friends'
		
		$.notify(
		"You are now friends", { position:"top right" }
		);
		this.loading = false
		}
		});
		
		}
		
		}
    }
</script>