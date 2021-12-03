<template>
  <v-container class="my-4">
    <v-layout row wrap justify-center>
      <v-flex xs12 sm12 lg6>
        <v-card class="text-center">
          <v-avatar size="120">
            <img src="images/male1.png" alt="alt" />
          </v-avatar>
          <v-card-title class="justify-center">Student profile</v-card-title>
          <v-card-text>
            <div class="subheading">Name: {{ user.name }}</div>
            <div class="subheading">Email: {{ user.email }}</div>
          </v-card-text>
          <v-card-actions> </v-card-actions>
          <EditProfile
            class="pa-5"
            :user="user"
            v-on:profileUpdated="getProfile()"
          />
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>
 
<script>
import EditProfile from "./editProfile";
export default {
  components: {
    EditProfile,
  },
  data() {
    return {
      user: [],
      student: [],
      userStudent: [],
      stations: [],
      username: this.$username,
      email: this.$email,
      hasApplied: this.$hasApplied,
    };
  },
  created() {
    this.axios.get("http://localhost:3000/api/home").then((response) => {
      this.stations = response.data.stations;
      this.userStudent = response.data.userStudent;
      this.student = response.data.student;
    });
  },
  mounted() {
    this.axios
      .get("http://localhost:3000/api/home/profile")
      .then((response) => {
        this.user = response.data;
      });
  },
  methods: {
    async getProfile() {
      await this.axios
        .get("http://localhost:3000/api/home/profile")
        .then((response) => {
          this.user = response.data;
          this.$emit("dataChanged");
          this.$emit("showMessage");
        });
    },
  },
};
</script>

<style>
</style>