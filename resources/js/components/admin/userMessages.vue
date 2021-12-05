<template>
  <div class="userMessages">
    <v-container>
      <h2 class="display-2">messages</h2>
      <div v-if="userMessages">
        <div class="mb-3" v-for="(message, index) in userMessages" :key="index">
          <div>
            <h3>{{ message.name }}</h3>
          </div>
          <div v-for="msgs in message.sender_message" :key="msgs.id">
            <div>
              <ul>
                <li>{{ msgs["message"] }}</li>
              </ul>
            </div>
          </div>
          <div>
            <v-btn>reply message</v-btn>
          </div>
        </div>
      </div>
    </v-container>
  </div>
</template>
<script>
export default {
  data() {
    return {
      userMessages: [],
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