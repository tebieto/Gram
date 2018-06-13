<template>
<img :src="avatar" width="30px" height="30px" style="border-radius: 50%;" alt="" :title="name" />

</template>

<script>

export default {

	props: ['profile_slug'],


	mounted () {

	this.user_avi()
	},
	
	data() {
		
		return {
		
			avatar: '',
			name: ''
		}
		},
	
	methods: {
	
	user_avi(){
	axios.get('/avatar/'+ this.profile_slug).then(response=> {

		this.avatar= response.data.avatar
		this.name= response.data.name
		
		});
	
	},
	
	
	
	}


}
</script>