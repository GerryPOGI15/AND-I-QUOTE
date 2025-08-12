<template>
    <div class="p-6">
      <h2 class="text-xl font-bold mb-4">Add Quotation</h2>
      <select v-model="quotation.customer_id" class="border p-2 w-full mb-2">
        <option value="">-- Select Customer --</option>
        <option v-for="c in customers" :key="c.id" :value="c.id">{{ c.name }}</option>
      </select>
      <input type="date" v-model="quotation.quotation_date" class="border p-2 w-full mb-2" />
  
      <div class="mb-4">
        <h3 class="font-bold mb-2">Items</h3>
        <div v-for="(item, index) in quotation.items" :key="index" class="flex space-x-2 mb-2">
          <input v-model="item.product_name" placeholder="Product Name" class="border p-2 flex-1" />
          <input v-model="item.description" placeholder="Description" class="border p-2 flex-1" />
          <input type="number" v-model="item.quantity" placeholder="Qty" class="border p-2 w-20" />
          <input type="number" step="0.01" v-model="item.unit_cost" placeholder="Unit Cost" class="border p-2 w-24" />
          <button @click="removeItem(index)" class="bg-red-500 text-white px-2">X</button>
        </div>
        <button @click="addItem" class="bg-green-500 text-white px-3 py-1 rounded">+ Item</button>
      </div>
  
      <button @click="saveQuotation" class="bg-blue-500 text-white px-4 py-2 rounded">Save Quotation</button>
    </div>
  </template>
  
  <script>
  import axios from "axios";
  
  export default {
    data() {
      return {
        customers: [],
        quotation: {
          customer_id: "",
          quotation_date: "",
          items: []
        }
      }
    },
    methods: {
      fetchCustomers() {
        axios.get("/api/customers").then(res => this.customers = res.data);
      },
      addItem() {
        this.quotation.items.push({ product_name: "", description: "", quantity: 1, unit_cost: 0 });
      },
      removeItem(index) {
        this.quotation.items.splice(index, 1);
      },
      saveQuotation() {
        axios.post("/api/quotations", this.quotation).then(() => {
          alert("Quotation saved!");
          this.quotation = { customer_id: "", quotation_date: "", items: [] };
        });
      }
    },
    mounted() {
      this.fetchCustomers();
    }
  }
  </script>
  