<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" persistent max-width="600px">
      <template v-slot:activator="{ on, attrs }">
        <v-btn color="primary" dark v-bind="attrs" v-on="on" v-model="done">
          Apply for clearance
        </v-btn>
      </template>
      <v-card>
        <v-card-title>
          <span class="text-h5">Clearance Form</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-form ref="form" @submit.prevent="applyClearance">
              <v-row>
                <v-col cols="6">
                  <v-text-field
                    :rules="[reg.required, reg.regMin, reg.regMax]"
                    label="Reg no*"
                    required
                    v-model="student.reg_no"
                  ></v-text-field>
                </v-col>

                <v-col cols="6" sm="6">
                  <v-select
                    v-model="student.year_study"
                    :rules="required"
                    :items="['Year one', 'Year 2', 'Year 3', 'Year 4']"
                    label="Year of Study*"
                    required
                  ></v-select>
                </v-col>
                <v-col cols="6" sm="6">
                  <v-select
                    :rules="required"
                    v-model="student.course"
                    :items="[
                      'Computer Science',
                      'Bachelor of Commerce',
                      'Nursing',
                      'Engineering',
                      'Bachelor of Education',
                    ]"
                    label="Course*"
                    required
                  ></v-select>
                </v-col>
                <v-col cols="6" sm="6">
                  <v-select
                    :rules="required"
                    v-model="student.department"
                    :items="[
                      'Business',
                      'IT',
                      'Health',
                      'Engineering',
                      'Education',
                    ]"
                    label="Department*"
                    required
                  ></v-select>
                </v-col>
              </v-row>
              <v-btn type="submit" color="blue darken-1" :loading="loading">
                Save
              </v-btn>
            </v-form>
          </v-container>
          <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="dialog = false">
            Close
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>
<script>
export default {
  data: () => ({
    dialog: false,
    student: {},
    done: "true",
    loading: false,
    reg: {
      required: (v) => !!v || "required",

      regMin: (v) => (v && v.length >= 5) || "must have atleast 5 characters",
      regMax: (v) => (v && v.length <= 5) || "max 5 characters",
    },
    required: [(v) => !!v || "Required"],
  }),
  methods: {
    async applyClearance() {
      if (this.$refs.form.validate()) {
        this.loading = true;
        await this.axios
          .post("http://localhost:3000/api/home", this.student)
          .then((response) => {
            this.$router.push({ name: "dashboard" });
            this.loading = false;
            this.dialog = false;
            this.$emit("studentApplied");
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
  },
};
</script>