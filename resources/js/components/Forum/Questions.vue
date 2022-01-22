<template>
  <v-card
    class="mx-auto mb-2"
    max-width="550"
  >
    <v-card-title>
        <router-link :to="question.path">
        {{ question.title }}
        </router-link>
    </v-card-title>
    <v-card-subtitle class="pb-1">
      {{ question.created_at }}
    </v-card-subtitle>

    <v-card-text class="text--primary">
      <div>{{ question.user_name }}</div>
    <hr>
      <div>{{ question.body }}</div>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
    props:['question'],
    
}
</script>