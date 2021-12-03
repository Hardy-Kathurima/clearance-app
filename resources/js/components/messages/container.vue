<template>
  <v-container>
    <v-app-bar color="indigo">
      <v-app-bar-nav-icon :to="{ name: 'dashboard' }">
        <v-icon color="white">dashboard</v-icon>
      </v-app-bar-nav-icon>
      <v-toolbar-title class="white--text">user </v-toolbar-title>
    </v-app-bar>
    <v-container class="fill-height">
      <v-row class="fill-height" align="end">
        <v-col>
          <div
            v-for="(item, index) in messages"
            :key="index"
            :class="[
              'd-flex flex-row align-center my-2',
              item.sender_id == user_id ? 'justify-end' : null,
            ]"
          >
            <span v-if="item.sender_id == user_id" class="blue--text mr-3">{{
              item.message
            }}</span>
            <v-avatar
              :color="item.sender_id == user_id ? 'indigo' : 'red'"
              size="36"
            >
              <span class="white--text">{{ username[0] }}</span>
            </v-avatar>
            <span v-if="item.sender_id != user_id" class="blue--text ml-3">{{
              item.message
            }}</span>
          </div>
        </v-col>
      </v-row>
    </v-container>
    <v-footer fixed class="justify-center" app inset>
      <v-container class="ma-0 pa-0">
        <v-row no-gutters>
          <v-col>
            <div class="d-flex flex-row align-center">
              <v-text-field
                ref="text-message"
                v-model="message.message"
                placeholder="Type Something"
                @keypress.enter="send"
              ></v-text-field>
              <v-btn icon class="ml-4" @click="send"
                ><v-icon>mdi-send</v-icon></v-btn
              >
            </div>
          </v-col>
        </v-row>
      </v-container>
    </v-footer>
  </v-container>
</template>

<script>
export default {
  // props: ["user"],
  data() {
    return {
      messages: [],
      user: [],
      message: {},
      user_id: this.$userID,
      username: this.$username,
    };
  },
  mounted() {
    this.axios
      .get("http://localhost:3000/api/home/messages")
      .then((response) => {
        this.messages = response.data;
        this.$emit("message replied");
      })
      .catch((error) => {
        console.log(error);
      });
  },

  methods: {
    send: function () {
      // this.messages.push({
      //   sender_id: "user",
      //   msg: this.msg,
      // });
      // this.msg = null;
      // this.addReply();
      this.axios
        .post("http://localhost:3000/api/home/messages", this.message)
        .then((response) => {
          this.$emit("message sent");
          this.getMessages();
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getMessages() {
      this.axios
        .get("http://localhost:3000/api/home/messages")
        .then((response) => {
          this.messages = response.data;
          this.$emit("message replied");
        })
        .catch((error) => {
          console.log(error);
        });
    },
    addReply() {
      // this.messages.push({
      //   sender_id: "Admin",
      //   msg: "Thankyou for contacting us",
      // });
    },
  },
};
</script>

<style scoped>
.v-text-field {
  width: 300px;
}
</style>