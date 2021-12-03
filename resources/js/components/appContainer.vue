<template>
  <v-app class="grey lighten-4">
    <nav>
      <v-container>
        <v-snackbar v-model="snackbar" :timeout="4000" color="success" top>
          <span>Clerance registration was successfull !!</span>
          <v-btn @click="snackbar = false" text color="white">close</v-btn>
        </v-snackbar>
        <!-- edit snackbar -->
        <v-snackbar v-model="message" :timeout="4000" color="success" top>
          <span>Profile updated!!</span>
          <v-btn @click="message = false" text color="white">close</v-btn>
        </v-snackbar>
      </v-container>

      <v-app-bar app flat>
        <v-app-bar-nav-icon
          class="hidden-md-and-up"
          @click="drawer = !drawer"
        ></v-app-bar-nav-icon>

        <v-toolbar-title>C-APP</v-toolbar-title>

        <v-spacer></v-spacer>

        <v-btn icon @click="logout">
          <v-icon>mdi-export</v-icon>
        </v-btn>
      </v-app-bar>
      <v-navigation-drawer
        :permanent="$vuetify.breakpoint.mdAndUp"
        app
        class="indigo"
        v-model="drawer"
      >
        <v-layout column align-center>
          <v-flex class="mt-5">
            <v-avatar size="150">
              <img src="images/male1.png" alt="profile picture" id="avatar" />
            </v-avatar>
            <p class="white--text subheading mt-2 text-center">
              {{ user.name }}
            </p>
          </v-flex>
        </v-layout>
        <v-list>
          <v-list-item link router to="/">
            <v-list-item-action>
              <v-icon class="white--text">dashboard</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title class="white--text"
                >Dashboard</v-list-item-title
              >
            </v-list-item-content>
          </v-list-item>
        </v-list>

        <v-list>
          <v-list-item link router to="/profile">
            <v-list-item-action>
              <v-icon class="white--text">account_circle</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title class="white--text">Profile</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>
        <v-list>
          <v-list-item link router to="/messages">
            <v-list-item-action>
              <v-icon class="white--text">message</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title class="white--text"
                >Messages</v-list-item-title
              >
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-navigation-drawer>
    </nav>
    <v-main class="grey lighten-4">
      <v-container>
        <keep-alive>
          <router-view
            :user="user"
            v-on:showMessage="message = true"
            v-on:added="snackbar = true"
            v-on:dataChanged="getProfile()"
          ></router-view>
        </keep-alive>
      </v-container>
    </v-main>
  </v-app>
</template>
<script>
export default {
  data() {
    return {
      drawer: false,
      snackbar: false,
      message: false,
      user: [],
      hasApplied: this.$hasApplied,
      username: this.$username,
    };
  },
  mounted() {
    this.axios
      .get("http://localhost:3000/api/home/profile")
      .then((response) => {
        this.user = response.data;
      });
  },
  methods: {
    logout() {
      axios.post("/logout").then((response) => {
        window.location.href = "login";
      });
    },
    async getProfile() {
      await this.axios
        .get("http://localhost:3000/api/home/profile")
        .then((response) => {
          this.user = response.data;
        });
    },
  },
};
</script>