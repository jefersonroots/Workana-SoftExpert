<template>
  <v-container>
    <v-card class="mb-4">
      <v-card-title>Shopping Cart</v-card-title>
      <v-card-text>
        <v-list>
          <v-list-item v-for="item in cartItems" :key="item.id">
            <v-list-item-content>
              <v-list-item-title>{{ item.name }}</v-list-item-title>
              <v-label>price:</v-label>
              <v-list-item-subtitle>{{ item.price }}</v-list-item-subtitle>
              <v-label>quantity:</v-label>
              <v-list-item-subtitle>{{ item.quantity }}</v-list-item-subtitle>

            </v-list-item-content>
          </v-list-item>
          <v-divider></v-divider>
          <v-list-item>
            <v-list-item-content>
              <v-list-item-title>Total Items Value:</v-list-item-title>
              <v-list-item-subtitle>{{ getTotalItems() }}</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
          <v-list-item>
            <v-list-item-content>
              <v-list-item-title>Total Purchase Value:</v-list-item-title>
              <v-list-item-subtitle>{{ getTotalPrice() }}</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
          <v-list-item>
            <v-list-item-content>
              <v-list-item-title>Total Tax Value:</v-list-item-title>
              <v-list-item-subtitle>{{ getTotalTax() }}</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-card-text>
      <v-card-actions>
        <v-btn color="primary" @click="saveBuy()">Complete Purchase</v-btn>
      </v-card-actions>
    </v-card>

    <v-row>
      <v-col v-for="product in products" :key="product.id" cols="12" sm="6" md="4" lg="3">
        <v-card class="mb-4">
          
          <v-card-title>{{ product.name }}</v-card-title>
          <v-card-text>
            <p>{{ product.typeName }}</p>
            <p>{{ product.price }}</p>
          </v-card-text>
          <v-card-actions>
            <v-btn color="primary" @click="addToCart(product)">Add to Cart</v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import axios from 'axios';


const products = ref([])

const cartItems = ref([]);

const addToCart = (product) => {
  const existingItem = cartItems.value.find((item) => item.id === product.id);
  if (existingItem) {
    existingItem.quantity++;
  } else {
    cartItems.value.push({ ...product, quantity: 1 });
  }
};

onMounted(() => {
  fetchProdutos();
});

function fetchProdutos() {
  axios.get('http://localhost:8080/products')
    .then(response => {
      products.value = response.data;
    })
    .catch(error => {
      console.error(error);
    });
}
function saveBuy() {
  // Retrieve form data or any other necessary data
  const payload = {
    cartItems: cartItems.value, // Pass the cartItems to the payload
  }
  console.log(payload)
  axios.post('http://localhost:8080/saveBuy', payload)
    .then(resp => {
      console.log(resp)
      alert('Success');
      cartItems.value = []; // Clear the cart items after successful purchase

    })
    .catch(error => {
      console.log(error)
    })
}

const getTotalItems = () => {
  let totalItems = 0;
  for (const item of cartItems.value) {
    totalItems += item.quantity;
  }
  return totalItems;
};

const getTotalPrice = () => {
  let totalPrice = 0;
  for (const item of cartItems.value) {
    totalPrice += item.price * item.quantity;
  }
  return totalPrice;
};

const getTotalTax = () => {
  let totalTax = 0;
  for (const item of cartItems.value) {
    totalTax += item.tax * item.quantity;
  }
  return totalTax;
};
//   const checkout = () => {
//     store.dispatch('checkout', cartItems.value);
//   };
</script>
