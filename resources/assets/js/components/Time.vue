<template>
<div id="post_date">{{post_time}}</div>
</template>

<script>

export default {

props:['get_time'],

mounted () {

this.post_date();


},

methods: {

post_date() {


var today = new Date();

var offset = today.getTimezoneOffset() * 60


var today_UTC =	 Date.UTC (today.getUTCFullYear(), today.getUTCMonth(), today.getUTCDate(), today.getUTCHours(), today.getUTCMinutes(), today.getUTCSeconds())/1000



var post_date = this.get_time;

post_date = new Date(post_date)

var post_date_UTC =	 Date.UTC (post_date.getUTCFullYear(), post_date.getUTCMonth(), post_date.getUTCDate(), post_date.getUTCHours(), post_date.getUTCMinutes(), post_date.getUTCSeconds())/1000




var time= (today_UTC - post_date_UTC) + offset





if (time<60) {
time = Math.round(time + 0.5) -1

if (time<=1){
time ='just now'
} else {
time =time + 'secs'
}
}

else if (time<3600) {
time = time/60
time = Math.round(time + 0.5) -1

if(time > 1) {
time = time + 'mins'
} else {
time = time + 'min'
}
}

else if (time<86400) {
time = time/3600
time = Math.round(time + 0.5) - 1

if(time > 1) {
time = time + 'hrs'
} else {
time = time + 'hr'
}
}


else if (time<604800) {
time = time/86400
time = Math.round(time + 0.5) -1
if(time > 1) {
time = time + 'days'
} else {
time = time + 'day'
}
}




else if (time<2419200) {
time = time/604800
time = Math.round(time + 0.5) -1
if(time > 1) {
time = time + 'wks'
} else {
time = time + 'wk'
}
}

else if (time<29030400) {
time = time/2419200
time = Math.round(time + 0.5) -1
if(time > 1) {
time = time + 'mons'
} else {
time = time + 'mon'
}
}

else if (time>=29030400) {
time = time/29030400
time = Math.round(time + 0.5) -1
if(time > 1) {
time = time + 'yr'
} else {
time = time + 'yrs'
}
}

this.post_time = time;

}




},

data() {
return {

post_time: ''

}

},

computed: {



}



}

</script>

<style>

.panel-heading #post_date {
		
	position: relative;
	left: 50px;
	top: -25px;
	font-size: small;
	color: #000;
	}
.panel-heading{

height: 50px;
}

.panel-heading img {

top: -5px;
}

</style>