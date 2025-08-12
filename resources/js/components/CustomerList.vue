<template>
    <div class="container mx-auto px-4 py-8">
      <!-- Header Section -->
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Customer Management</h1>
        <button 
          @click="showCreateModal = true"
          class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-all duration-200 flex items-center"
          :disabled="loading"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
          </svg>
          Add New Customer
        </button>
      </div>

  
        <!-- Success Toast Notification -->
        <transition
        enter-active-class="transform ease-out duration-300 transition"
        enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
        enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
        leave-active-class="transition ease-in duration-100"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
        >
        <div v-if="successMessage" class="fixed inset-0 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end z-50">
            <div class="max-w-sm w-full bg-green-50 shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden">
            <div class="p-4">
                <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-3 w-0 flex-1 pt-0.5">
                    <p class="text-sm font-medium text-green-800">
                    {{ successMessage }}
                    </p>
                </div>
                <div class="ml-4 flex-shrink-0 flex">
                    <button @click="successMessage = ''" class="bg-green-50 rounded-md inline-flex text-green-400 hover:text-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <span class="sr-only">Close</span>
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                    </button>
                </div>
                </div>
            </div>
            </div>
        </div>
        </transition>

        <!-- Error Toast Notification -->
        <transition
        enter-active-class="transform ease-out duration-300 transition"
        enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
        enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
        leave-active-class="transition ease-in duration-100"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
        >
        <div v-if="errorMessage" class="fixed inset-0 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end z-50">
            <div class="max-w-sm w-full bg-red-50 shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden">
            <div class="p-4">
                <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-red-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-3 w-0 flex-1 pt-0.5">
                    <p class="text-sm font-medium text-red-800">
                    {{ errorMessage }}
                    </p>
                </div>
                <div class="ml-4 flex-shrink-0 flex">
                    <button @click="errorMessage = ''" class="bg-red-50 rounded-md inline-flex text-red-400 hover:text-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <span class="sr-only">Close</span>
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                    </button>
                </div>
                </div>
            </div>
            </div>
        </div>
        </transition>
  
      <!-- Search Bar -->
      <div class="mb-6 relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
          <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
          </svg>
        </div>
        <input
          v-model="searchQuery"
          type="text"
          placeholder="Search customer info or quotations..."
          class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
          :disabled="loading"
        />
      </div>
  
      <!-- Customers Table -->
      <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date of Birth</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Address</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quotations</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="customer in filteredCustomers" :key="customer.id" class="hover:bg-gray-50 transition-colors duration-150">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                      <span class="text-blue-600 font-medium">{{ customer.name.charAt(0).toUpperCase() }}</span>
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">{{ customer.name }}</div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">{{ formatDate(customer.dob) }}</div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-gray-900 max-w-xs truncate">
                        {{ customer.address ? customer.address : 'N/A' }}
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">{{ customer.email }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">{{ customer.contact_info }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                    {{ customer.quotations ? customer.quotations.length : 0 }} quotations
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <button
                    @click="editCustomer(customer)"
                    class="text-indigo-600 hover:text-indigo-900 mr-4 transition-colors duration-200"
                    title="Edit"
                    :disabled="loading"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                      <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                  </button>
                  <button
                    @click="viewQuotations(customer)"
                    class="text-green-600 hover:text-green-900 mr-4 transition-colors duration-200"
                    title="View Quotations"
                    :disabled="loading"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                      <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                      <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                    </svg>
                  </button>
                  <button
                    @click="confirmDelete(customer)"
                    class="text-red-600 hover:text-red-900 transition-colors duration-200"
                    title="Delete"
                    :disabled="loading"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                  </button>
                </td>
              </tr>
              <tr v-if="filteredCustomers.length === 0 && !loading">
                <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                  No customers found
                </td>
              </tr>
              <tr v-if="loading && customers.length === 0">
                <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                  <div class="flex justify-center items-center">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                      <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Loading customers...
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
  
      <!-- Create/Edit Customer Modal -->
      <div v-if="(showCreateModal || showEditModal) && !loading" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full max-h-[90vh] overflow-y-auto">
          <div class="p-6">
            <div class="flex justify-between items-center mb-4">
              <h2 class="text-xl font-semibold text-gray-800">
                {{ showEditModal ? 'Edit Customer' : 'Add New Customer' }}
              </h2>
              <button @click="closeModal" class="text-gray-400 hover:text-gray-500" :disabled="loading">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </div>
            
            <form @submit.prevent="showEditModal ? updateCustomer() : createCustomer()">
              <div class="space-y-4">
                <div>
                  <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                  <input
                    v-model="form.name"
                    id="name"
                    type="text"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    :class="{ 'border-red-300': errors.name }"
                    :disabled="loading"
                  />
                  <p v-if="errors.name" class="mt-2 text-sm text-red-600">{{ errors.name[0] }}</p>
                </div>
                
                <div>
                  <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                  <input
                    v-model="form.dob"
                    id="dob"
                    type="date"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    :class="{ 'border-red-300': errors.dob }"
                    :disabled="loading"
                  />
                  <p v-if="errors.dob" class="mt-2 text-sm text-red-600">{{ errors.dob[0] }}</p>
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input
                        v-model="form.email"
                        id="email"
                        type="email"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        :class="{ 'border-red-300': errors.email }"
                        @blur="checkEmailUniqueness"
                        :disabled="loading"
                    />
                    <p v-if="errors.email" class="mt-2 text-sm text-red-600">
                        {{ errors.email[0] === 'The email has already been taken.' 
                        ? 'This email address is already registered.' 
                        : errors.email[0] }}
                    </p>
                </div>
                
                <div>
                  <label for="contact_info" class="block text-sm font-medium text-gray-700">Phone Number</label>
                  <input
                    v-model="form.contact_info"
                    id="contact_info"
                    type="tel"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    :class="{ 'border-red-300': errors.contact_info }"
                    :disabled="loading"
                  />
                  <p v-if="errors.contact_info" class="mt-2 text-sm text-red-600">{{ errors.contact_info[0] }}</p>
                </div>
                
                <div>
                  <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                  <textarea
                    v-model="form.address"
                    id="address"
                    rows="3"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    :class="{ 'border-red-300': errors.address }"
                    :disabled="loading"
                    placeholder="Optional"
                  ></textarea>
                  <p v-if="errors.address" class="mt-2 text-sm text-red-600">{{ errors.address[0] }}</p>
                </div>
              </div>
              
              <div class="mt-6 flex justify-end space-x-3">
                <button
                  type="button"
                  @click="closeModal"
                  class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                  :disabled="loading"
                >
                  Cancel
                </button>
                <button
                  type="submit"
                  class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                  :disabled="loading"
                >
                  <svg v-if="loading" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                  </svg>
                  {{ showEditModal ? (loading ? 'Updating...' : 'Update Customer') : (loading ? 'Creating...' : 'Create Customer') }}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
  
      <!-- Delete Confirmation Modal -->
      <div v-if="showDeleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
          <div class="p-6">
            <div class="flex items-start">
              <div class="flex-shrink-0 h-10 w-10 rounded-full bg-red-100 flex items-center justify-center">
                <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
              </div>
              <div class="ml-4">
                <h3 class="text-lg font-medium text-gray-900">Delete customer</h3>
                <div class="mt-2">
                  <p class="text-sm text-gray-500">
                    Are you sure you want to delete <span class="font-semibold">{{ selectedCustomer?.name }}</span>? 
                    This action cannot be undone and will also delete all associated quotations.
                  </p>
                </div>
              </div>
            </div>
            <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
              <button
                type="button"
                @click="deleteCustomer"
                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:col-start-2 sm:text-sm"
                :disabled="loading"
              >
                <svg v-if="loading" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                {{ loading ? 'Deleting...' : 'Delete' }}
              </button>
              <button
                type="button"
                @click="showDeleteModal = false"
                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:col-start-1 sm:text-sm"
                :disabled="loading"
              >
                Cancel
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      customers: [],
      searchQuery: '',
      showCreateModal: false,
      showEditModal: false,
      showDeleteModal: false,
      form: {
        name: '',
        dob: '',
        email: '',
        contact_info: '',
        address: ''
      },
      selectedCustomer: null,
      successMessage: '',
      errorMessage: '',
      errors: {},
      loading: false
    }
  },
  computed: {
    filteredCustomers() {
      const query = this.searchQuery.toLowerCase();
      return this.customers.filter(customer => {
        const matchesBasic =
          (customer.name && customer.name.toLowerCase().includes(query)) ||
          (customer.email && customer.email.toLowerCase().includes(query)) ||
          (customer.contact_info && customer.contact_info.toLowerCase().includes(query)) ||
          (customer.dob && customer.dob.toLowerCase().includes(query)) ||
          (customer.address && customer.address.toLowerCase().includes(query));

        const matchesQuotationCode = customer.quotations?.some(quotation =>
          quotation.quotation_code.toLowerCase().includes(query)
        );

        return matchesBasic || matchesQuotationCode;
      });
    }
  },
  created() {
    this.fetchCustomers();
  },
  methods: {
    formatDate(dateString) {
      if (!dateString) return '';
      const date = new Date(dateString);
      return date.toLocaleDateString('en-US', { 
        year: 'numeric', 
        month: 'short', 
        day: 'numeric' 
      });
    },
    
    async fetchCustomers() {
      this.loading = true;
      try {
        const response = await axios.get('/api/customers');
        this.customers = response.data;
      } catch (error) {
        console.error('Error fetching customers:', error);
        this.errorMessage = 'Failed to load customers. Please try again.';
        setTimeout(() => this.errorMessage = '', 5000);
      } finally {
        this.loading = false;
      }
    },

    async createCustomer() {
        this.errors = {};
        this.loading = true;
        try {
            const response = await axios.post('/api/customers', this.form);
            this.customers.push(response.data);
            this.successMessage = 'Customer created successfully!';
            setTimeout(() => this.successMessage = '', 3000);
            this.closeModal(); // Close AFTER success
        } catch (error) {
            if (error.response && error.response.status === 422) {
            this.errors = error.response.data.errors || {};
            // Keep modal open so the user can fix the errors
            } else {
            console.error('Error creating customer:', error);
            this.errorMessage = 'Failed to create customer. Please try again.';
            setTimeout(() => this.errorMessage = '', 5000);
            }
        } finally {
            this.loading = false;
        }
    },

        async updateCustomer() {
        this.errors = {};
        this.loading = true;
        try {
            const response = await axios.put(
            `/api/customers/${this.selectedCustomer.id}`,
            this.form
            );
            const index = this.customers.findIndex(c => c.id === this.selectedCustomer.id);
            if (index !== -1) {
            this.customers.splice(index, 1, response.data);
            }
            this.successMessage = 'Customer updated successfully!';
            setTimeout(() => this.successMessage = '', 3000);
            this.closeModal(); // Close AFTER success
        } catch (error) {
            if (error.response && error.response.status === 422) {
            this.errors = error.response.data.errors || {};
            // Keep modal open for corrections
            } else {
            console.error('Error updating customer:', error);
            this.errorMessage = 'Failed to update customer. Please try again.';
            setTimeout(() => this.errorMessage = '', 5000);
            }
        } finally {
            this.loading = false;
        }
    },

    async deleteCustomer() {
      this.loading = true;
      try {
        await axios.delete(`/api/customers/${this.selectedCustomer.id}`);
        this.customers = this.customers.filter(c => c.id !== this.selectedCustomer.id);
        this.successMessage = 'Customer deleted successfully!';
        setTimeout(() => this.successMessage = '', 3000);
        this.showDeleteModal = false;
      } catch (error) {
        console.error('Error deleting customer:', error);
        this.errorMessage = 'Failed to delete customer. Please try again.';
        setTimeout(() => this.errorMessage = '', 5000);
      } finally {
        this.loading = false;
      }
    },

    viewQuotations(customer) {
      this.$router.push({ name: 'customer-quotations', params: { customerId: customer.id } });
    },

    editCustomer(customer) {
      this.selectedCustomer = { ...customer };
      this.form = {
        name: customer.name,
        dob: customer.dob,
        email: customer.email,
        contact_info: customer.contact_info,
        address: customer.address
      };
      this.showEditModal = true;
    },

    confirmDelete(customer) {
      this.selectedCustomer = { ...customer };
      this.showDeleteModal = true;
    },

    closeModal() {
      this.showCreateModal = false;
      this.showEditModal = false;
      this.form = {
        name: '',
        dob: '',
        email: '',
        contact_info: '',
        address: ''
      };
      this.selectedCustomer = null;
      this.errors = {};
    },
  }
}
</script>