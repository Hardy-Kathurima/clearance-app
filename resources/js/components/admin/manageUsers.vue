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
      :items="users"
      :search="search"
      :page.sync="page"
      :items-per-page="itemsPerPage"
      hide-default-footer
      class="elevation-1"
      @page-count="pageCount = $event"
    >
      <!-- User Roles-->
      <template v-slot:item.role="{ item }">
        <span>{{ `${setRole(item.role)}` }}</span>
      </template>
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>Manage users</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>
          <v-dialog v-model="dialog" max-width="600px">
            <template v-slot:activator="{ on, attrs }">
              <v-btn
                color="primary"
                dark
                class="mb-2 mr-14"
                v-bind="attrs"
                v-on="on"
              >
                Add new user
              </v-btn>
            </template>

            <v-card>
              <v-card-title>
                <span class="text-h5">{{ formTitle }}</span>
              </v-card-title>

              <v-card-text>
                <v-container>
                  <v-row>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.name"
                        label="Name"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.email"
                        label="email"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-select
                        item-text="name"
                        item-value="status"
                        v-model="editedItem.role"
                        :items="userRole"
                        label="Role"
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

          <v-dialog v-model="dialogDelete" max-width="500px">
            <v-card>
              <v-card-title class="text-h5"
                >Are you sure you want to delete this item?</v-card-title
              >
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="closeDelete"
                  >Cancel</v-btn
                >
                <v-btn color="blue darken-1" text @click="deleteItemConfirm"
                  >OK</v-btn
                >
                <v-spacer></v-spacer>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-toolbar>
      </template>
      <template v-slot:item.actions="{ item }">
        <v-icon small class="mr-2 blue--text" @click="editItem(item)">
          mdi-pencil
        </v-icon>
        <v-icon small class="red--text" @click="deleteItem(item)">
          mdi-delete
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
    dialogDelete: false,
    headers: [
      { text: "Name", value: "name" },
      { text: "Email", value: "email" },
      { text: "Role", value: "role" },

      { text: "Actions", value: "actions", sortable: false },
    ],
    users: [],
    editedIndex: -1,
    editedItem: {
      name: "",
      email: "",
      role: "",
    },
    defaultItem: {
      name: "",
      email: "",
      role: "",
    },
    userRole: [
      {
        name: "Admin",
        status: "1",
      },
      {
        name: "Normal user",
        status: "0",
      },
    ],
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
    dialogDelete(val) {
      val || this.closeDelete();
    },
    users(newValue, oldValue) {
      if (oldValue !== newValue) {
        // this.dataChanged = true;
        this.getUsers();
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
    getUsers() {
      this.axios
        .get("http://localhost:3000/api/admin/home")
        .then((response) => {
          this.users = response.data.users;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    setRole(role) {
      if (role == "0") {
        return "Normal user";
      }
      if (role == "1") {
        return "Admin";
      }
    },
    initialize() {
      this.getUsers();
    },

    editItem(item) {
      this.editedIndex = this.users.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      this.editedIndex = this.users.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
      this.axios
        .delete("http://localhost:3000/api/admin/home/" + this.editedItem.id)
        .then((response) => {
          console.log(response);
        });
    },

    deleteItemConfirm() {
      this.users.splice(this.editedIndex, 1);
      this.closeDelete();
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    save() {
      if (this.editedIndex > -1) {
        this.axios
          .put("http://localhost:3000/api/admin/home/" + this.editedItem.id, {
            name: this.editedItem.name,
            email: this.editedItem.email,
            role: this.editedItem.role,
          })
          .then((response) => {
            console.log(response);
          });
        console.log("edited data");
        Object.assign(this.users[this.editedIndex], this.editedItem);
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
        this.users.push(this.editedItem);
      }
      this.close();
    },
  },
};
</script>