<template>
  <div class="userMessages">
    <v-container>
      <div></div>
      <!-- expansion panels -->
      <v-expansion-panels v-if="userMessages">
        <v-expansion-panel
          class="mb-3"
          v-if="message.sender_message.length > 0"
          v-for="(message, index) in userMessages"
          :key="index"
        >
          <v-expansion-panel-header>{{
            message.name
          }}</v-expansion-panel-header>
          <v-expansion-panel-content>
            <v-card>
              <v-card-text>
                <ul>
                  <li v-for="msgs in message.sender_message" :key="msgs.id">
                    <div class="sub-header font-weight-bolder">
                      {{ message.name }}
                    </div>
                    <div v-if="msgs.message">
                      <p>{{ msgs.message }}</p>
                    </div>
                  </li>
                </ul>
              </v-card-text>
              <!-- without footer -->
              <v-container class="justify-center">
                <v-row>
                  <v-col>
                    <div class="d-flex flex-row align-center ma-3">
                      <v-text-field
                        v-model="adminMessage.message"
                        placeholder="Type Something"
                        @keypress.enter="send"
                      ></v-text-field>
                      <v-btn icon><v-icon>send</v-icon></v-btn>
                    </div>
                  </v-col>
                </v-row>
              </v-container>
              <!-- end here -->
            </v-card>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-expansion-panels>
    </v-container>
  </div>
</template>
<script>
export default {
  data() {
    return {
      userMessages: [],
      adminMessage: {},
    };
  },
  mounted() {
    this.axios
      .get("http://localhost:3000/api/admin/home/userMessages")
      .then((response) => {
        this.userMessages = response.data.userMessages;
      })
      .catch((error) => {
        console.log(error);
      });
  },
  methods: {
    send() {
      this.axios
        .post(
          "http://localhost:3000/api/admin/home/userMessages",
          this.adminMessage
        )
        .then((response) => {
          console.log(adminMessage.receiver_id);
          this.$emit("message sent");
        })
        .catch((error) => {
          console.log(error);
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