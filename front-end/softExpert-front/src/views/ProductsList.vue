<script setup lang="ts">
import { ref, onMounted } from 'vue';
import axios from 'axios';

const products = ref([]);

onMounted(() => {
    fetchProducts();
});

function fetchProducts() {
    axios.get('http://localhost:8080/products')

        .then(response => {
            products.value = response.data;

        })
        .catch(error => {
            console.error(error);
        });
}


</script>
<template>
  <v-table>
    <thead>
      <tr>
        <th class="text-left">Name</th>
        <th class="text-left">Type</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="item in products" :key="item.id">
        <td>{{ item.name }}</td>
        <td>{{ item.typeName }}</td>
      </tr>
    </tbody>
  </v-table>
</template>

