<template>
  <div class="userMessages">
    <v-container>
      <h2 class="display-2">User messages</h2>

      <v-expansion-panels>
        <v-expansion-panel
          class="mb-3"
          v-for="(message, index) in userMessages"
          :key="index"
        >
          <v-expansion-panel-header
            >{{ `message from ${message.sender.name}` }}
            <span class="ml-14">unread(0)</span>
          </v-expansion-panel-header>
          <v-expansion-panel-content>
            <v-card>
              <v-card-text>
                <p>
                  <span class="sender pa-2 indigo white--text">{{
                    `${message.sender.name[0]}`
                  }}</span>

                  {{ ` ${message.message}` }}
                </p>
                <span class="font-weight-bold">{{
                  `Sent at ${message.created_at}`
                }}</span>
              </v-card-text>
            </v-card>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-expansion-panels>
      <div>{{ usermessages }}</div>
    </v-container>
  </div>
</template>
<script>
export default {
  data() {
    return {
      userMessages: [],
      singleUser: [],
    };
  },
  mounted() {
    this.axios
      .get("http://localhost:3000/api/admin/home/userMessages")
      .then((response) => {
        this.userMessages = response.data;
      })
      .catch((error) => {
        console.log(error);
      });
  },
  computed: {
    combineMessages() {
      this.userMessages.forEach((message) => {
        this.singleUser = message.push;
      });
    },
  },
};
</script>
<style scoped>
.sender {
  height: 20px;
  width: 20px;
  border: 2px solid;
  border-radius: 50%;
}
</style>