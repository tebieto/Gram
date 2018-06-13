
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('like', require('./components/Like.vue'));
Vue.component('followers-feed', require('./components/FollowersFeed.vue'));
Vue.component('following-feed', require('./components/FollowingsFeed.vue'));
Vue.component('friends-feed', require('./components/FriendsFeed.vue'));
Vue.component('favourite-feed', require('./components/FavouriteFeed.vue'));
Vue.component('news-feed', require('./components/NewsFeed.vue'));
Vue.component('profile-feed', require('./components/Profilefeed.vue'));
Vue.component('friends-header', require('./components/friendsHeader.vue'));
Vue.component('followers-header', require('./components/FollowersHeader.vue'));
Vue.component('following-header', require('./components/FollowingHeader.vue'));
Vue.component('profile-header', require('./components/ProfileHeader.vue'));

Vue.component('allnots', require('./components/AllNots.vue'));

Vue.component('auth_dropdown', require('./components/AuthDropDown.vue'));
Vue.component('leftbar', require('./components/Leftbar.vue'));
Vue.component('rightbar', require('./components/Rightbar.vue'));
Vue.component('centerbar', require('./components/Centerbar.vue'));
Vue.component('postvideo', require('./components/Postvideo.vue'));
Vue.component('comment_content', require('./components/Commentbody.vue'));
Vue.component('comments', require('./components/Comments.vue'));
Vue.component('media', require('./components/Media.vue'));
Vue.component('Upload_details', require('./components/UploadDetails.vue'));
Vue.component('content_body', require('./components/Body.vue'));
Vue.component('get_time', require('./components/Time.vue'));
Vue.component('init', require('./components/Init.vue'));
Vue.component('notimage', require('./components/Notimage.vue'));
Vue.component('friend', require('./components/Friend.vue'));
Vue.component('feed', require('./components/Feed.vue'));
Vue.component('unread', require('./components/UnreadNots.vue'));
Vue.component('post', require('./components/Post.vue'));
Vue.component('Notification', require('./components/Notification.vue'));

import { store } from './store'

const app = new Vue({
    el: '#app',
	store
});
