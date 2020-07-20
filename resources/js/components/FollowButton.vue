<template>
  <div>
    <button class="btn btn-primary ml-4" @click="followUser()">Follow</button>
  </div>
</template>

<script>
export default {
  props: ["userId"],

  mounted() {
    console.log("Component mounted.");
  },
  data() {
    return {};
  },

  methods: {
    followUser() {
      axios.post("/follow/" + this.userId).then(response => {
        console.log(response); // will return a json array with attached and detached, associated model will be in one of them
      });
    }
  }
};
</script>
