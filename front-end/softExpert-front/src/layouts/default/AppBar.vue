<template>
  <v-app-bar  class="">
    <v-app-bar-title>
      Market - Controller of Products
    </v-app-bar-title>
    <template v-slot:image>
          <v-img
            gradient="to top right, rgba(19,84,122,.8), rgba(128,208,199,.8)"
          ></v-img>
        </template>    

        <v-spacer></v-spacer>
        <v-btn class="text-white" href="http://localhost:3000/products/create" variant="text">Add Product</v-btn>
        <v-btn class="text-white" href="http://localhost:3000/products/list" variant="text">List Product</v-btn>
        <v-btn class="text-white" href="http://localhost:3000/type/create" variant="text">Add Type Product</v-btn>
        <v-btn class="text-white"  href="http://localhost:3000/products/buy" variant="text">Screen of Selling</v-btn>
        <v-btn class="text-white" href="http://localhost:3000/buy/list" variant="text">List of Selling</v-btn>
        
        <v-btn icon>
          <v-icon>mdi-dots-vertical</v-icon>
        </v-btn>
        
  
  </v-app-bar>
</template>

<script lang="ts" setup>
  //
</script>
