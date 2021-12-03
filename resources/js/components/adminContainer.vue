<template>
  <v-app class="grey lighten-4">
    <nav>
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
        <!-- <v-layout column align-center>
          <v-flex class="mt-5">
            <v-avatar size="150">
              <img
                src="/public/images/male1.png"
                alt="profile picture"
                id="avatar"
              />
            </v-avatar>
            <p class="white--text subheading mt-2 text-center">Admin</p>
          </v-flex>
        </v-layout> -->
        <v-list class="mt-14">
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
          <v-list-item link router to="/manageUsers">
            <v-list-item-action>
              <v-icon class="white--text">group</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title class="white--text"
                >Manage users</v-list-item-title
              >
            </v-list-item-content>
          </v-list-item>
        </v-list>
        <v-list>
          <v-list-item link router to="/clearStudent">
            <v-list-item-action>
              <v-icon class="white--text">person_remove_alt_1</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title class="white--text"
                >Clear student</v-list-item-title
              >
            </v-list-item-content>
          </v-list-item>
        </v-list>

        <v-list>
          <v-list-item link router to="/userMessages">
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
          <router-view></router-view>
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
      hasApplied: this.$hasApplied,
      username: this.$username,
    };
  },

  methods: {
    logout() {
      axios.post("/logout").then((response) => {
        window.location.href = "/login";
      });
    },
  },
};
</script>