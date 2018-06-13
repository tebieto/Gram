<template>
    <div>
	
    </div>
	
	
</template>

<script>
    export default {
	props:['user'],
        mounted() {
		
		this.listen()
            
        }, 
		
		props: ['id'],
		
		methods: {
		
		listen() {
		Echo.private('App.User.' + this.id)
		.notification( (notification) => {
		$.notify(
		notification.name + ' ' + notification.message, { position:"top right" }
		);
		
		axios.get('/get_unread').then(response=> {
				if(response.data.length>0) {
				response.data.forEach((not) => {
					this.$store.commit('add_new_not', not)
				})
				}
				
				});

		document.getElementById('noty_audio').play();
		})
	 }
	}
   }
</script>
