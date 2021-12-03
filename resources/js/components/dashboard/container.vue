<template >
  <v-container class="my-5">
    <div v-if="hasApplied == '0' && !stations.academic" class="my-5">
      <div v-cloak class="v-cloak--hidden">
        <Popup v-on:studentApplied="getList()" />
      </div>
    </div>
    <div>
      <div
        v-if="stations.academic == '0' || stations.academic == '1'"
        class="sections"
      >
        <!-- academic -->
        <v-card flat class="pa-5">
          <v-layout
            row
            wrap
            pl-3
            :class="`station ${setStatus(stations.academic)}`"
          >
            <v-flex xs12 md6>
              <div class="caption grey--text">Station</div>
              <div>Academic</div>
            </v-flex>
            <v-flex xs12 md2>
              <div class="caption grey--text">Application Date</div>
              <div>{{ stations.created_at | formatDate }}</div>
            </v-flex>
            <v-flex xs12 md2>
              <div class="caption grey--text">Updated</div>
              <div>{{ stations.updated_at | formatDate }}</div>
            </v-flex>
            <v-flex xs12 md2>
              <div class="right" id="chips-container">
                <div v-cloak>
                  <v-chip
                    small
                    v-if="stations.academic == '0'"
                    :class="`${setStatus(
                      stations.academic
                    )} white--text caption my-2`"
                    >Pending</v-chip
                  >
                  <v-chip
                    small
                    v-else
                    :class="`${setStatus(
                      stations.academic
                    )} white--text caption my-2`"
                    >Cleared</v-chip
                  >
                </div>
              </div>
            </v-flex>
          </v-layout>
          <v-divider></v-divider>
        </v-card>

        <!-- library -->
        <v-card flat class="pa-5">
          <v-layout
            row
            wrap
            pl-3
            :class="`station ${setStatus(stations.library)}`"
          >
            <v-flex xs12 md6>
              <div class="caption grey--text">Station</div>
              <div>Library</div>
            </v-flex>
            <v-flex xs12 md2>
              <div class="caption grey--text">Application Date</div>
              <div>{{ stations.created_at | formatDate }}</div>
            </v-flex>
            <v-flex xs12 md2>
              <div class="caption grey--text">Updated</div>
              <div>{{ stations.updated_at | formatDate }}</div>
            </v-flex>
            <v-flex xs12 md2>
              <div class="right" id="chips-container">
                <div v-cloak>
                  <v-chip
                    small
                    v-if="stations.academic == '0'"
                    :class="`${setStatus(
                      stations.library
                    )} white--text caption my-2`"
                    >Pending</v-chip
                  >
                  <v-chip
                    small
                    v-else
                    :class="`${setStatus(
                      stations.library
                    )} white--text caption my-2`"
                    >Cleared</v-chip
                  >
                </div>
              </div>
            </v-flex>
          </v-layout>
          <v-divider></v-divider>
        </v-card>
        <!-- finance -->
        <v-card flat class="pa-5">
          <v-layout
            row
            wrap
            pl-3
            :class="`station ${setStatus(stations.finance)}`"
          >
            <v-flex xs12 md6>
              <div class="caption grey--text">Station</div>
              <div>Finance</div>
            </v-flex>
            <v-flex xs12 md2>
              <div class="caption grey--text">Application Date</div>
              <div>{{ stations.created_at | formatDate }}</div>
            </v-flex>
            <v-flex xs12 md2>
              <div class="caption grey--text">Updated</div>
              <div>{{ stations.updated_at | formatDate }}</div>
            </v-flex>
            <v-flex xs12 md2>
              <div class="right" id="chips-container">
                <v-chip
                  small
                  v-if="stations.finance == '0'"
                  :class="`${setStatus(
                    stations.finance
                  )} white--text caption my-2`"
                  >Pending</v-chip
                >
                <v-chip
                  small
                  v-else
                  :class="`${setStatus(
                    stations.finance
                  )} white--text caption my-2`"
                  >Cleared</v-chip
                >
              </div>
            </v-flex>
          </v-layout>
          <v-divider></v-divider>
        </v-card>
        <!-- hostel -->
        <v-card flat class="pa-5">
          <v-layout
            row
            wrap
            pl-3
            :class="`station ${setStatus(stations.hostel)}`"
          >
            <v-flex xs12 md6>
              <div class="caption grey--text">Station</div>
              <div>Hostel</div>
            </v-flex>
            <v-flex xs12 md2>
              <div class="caption grey--text">Application Date</div>
              <div>{{ stations.created_at | formatDate }}</div>
            </v-flex>
            <v-flex xs12 md2>
              <div class="caption grey--text">Updated</div>
              <div>{{ stations.updated_at | formatDate }}</div>
            </v-flex>
            <v-flex xs12 md2>
              <div class="right" id="chips-container">
                <v-chip
                  small
                  v-if="stations.hostel == '0'"
                  :class="`${setStatus(
                    stations.hostel
                  )} white--text caption my-2`"
                  >Pending</v-chip
                >
                <v-chip
                  small
                  v-else
                  :class="`${setStatus(
                    stations.hostel
                  )}white--text caption my-2`"
                  >Cleared</v-chip
                >
              </div>
            </v-flex>
          </v-layout>
        </v-card>
        <v-btn href="home/download" color="success" class="mt-5">
          <v-icon left small>file_download</v-icon>
          <span>Download form</span>
        </v-btn>
      </div>
    </div>
  </v-container>
</template>
 
<script>
import Popup from "./Popup";
export default {
  components: { Popup },
  data() {
    return {
      student: [],
      userStudent: [],
      stations: [],
      username: this.$username,
      hasApplied: this.$hasApplied,
    };
  },
  async mounted() {
    await this.axios.get("http://localhost:3000/api/home").then((response) => {
      this.stations = response.data.stations;
      this.userStudent = response.data.userStudent;
      this.student = response.data.student;
    });
  },
  methods: {
    getList() {
      this.hasApplied = "1";
      this.axios.get("http://localhost:3000/api/home").then((response) => {
        this.stations = response.data.stations;
        this.userStudent = response.data.userStudent;
        this.student = response.data.student;
        this.$emit("added");
      });
    },
    setStatus(status) {
      if (status == "0") {
        return "not-cleared";
      }
      if (status == "1") {
        return "cleared";
      }
    },
  },
};
</script>
<style  scoped>
.station.not-cleared {
  border-left: 3px solid tomato;
}
.station.cleared {
  border-left: 3px solid #3cd1c2;
}
#chips-container .v-chip.not-cleared {
  background: tomato;
}
#chips-container .v-chip.cleared {
  background: #3cd1c2;
}
[v-cloak].v-cloak--hidden {
  display: none !important;
}
</style>