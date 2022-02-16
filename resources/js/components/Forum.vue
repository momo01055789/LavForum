<template>
  <v-container>
    <v-row no-gutters>
      
      <v-col
        cols="12"
        md="4"
        sm="6"
        class="mb-3"
      >
          <app-sidebar></app-sidebar>
      </v-col>
      <v-col
        cols="12"
        sm="6"
        md="8"
      >
        <questions
        v-for="question in questions"
        :key="question.title"
        :question=question
        >
        </questions>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import AppSidebar from './Forum/AppSidebar'
import Questions from './Forum/Questions'
export default {
   components:{Questions,AppSidebar} ,
   data(){
        return{
        questions:{}
      }
    },
    created(){
        axios.get('/api/question')
        .then(res => {
            this.questions = res.data.data
        })
        .catch(err => console.log(err))
    },
}
</script>
<style>
.container{height:100vh;}
</style>