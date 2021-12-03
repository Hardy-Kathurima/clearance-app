<template>
  <div>
    <h1>Clearance form</h1>
    <v-container>
      <v-form class="px-3 w-50" @submit.prevent="applyClearance">
        <v-text-field label="Reg No:" v-model="student.reg_no"></v-text-field>
        <v-text-field
          label="Year Study:"
          v-model="student.year_study"
        ></v-text-field>
        <v-text-field label="Course:" v-model="student.course"></v-text-field>
        <v-text-field
          label="Department"
          v-model="student.department"
        ></v-text-field>
        <v-btn type="submit" class="indigo white--text mt-3 mx-0"
          >Submit details</v-btn
        >
      </v-form>
    </v-container>
  </div>
</template>
<script>
export default {
  data() {
    return {
      student: {},
    };
  },
  methods: {
    async applyClearance() {
      await this.axios
        .post("http://localhost:3000/api/home/store", this.student)
        .then((response) => {
          this.$router.push({ name: "dashboard" });
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>