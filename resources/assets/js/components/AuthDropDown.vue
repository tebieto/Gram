<template>

<span>
                                
<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
   <img :src="auth_user.avatar" width="20px" height="20px"  style="border-radius:50%;" alt="" /> {{ auth_user.name }} <span class="caret"></span>
 </a>

</span>
</template>


<script>

export default {

computed: {

auth_user(){
		
	var auth_user_id = this.$store.state.auth_user
		
	return auth_user
	},

}



}

</script>