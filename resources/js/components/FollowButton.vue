<template>
  <div>
    <button class="btn btn-primary ml-4" @click="followUser()" v-text="buttonText"></button>
  </div>
</template>

<script>
export default {
  props: ["userId", "follows"],

  mounted() {
    console.log("Component mounted.");
  },
  data() {
    return {
      status: this.follows
    };
  },

  methods: {
    followUser() {
      axios
        .post("/follow/" + this.userId)
        .then(response => {
          this.status = !this.status;
          console.log(response); // will return a json array with attached and detached, associated model will be in one of them
        })
        .catch(errors => {
          if (errors.response.status == 401) {
            window.location = "/login";
          }
        });
    }
  },

  computed: {
    buttonText() {
      return this.status ? "Unfollow" : "Follow";
    }
  }
};
</script>
