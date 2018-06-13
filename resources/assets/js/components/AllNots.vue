<template>
<div>
     <div class="panel-heading"><b>All Notifications</b></div>
	
         <div class="panel-body">
          <ul class="list-group">
						
		   <li class="list-group-item all_nots" v-for="not in all_nots">
	        <img :src="not.data.avatar" width="30px" height="30px" style="border-radius: 50%;" alt="" title="not.data.name " />
	        &nbsp; <a :href="'/profile/' + not.data.slug">{{not.data.name}}</a>{{not.data.message}}  <small><get_time :get_time="not.created_at"></get_time> ago.</small><span class="pull-right"><friend :profile_user_id="not.data.id"></friend></span>
		   </li>
						
		  </ul>
         </div>
           
</div>

</template>

<script>

export default {

data() {
return {

slice:15,

}

},

mounted() {


this.get_all_nots();
this.scroller();


},



methods: {

get_all_nots(){

axios.get('/get_all_nots/' + this.slice).then(response=> {
				if(response.data.length>0) {
				response.data.forEach((not) => {
					this.$store.commit('add_all_not', not)
				})
				}
				
		});

},

scroller() {
		
		 window.onscroll = event => {
			
			
			var d = document.documentElement;
			var offset = d.scrollTop + window.innerHeight;
			var height = d.scrollHeight
			
		
			if (offset >= height) {
			
				  
                  this.slice = this.slice + 5
				  
				  this.get_all_nots();
			
		}
	   }
	
	},

},

computed: {

all_nots(){
			
	return this.$store.state.all_nots
			
},



}





}


</script>