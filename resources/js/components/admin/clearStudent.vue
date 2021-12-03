<template>
  <div class="data-table">
    <v-text-field
      class="mx-4 my-3 w-50"
      v-model="search"
      append-icon="search"
      label="search"
      single-line
      hide-details
    >
    </v-text-field>
    <v-data-table
      :headers="headers"
      :items="students"
      :search="search"
      :page.sync="page"
      :items-per-page="itemsPerPage"
      hide-default-footer
      sort-by="id"
      class="elevation-1"
      @page-count="pageCount = $event"
    >
      <!-- academic status -->
      <template v-slot:item.academic="{ item }">
        <span>{{ `${setStatus(item.academic)}` }}</span>
      </template>
      <!-- library status -->
      <template v-slot:item.library="{ item }">
        <span>{{ `${setStatus(item.library)}` }}</span>
      </template>
      <!-- finance status -->
      <template v-slot:item.finance="{ item }">
        <span>{{ `${setStatus(item.finance)}` }}</span>
      </template>
      <!-- hostel status -->
      <template v-slot:item.hostel="{ item }">
        <span>{{ `${setStatus(item.hostel)}` }}</span>
      </template>
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>Manage students</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>
          <v-dialog v-model="dialog" max-width="600px">
            <v-card>
              <v-card-title>
                <span class="text-h5">{{ formTitle }}</span>
              </v-card-title>

              <v-card-text>
                <v-card class="d-flex pa-2 justify-space-around flex-wrap mb-3">
                  <div
                    v-for="(value, name, index) in editedItem.sections"
                    :key="index"
                  >
                    <div>{{ name }}:{{ value }}</div>
                  </div>
                </v-card>

                <h5>Clearance status</h5>
                <v-container>
                  <v-row>
                    <v-col cols="12" sm="6" md="6">
                      <v-select
                        item-text="name"
                        item-value="status"
                        v-model="editedItem.academic"
                        :items="clearStatus"
                        label="Academics"
                      >
                      </v-select>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                      <v-select
                        item-text="name"
                        item-value="status"
                        v-model="editedItem.finance"
                        :items="clearStatus"
                        label="Finance"
                      >
                      </v-select>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                      <v-select
                        item-text="name"
                        item-value="status"
                        v-model="editedItem.library"
                        :items="clearStatus"
                        label="Library"
                      >
                      </v-select>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                      <v-select
                        item-text="name"
                        item-value="status"
                        v-model="editedItem.hostel"
                        :items="clearStatus"
                        label="Hostel"
                      >
                      </v-select>
                    </v-col>
                  </v-row>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="close">
                  Cancel
                </v-btn>
                <v-btn color="blue darken-1" text @click="save"> Save </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-toolbar>
      </template>
      <template v-slot:item.actions="{ item }">
        <v-icon small class="mr-2 blue--text" @click="editItem(item)">
          mdi-pencil
        </v-icon>
      </template>
      <template v-slot:no-data>
        <v-btn color="primary" @click="initialize"> Reset </v-btn>
      </template>
    </v-data-table>
    <div class="text-center pt-2">
      <v-pagination v-model="page" :length="pageCount"></v-pagination>
    </div>
  </div>
</template>
<script>
export default {
  data: () => ({
    search: "",
    page: 1,
    pageCount: 0,
    itemsPerPage: 5,
    dialog: false,

    headers: [
      { text: "Name", value: "student.username" },
      { text: "Academic", value: "academic" },
      { text: "Library", value: "library" },
      { text: "Finance", value: "finance" },
      { text: "Hostel", value: "hostel" },

      { text: "Clear Student", value: "actions", sortable: false },
    ],
    students: [],
    status: ["cleared", "pending"],
    defaultSelected: {
      name: "Cleared",
      status: "1",
    },
    clearStatus: [
      {
        name: "Cleared",
        status: "1",
      },
      {
        name: "Pending",
        status: "0",
      },
    ],
    editedIndex: -1,
    editedItem: {
      academic: "",
      finance: "",
      library: "",
      hostel: "",
    },
    defaultItem: {
      academic: "",
      finance: "",
      library: "",
      hostel: "",
    },
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Item" : "Edit Item";
    },
  },

  watch: {
    dialog(val) {
      val || this.close();
    },

    students(newValue, oldValue) {
      if (oldValue !== newValue) {
        // this.dataChanged = true;
        this.getStudents();
      } else {
        // this.dataChanged = false;
        console.log("no changes");
      }
    },
  },

  created() {
    this.initialize();
  },

  methods: {
    getStudents() {
      this.axios
        .get("http://localhost:3000/api/admin/home/clearStudent")
        .then((response) => {
          this.students = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    setStatus(status) {
      if (status == "0") {
        return "pending";
      }
      if (status == "1") {
        return "cleared";
      }
    },

    initialize() {
      this.getStudents();
    },

    editItem(item) {
      this.editedIndex = this.students.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    save() {
      if (this.editedIndex > -1) {
        this.axios
          .put(
            "http://localhost:3000/api/admin/home/clearStudent/" +
              this.editedItem.id,
            {
              academic: this.editedItem.academic,
              finance: this.editedItem.finance,
              library: this.editedItem.library,
              hostel: this.editedItem.hostel,
            }
          )
          .then((response) => {
            console.log(response);
          });
        console.log("edited data");
        Object.assign(this.students[this.editedIndex], this.editedItem);
      } else {
        this.axios
          .post("http://localhost:3000/api/admin/home", {
            name: this.editedItem.name,
            email: this.editedItem.email,
            role: this.editedItem.role,
          })
          .then((response) => {
            console.log(response);
          });
        console.log("created data");
        this.students.push(this.editedItem);
      }
      this.close();
    },
  },
};
</script>
<style>
.data-table {
  background-color: #f7fafc;
}
</style>