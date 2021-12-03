<template>
  <div class="userMessages">
    <v-container>
      <h2 class="display-2">User messages</h2>

      <v-expansion-panels>
        <v-expansion-panel class="mb-3">
          <v-expansion-panel-header
            >message from hardy</v-expansion-panel-header
          >
          <v-expansion-panel-content> hello </v-expansion-panel-content>
        </v-expansion-panel>
        <v-expansion-panel>
          <v-expansion-panel-header>message from Mary</v-expansion-panel-header>
          <v-expansion-panel-content>
            <v-card>
              <v-card-text>
                <p>This is the message</p>
                <span class="font-weight-bold">Sent on 2nd Decemcber 2021</span>
              </v-card-text>
            </v-card>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-expansion-panels>
    </v-container>
  </div>
</template>
<script>
export default {};
</script>