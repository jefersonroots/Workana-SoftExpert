
<script setup lang="ts">
import { ref,  onMounted} from 'vue'
import axios from 'axios'

const name = ref('')
const price = ref('')
const type = ref('')


const items = ref([
  'Type 1',
  'Type 2',
  'Type 3',
  'Type 4',
])

onMounted(() => {
  fetchTypeProducts();
});

function fetchTypeProducts() {
    axios.get('http://localhost:8080/Types')

        .then(response => {
          items.value = response.data;

        })
        .catch(error => {
            console.error(error);
        });
}
function createProduct(data : any) {
   
  let payload = {
        name: name.value,
        price: price.value,
        typeID:type.value
         
    }
    axios.post('http://localhost:8080/createProducts',  {name : name.value,  price : price.value, typeID: type.value})
  .then(resp => {  
      console.log(resp)
  })
  .catch(error => {          
      console.log(error)       
  })
    console.log(payload)

}
// const handleReset = () => {
//   resetForm()
// }
</script>

<template>  
      <v-card  class="mx-auto ma-3 pa-3"
    max-width="600 "  title="New Product">
    <v-form  @submit.prevent="createProduct" >

        <v-text-field
        v-model="name"
        :counter="6"
            class="ma-1 pa-1"
        label="Name Product"
      ></v-text-field>
      <v-select
        v-model="type"
        :items="items"
        item-title="name"
        item-value="id"
        class="ma-1 pa-1"
        label="Type Product"
      ></v-select>
  
      <v-text-field
        v-model="price"
        :counter="1"      
        class="ma-1 pa-1" 
        label="Price"
        type="number"
      ></v-text-field>

      <v-btn
        class="me-4"
        type="submit"
      >
        submit
      </v-btn>
  
      <!-- <v-btn @click="handleReset">
        clear
      </v-btn> -->
    </v-form>
</v-card>
  </template>
  