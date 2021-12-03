<template>
  <div class="popup">
    <v-row justify="center">
      <v-dialog v-model="dialog" persistent max-width="600px">
        <template v-slot:activator="{ on, attrs }">
          <v-btn
            :to="{ name: 'edit', params: { id: user.id } }"
            @click="editStudent(user.id)"
            color="primary"
            dark
            v-bind="attrs"
            v-on="on"
            v-model="done"
          >
            <v-icon left small>edit</v-icon>
            <span>Edit profile</span>
          </v-btn>
        </template>
        <v-card>
          <v-card-title>
            <span class="text-h5">Edit profile</span>
          </v-card-title>
          <v-card-text>
            <v-container>
              <v-form ref="form" @submit.prevent="updateProfile">
                <v-row>
                  <v-col cols="6">
                    <v-text-field
                      :rules="required"
                      label="User name*"
                      required
                      v-model="user.name"
                    ></v-text-field>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="6">
                    <v-text-field
                      :rules="required"
                      label="Email*"
                      required
                      v-model="user.email"
                    ></v-text-field>
                  </v-col>
                </v-row>
                <v-row>
                  <small>*indicates required field</small>
                </v-row>
                <v-row class="mt-3">
                  <v-btn type="submit" color="blue darken-1" :loading="loading">
                    update
                  </v-btn>
                </v-row>
              </v-form>
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
              :to="{ name: 'profile' }"
              color="blue darken-1"
              text
              @click="dialog = false"
            >
              Close
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-row>
  </div>
</template>
<script>
export default {
  data: () => ({
    dialog: false,
    editedId: "",
    user: [],
    student: {},
    done: "true",
    loading: false,
    required: [(v) => !!v || "Required"],
  }),
  mounted() {
    this.axios
      .get("http://localhost:3000/api/home/profile")
      .then((response) => {
        this.user = response.data;
      });
  },
  methods: {
    editStudent(id) {
      this.dialog = true;
      this.editedId = id;
    },
    updateProfile() {
      if (this.$refs.form.validate()) {
        this.loading = true;
        this.axios
          .put(
            `http://localhost:3000/api/home/profile/${this.$route.params.id}`,
            this.user
          )
          .then((res) => {
            this.$router.push({ name: "profile" });
            this.loading = false;
            this.dialog = false;
            this.$emit("profileUpdated");
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
  },
};
</script>