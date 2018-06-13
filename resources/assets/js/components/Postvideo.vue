<template>
<div @click="playvid" class="video_padding">
<div class="video_botton_container"  :id="this.vid +'button'" style="visibility:hidden">
<div class="media play" ></div>
</div>
<video :id="this.vid" class="postFile" width="100%" height=""  controls >
			
  <source :src="this.link" :type="this.type">
</video>


</div>

</template>


<script>

export default {

props: ['vid', 'link', 'type'],

data () {

return {




}



},

mounted() {


this.togglepause()


this.mediaToggle()	 
	 
},

methods: {


playvid() {

	
	this.$store.commit('update_video_id', {
				
				vid: this.vid
				})
				
	var mediaplayer
	mediaplayer = document.getElementById(this.vid)
	
	if(mediaplayer.paused || mediaplayer.ended) {
	 mediaplayer.play()
	 mediaplayer.volume=1
	 
	 }
	 else {
	 mediaplayer.pause()
	
	 }
	
	},
	
mediaToggle() {


	 var timer = 0
     var mediaplayer
	 mediaplayer = document.getElementById(this.vid)
	 var playtoggle
	 playtoggle = document.getElementById(this.id + "button")
	
	 mediaplayer.onended= function() {mediaplayer.play()}
	 mediaplayer.controls=false
	 mediaplayer.volume=0
	 mediaplayer.play()
	 var seti = setInterval(pausevideo, 700)
	 function pausevideo() {
	 if(timer==1) {
	 clearInterval(seti)
	 mediaplayer.pause()
	 
	 }else {
	 timer +=1
	 }
	 
	 }
	  

},

togglepause(){

var mediaplayer
mediaplayer = document.getElementById(this.vid)
var vid = this.vid + 'button'
mediaplayer.onpause= function() {
var playtoggle
playtoggle = document.getElementById(vid)
playtoggle.style.visibility= "visible";
}

mediaplayer.onplay= function() {
var playtoggle
playtoggle = document.getElementById(vid)
playtoggle.style.visibility= "hidden";
}

},



},






}
</script>

<style>
  .media.play {
 
  box-sizing: border-box;
  width: 50px;
  height: 50px;
  border-style: solid;
  border-color: #202020;
  border-width: 25px 0px 25px 40px;
  border-color: transparent transparent transparent rgba(255,255,255, 0.9);
  

}

.video_padding{

width:100%;
height:190px;


}

.video_botton_container{
background: rgba(0,51,0,0.5);
width:80px;
height:80px;
border-radius: 50%;
border: 2px solid #f3f3f3;
position:relative;
margin-bottom: -180px;
margin-top: 100px;
margin-left: 200px;
padding:20px;
padding-top:15px;
padding-left:23px;

}


</style>