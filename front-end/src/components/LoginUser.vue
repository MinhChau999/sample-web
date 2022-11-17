<template>
  <div class="container">
    <div class="row">
      <form class="col-4 mx-auto bodered" @submit.prevent="login">
        <h2>Login</h2>
        <div class="mb-3">
          <label class="form-label">Email address</label>
          <input v-model="user.email" type="email" class="form-control" :class="{'is-invalid': errors.email}">
          <div v-if="errors.email" class="invalid-feedback">
            {{errors.email[0]}}
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input v-model="user.password" type="password" class="form-control" :class="{'is-invalid': errors.password}">
          <div v-if="errors.password" class="invalid-feedback">
            {{errors.password[0]}}
          </div>
        </div>
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label">Check me out</label>
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
import BaseRequest from '../core/BaseRequest'

export default {
  data() {
    return {
      user: {
        email:'',
        password:'',
      },
      errors: {},
      loading: false,
    };
  },
  mounted() {
    // this.checkLogin();
  },

  methods:{
    login() {
      this.loading = true;
      BaseRequest.post('login',this.user)
      .then(response => {
        window.localStorage.setItem('token', response.data.token);
        this.$router.push({name : 'dashboard'});
      })
      .catch(error => {
        this.loading = false;
        this.errors = error.response.data.errors;
      })
    },
    checkLogin() {
      let token = window.localStorage.getItem('token');
      this.axios.get('http://localhost:8000/api/user',
        { headers: { Authorization: 'Bearer '+ token, }})
      .then(response => {
        if (response != 'undefined'){
          this.$router.push({name: 'dashboard'});
        }
      })
    }
  }

}
</script>

<style>

</style>