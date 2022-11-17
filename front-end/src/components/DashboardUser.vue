<template>
  <div class="container">
    <div class="row">
      <form class="col-6 mx-auto bodered" @submit.prevent="createPost">
        <h2>Post</h2>
        <div class="mb-3">
          <label class="form-label">Title</label>
          <input v-model="post.title" type="title" class="form-control" :class="{'is-invalid': errors.title}">
          <div v-if="errors.title" class="invalid-feedback">
            {{errors.title[0]}}
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label">Content</label>
          <textarea 
            v-model="post.content" 
            type="content" 
            rows="15"
            class="form-control" 
            :class="{'is-invalid': errors.content}"
            >
          </textarea>
          <div v-if="errors.content" class="invalid-feedback">
            {{errors.content[0]}}
          </div>
        </div>
        <div v-if="loading" class="spinner-border text-primary mt-2 me-3" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</template>

<script>
import BaseRequest from '../core/BaseRequest';

export default {
  data() {
    return {
      post:{
        title: '',
        content: '',
      },
      errors: {},
      loading: false,
    };
  },

  mounted() {
    this.checkLoggedIn();
  },

  methods:{
    checkLoggedIn() {
      BaseRequest.get('user')
      .then(() => {
      })
      .catch(() => {
        this.$router.push({name : 'login'});
      })
    },

    createPost() {
      this.loading = true;
      BaseRequest.post('post', this.post)
      .then(() => {
        alert('Đăng bài thành công');
        this.loading = false;
        this.post = {title: '', content: '',}
      })
      .catch(error => {
        this.loading = false;
        this.errors = error.response.data.errors;
      })
    }
  }
}
</script>

<style>

</style>