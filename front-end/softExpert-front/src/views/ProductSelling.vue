<template>
    <v-container>
      <v-card class="mb-4">
        <v-card-title>Carrinho de Compras</v-card-title>
        <v-card-text>
          <v-list>
            <v-list-item v-for="item in cartItems" :key="item.id">
              <v-list-item-content>
                <v-list-item-title>{{ item.name }}</v-list-item-title>
                <v-list-item-subtitle>{{ item.price }}</v-list-item-subtitle>
                <v-list-item-subtitle>{{ item.quantity }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
            <v-divider></v-divider>
            <v-list-item>
              <v-list-item-content>
                <v-list-item-title>Valor Total de Itens:</v-list-item-title>
                <v-list-item-subtitle>{{ getTotalItems() }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
            <v-list-item>
              <v-list-item-content>
                <v-list-item-title>Valor Total da Compra:</v-list-item-title>
                <v-list-item-subtitle>{{ getTotalPrice() }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
          </v-list>
        </v-card-text>
        <v-card-actions>
          <v-btn color="primary" @click="checkout">Concluir Compra</v-btn>
        </v-card-actions>
      </v-card>
  
      <v-row>
        <v-col v-for="product in products" :key="product.id" cols="12" sm="6" md="4" lg="3">
          <v-card class="mb-4">
            <v-card-title>{{ product.name }}</v-card-title>
            <v-card-text>
              <p>{{ product.description }}</p>
              <p>{{ product.price }}</p>
            </v-card-text>
            <v-card-actions>
              <v-btn color="primary" @click="addToCart(product)">Adicionar ao Carrinho</v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </template>
  
  <script setup lang="ts">
  import { ref } from 'vue';
 
//   const store = useStore();
  
  const products = ref([
    { id: 1, name: 'Produto 1', description: 'Descrição do Produto 1', price: 10 },
    { id: 2, name: 'Produto 2', description: 'Descrição do Produto 2', price: 15 },
    { id: 3, name: 'Produto 3', description: 'Descrição do Produto 3', price: 20 },
  ]);
  
  const cartItems = ref([]);
  
  const addToCart = (product) => {
    const existingItem = cartItems.value.find((item) => item.id === product.id);
    if (existingItem) {
      existingItem.quantity++;
    } else {
      cartItems.value.push({ ...product, quantity: 1 });
    }
  };
  
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
  
//   const checkout = () => {
//     store.dispatch('checkout', cartItems.value);
//   };
  </script>
  