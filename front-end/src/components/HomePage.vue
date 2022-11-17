<template>  
   <div class="container">
      <div class="row">
         <h2>Đây là trang HomePage</h2>
      </div>
      <div class="row" v-for="post in posts" :key="post.id">
         <h3>{{post.title}}</h3>
         <h6>{{post.content}}</h6>
      </div>
   </div>
</template>

<script>
import BaseRequest from "../core/BaseRequest"
export default {
   data() {
    return {
      posts:{},
      loading: false,
    };
   },
   mounted() {
      this.getPost()
   },

   methods: {
      getPost(){
         BaseRequest.get('post')
         .then(response =>{
            this.posts = response.data;
            console.log(this.posts);
         })
         .catch(error => {
            console.log(error);
         })
      },
   }
}
</script>

<style>

</style>