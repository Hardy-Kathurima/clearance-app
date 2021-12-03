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
              item.from == 'user' ? 'justify-end' : null,
            ]"
          >
            <span v-if="item.from == 'user'" class="blue--text mr-3">{{
              item.msg
            }}</span>
            <v-avatar :color="item.from == 'user' ? 'indigo' : 'red'" size="36">
              <span class="white--text">{{ item.from[0] }}</span>
            </v-avatar>
            <span v-if="item.from != 'user'" class="blue--text ml-3">{{
              item.msg
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
                v-model="message.content"
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
  data: () => ({
    messages: [],
    user: [],
    message: null,
  }),

  methods: {
    send: function () {
      // this.messages.push({
      //   from: "user",
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
          this.messages = response;
          this.$emit("message replied");
        })
        .catch((error) => {
          console.log(error);
        });
    },
    addReply() {
      // this.messages.push({
      //   from: "Admin",
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