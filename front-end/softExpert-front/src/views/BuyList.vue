<script setup lang="ts">
import { ref, onMounted } from 'vue';
import axios from 'axios';

const sell = ref([]);

onMounted(() => {
    fetchSell();
});

function fetchSell() {
    axios.get('http://localhost:8080/sellingList')

        .then(response => {
            sell.value = response.data;

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
          <th class="text-left">
            Product
          </th>
          <th class="text-left">
            Quantity
          </th>
          <th class="text-left">
            Total Price
          </th>
          <th class="text-left">
            Total Tax
          </th>          
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="item in sell"
          :key="item.id">
          <td>{{ item.ProductName }}</td>
          <td>{{ item.quantity }}</td>
          <td>{{ item.itemTotalValue }}</td>
          <td>{{ item.itemTaxValue }}</td>
        </tr>
      </tbody>
    </v-table>
  </template>
