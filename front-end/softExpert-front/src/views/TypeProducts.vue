<script setup lang="ts">
import { ref, onMounted } from 'vue'
import axios from 'axios'

const name = ref('')
const tax = ref('')
const items = ref([])

function createTypeProduct() {
  const payload = {
    name: name.value,
    tax: tax.value,
  }
  
  axios.post('http://localhost:8080/createTypeProducts', payload)
    .then(resp => {
      console.log(resp)

      name.value = ''
      tax.value = ''
      alert('Success');
      fetchTypeProducts()
    })
    .catch(error => {
      console.log(error)
    })
}

function fetchTypeProducts() {
  axios.get('http://localhost:8080/Types')
    .then(resp => {

      items.value = resp.data
    })
    .catch(error => {
      console.log(error)
    })
}

onMounted(() => {
    fetchTypeProducts()
})
</script>

<template>
  <v-card class="mx-auto ma-3 pa-3" max-width="600" title="New Type">
    <v-form @submit.prevent="createTypeProduct">
      <v-text-field v-model="name" :counter="10" class="ma-1 pa-1" label="Name"></v-text-field>
      <v-text-field v-model="tax" :counter="7" class="ma-1 pa-1" label="Value of Tax" type="number"></v-text-field>
      <v-btn class="me-4" type="submit">submit</v-btn>
    </v-form>
  </v-card>
  <v-card class="mx-auto ma-3 pa-3" max-width="600" title="Types List">
    <v-list>
      <v-list-item v-for="item in items" :key="item">
        <v-divider class="pt-3"></v-divider>
        <v-list-item-content>{{ item.name }} - tax: {{ item.tax }}</v-list-item-content>
      </v-list-item>
    </v-list>
  </v-card>
</template>
