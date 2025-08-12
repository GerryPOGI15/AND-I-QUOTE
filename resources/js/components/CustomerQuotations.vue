<template>
  <div class="container mx-auto px-4 py-8">


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

    <!-- Email Success Toast Notification -->
    <transition
      enter-active-class="transform ease-out duration-300 transition"
      enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2 scale-95"
      enter-to-class="translate-y-0 opacity-100 sm:translate-x-0 scale-100"
      leave-active-class="transition ease-in duration-200"
      leave-from-class="opacity-100 scale-100"
      leave-to-class="opacity-0 scale-95"
    >
      <div v-if="emailSuccess" class="fixed inset-0 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end z-50">
        <div class="max-w-sm w-full bg-green-50 shadow-lg rounded-lg pointer-events-auto ring-1 ring-green-100 overflow-hidden">
          <div class="p-4">
            <div class="flex items-start">
              <div class="flex-shrink-0">
                <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
              </div>
              <div class="ml-3 w-0 flex-1 pt-0.5">
                <p class="text-sm font-medium text-green-800">
                  {{ emailSuccess }}
                </p>
              </div>
              <div class="ml-4 flex-shrink-0 flex">
                <button 
                  @click="emailSuccess = ''" 
                  class="inline-flex rounded-md bg-green-50 text-green-400 hover:text-green-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                >
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

    <!-- Email Error Notification -->
    <transition
      enter-active-class="transform ease-out duration-300 transition"
      enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
      enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
      leave-active-class="transition ease-in duration-100"
      leave-from-class="opacity-100"
      leave-to-class="opacity-0"
    >
      <div v-if="emailError" class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg shadow-sm">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
            </svg>
          </div>
          <div class="ml-3">
            <p class="text-sm font-medium text-red-800">
              {{ emailError }}
            </p>
          </div>
          <div class="ml-auto pl-3">
            <button @click="emailError = ''" class="text-red-500 hover:text-red-600">
              <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </transition>

    <!-- Main Content -->
    <div>
      <div class="flex justify-between items-center mb-6">
        <div>
          <h1 class="text-2xl font-bold">{{ customer.name }}'s Quotations</h1>
          <p class="text-gray-600">{{ customer.email }} | {{ customer.contact_info }}</p>
        </div>

        <button 
          @click="$router.push({ name: 'customers' })"
          class="mb-4 flex items-center text-blue-500 hover:text-blue-700"
          :disabled="loading"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
          </svg>
          Back to Customer List
        </button>
        
        <button 
          @click="showCreateModal = true"
          class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
          :disabled="loading"
        >
          Add New Quotation
        </button>
      </div>

      <div class="mb-4">
        <input
          v-model="searchQuery"
          type="text"
          placeholder="Search quotations..."
          class="w-full p-2 border rounded"
          :disabled="loading"
        />
      </div>

      <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quotation Code</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Items</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="quotation in filteredQuotations" :key="quotation.id">
              <td class="px-6 py-4 whitespace-nowrap">{{ quotation.quotation_code }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ formatDate(quotation.quotation_date) }}</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">
                  {{ quotation.items ? quotation.items.length : quotation.total_items }}
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">₱{{ formatPrice(quotation.grand_total) }}</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center space-x-3">
                  <!-- View Button -->
                  <button
                    @click="viewQuotation(quotation)"
                    class="text-green-600 hover:text-green-900 mr-4 transition-colors duration-200"
                    title="View Quotations"
                    :disabled="loading"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                      <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                      <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                    </svg>
                    
                  </button>

                  <!-- Delete Button -->
                  <button
                    @click="confirmDelete(quotation)"
                    class="text-red-600 hover:text-red-900 transition-colors duration-200"
                    title="Delete"
                    :disabled="loading"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Empty State -->
      <div v-if="filteredQuotations.length === 0 && !loading" class="text-center py-8 text-gray-500">
        No quotations found for this customer.
      </div>

      <!-- Loading State for Table -->
      <div v-if="loading && filteredQuotations.length === 0" class="text-center py-8 text-gray-500">
        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-500 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Loading quotations...
      </div>

      <!-- Create Quotation Modal -->
      <div v-if="showCreateModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-screen overflow-y-auto">
          <div class="p-6">
            <h2 class="text-xl font-semibold mb-4">Create New Quotation</h2>
            <form @submit.prevent="createQuotation">
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="quotation_date">Date</label>
                <input
                  v-model="quotationForm.quotation_date"
                  id="quotation_date"
                  type="date"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                  required
                  :disabled="creatingQuotation"
                />
              </div>

              <div class="mb-6">
                <h3 class="text-lg font-medium mb-2">Items</h3>
                <div v-for="(item, index) in quotationForm.items" :key="index" class="border p-4 mb-4 rounded">
                  <div class="flex justify-between items-center mb-2">
                    <h4 class="font-medium">Item #{{ index + 1 }}</h4>
                    <button
                      v-if="quotationForm.items.length > 1"
                      @click="removeItem(index)"
                      type="button"
                      class="text-red-500 hover:text-red-700"
                      :disabled="creatingQuotation"
                    >
                      Remove
                    </button>
                  </div>
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                      <label class="block text-gray-700 text-sm font-bold mb-2">Product Name</label>
                      <input
                        v-model="item.product_name"
                        type="text"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        required
                        :disabled="creatingQuotation"
                      />
                    </div>
                    <div>
                      <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                      <input
                        v-model="item.description"
                        type="text"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        :disabled="creatingQuotation"
                      />
                    </div>
                    <div>
                      <label class="block text-gray-700 text-sm font-bold mb-2">Quantity</label>
                      <input
                        v-model="item.quantity"
                        type="number"
                        min="1"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        required
                        :disabled="creatingQuotation"
                      />
                    </div>
                    <div>
                      <label class="block text-gray-700 text-sm font-bold mb-2">Unit Cost</label>
                      <input
                        v-model="item.unit_cost"
                        type="number"
                        min="0"
                        step="0.01"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        required
                        :disabled="creatingQuotation"
                      />
                    </div>
                  </div>
                </div>
                <button
                  @click="addItem"
                  type="button"
                  class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded"
                  :disabled="creatingQuotation"
                >
                  Add Another Item
                </button>
              </div>

              <div class="flex justify-end">
                <button
                  type="button"
                  @click="closeModal"
                  class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded mr-2"
                  :disabled="creatingQuotation"
                >
                  Cancel
                </button>
                <button
                  type="submit"
                  class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
                  :disabled="creatingQuotation"
                >
                  <svg v-if="creatingQuotation" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                  </svg>
                  {{ creatingQuotation ? 'Creating...' : 'Save Quotation' }}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- View Quotation Modal -->
      <div v-if="showViewModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-screen overflow-y-auto">
          <div class="p-6">
            <h2 class="text-xl font-semibold mb-4">Quotation Details</h2>
            
            <!-- Customer Information Section -->
            <div class="mb-6 border-b pb-4">
              <h3 class="text-lg font-medium mb-2">Customer Information</h3>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                  <p class="text-gray-600">Name:</p>
                  <p class="font-medium">{{ customer.name }}</p>
                </div>
                <div>
                  <p class="text-gray-600">Email:</p>
                  <p class="font-medium">{{ customer.email }}</p>
                </div>
                <div>
                  <p class="text-gray-600">Contact:</p>
                  <p class="font-medium">{{ customer.contact_info }}</p>
                </div>
                <div>
                  <p class="text-gray-600">Address:</p>
                  <p class="font-medium">{{ customer.address || 'N/A' }}</p>
                </div>
              </div>
            </div>

            <!-- Quotation Summary -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
              <div>
                <p class="text-gray-600">Quotation Code:</p>
                <p class="font-medium">{{ viewedQuotation.quotation_code }}</p>
              </div>
              <div>
                <p class="text-gray-600">Date:</p>
                <p class="font-medium">{{ formatDate(viewedQuotation.quotation_date) }}</p>
              </div>
              <div>
                <p class="text-gray-600">Total Items:</p>
                <p class="font-medium">{{ viewedQuotation.items.length }}</p>
              </div>
              <div>
                <p class="text-gray-600">Grand Total:</p>
                <p class="font-medium">₱{{ formatPrice(viewedQuotation.grand_total) }}</p>
              </div>
            </div>

            <!-- Items Table -->
            <h3 class="text-lg font-medium mb-2">Items</h3>
            <table class="min-w-full divide-y divide-gray-200 mb-6">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit Price</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="(item, index) in viewedQuotation.items" :key="index">
                  <td class="px-6 py-4 whitespace-nowrap">{{ item.product_name }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ item.description }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ item.quantity }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">₱{{ formatPrice(item.unit_cost) }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">₱{{ formatPrice(item.quantity * item.unit_cost) }}</td>
                </tr>
              </tbody>
            </table>

            <!-- Action Buttons -->
            <div class="flex justify-between">
              <button
                @click="sendQuotationEmail"
                class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded"
                :disabled="sendingEmail"
              >
                <svg v-if="sendingEmail" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                {{ sendingEmail ? 'Sending...' : 'Send to Customer via Email' }}
              </button>
              <button
                @click="showViewModal = false"
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded"
                :disabled="sendingEmail"
              >
                Close
              </button>
            </div>
          </div>
        </div>
      </div>

    <!-- Delete Confirmation Modal -->
    <div v-if="showDeleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center p-4 z-50">
      <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
        <div class="p-6">
          <!-- Header with warning icon -->
          <div class="flex items-start">
            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-red-100 flex items-center justify-center">
              <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
              </svg>
            </div>
            <div class="ml-4">
              <h3 class="text-lg font-medium text-gray-900">Confirm Delete</h3>
              <div class="mt-2">
                <p class="text-sm text-gray-500">
                  Are you sure you want to delete this quotation? 
                  This action cannot be undone.
                </p>
              </div>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
            <button
              @click="showDeleteModal = false"
              class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:col-start-1 sm:text-sm"
              :disabled="deletingQuotation"
            >
              Cancel
            </button>
            <button
              @click="deleteQuotation"
              class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:col-start-2 sm:text-sm"
              :disabled="deletingQuotation"
            >
              <svg v-if="deletingQuotation" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              {{ deletingQuotation ? 'Deleting...' : 'Delete' }}
            </button>
          </div>
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
      customer: {},
      quotations: [],
      searchQuery: '',
      showCreateModal: false,
      showViewModal: false,
      showDeleteModal: false,
      loading: false,
      creatingQuotation: false,
      deletingQuotation: false,
      sendingEmail: false,
      successMessage: '',
      errorMessage: '',
      emailSuccess: null,
      emailError: null,
      selectedQuotation: null,
      viewedQuotation: {
        quotation_code: '',
        quotation_date: '',
        items: [],
        grand_total: 0,
      },
      quotationForm: {
        quotation_date: new Date().toISOString().split('T')[0],
        items: [
          {
            product_name: '',
            description: '',
            quantity: 1,
            unit_cost: 0
          }
        ]
      }
    }
  },
  computed: {
    filteredQuotations() {
      return this.quotations.filter(quotation => {
        return (quotation.quotation_code || '').toLowerCase().includes(this.searchQuery.toLowerCase())
      })
    }
  },
  async created() {
    await this.fetchCustomerAndQuotations();
  },
  methods: {
    async fetchCustomerAndQuotations() {
      this.loading = true;
      this.errorMessage = '';

      try {
        const customerId = this.$route.params.customerId;

        const response = await axios.get(`/api/customers/${customerId}`);

        if (!response.data || Object.keys(response.data).length === 0) {
          this.errorMessage = 'Customer not found';
          this.customer = null;
          this.quotations = [];
          return; // Stop further execution
        }

        this.customer = response.data;
        this.quotations = response.data.quotations || [];

        if (!this.quotations.length) {
          const quotesResponse = await axios.get(`/api/customers/${customerId}/quotations`);
          this.quotations = Array.isArray(quotesResponse.data) ? quotesResponse.data : [];
        }
      } catch (error) {
        console.error('Error:', error);
        this.errorMessage = 'Failed to load customer data';
      } finally {
        this.loading = false;
        if (this.errorMessage) {
          setTimeout(() => this.errorMessage = '', 5000);
        }
      }
    },

    formatPrice(value) {
      if (value === null || value === undefined) return '0.00';
      const num = Number(value);
      return isNaN(num) ? '0.00' : num.toLocaleString(undefined, { 
        minimumFractionDigits: 2, 
        maximumFractionDigits: 2 
      });
    },

    formatDate(dateString) {
      if (!dateString) return 'N/A';
      try {
        const options = { year: 'numeric', month: 'short', day: 'numeric' };
        return new Date(dateString).toLocaleDateString(undefined, options);
      } catch {
        return 'Invalid date';
      }
    },

    async viewQuotation(quotation) {
      try {
        if (quotation.items && quotation.items.length > 0) {
          this.viewedQuotation = quotation;
        } else {
          const response = await axios.get(`/api/quotations/${quotation.id}`);
          this.viewedQuotation = response.data;
        }
        this.showViewModal = true;
      } catch (error) {
        console.error('Error viewing quotation:', error);
        this.errorMessage = 'Failed to load quotation details';
        setTimeout(() => this.errorMessage = '', 5000);
      }
    },

    async createQuotation() {
      this.creatingQuotation = true;
      this.errorMessage = '';
      
      try {
        const payload = {
          customer_id: this.customer.id,
          quotation_date: this.quotationForm.quotation_date,
          items: this.quotationForm.items
        };

        const response = await axios.post('/api/quotations', payload);
        
        const newQuotation = {
          ...response.data.quotation,
          quotation_code: response.data.quotation.quotation_code,
          quotation_date: response.data.quotation.quotation_date,
          items: response.data.quotation.items || [],
          grand_total: response.data.quotation.grand_total,
          total_items: response.data.quotation.total_items || response.data.quotation.items?.length || 0
        };

        this.quotations.unshift(newQuotation);
        this.closeModal();
        this.successMessage = 'Quotation created successfully!';
        setTimeout(() => this.successMessage = '', 5000);
      } catch (error) {
        console.error('Error creating quotation:', error);
        this.errorMessage = error.response?.data?.error || 'Failed to create quotation';
        setTimeout(() => this.errorMessage = '', 5000);
      } finally {
        this.creatingQuotation = false;
      }
    },

    confirmDelete(quotation) {
      this.selectedQuotation = quotation;
      this.showDeleteModal = true;
    },

    async deleteQuotation() {
      this.deletingQuotation = true;
      this.errorMessage = '';
      
      try {
        await axios.delete(`/api/quotations/${this.selectedQuotation.id}`);
        const index = this.quotations.findIndex(q => q.id === this.selectedQuotation.id);
        if (index !== -1) {
          this.quotations.splice(index, 1);
        }
        this.showDeleteModal = false;
        this.successMessage = 'Quotation deleted successfully!';
        setTimeout(() => this.successMessage = '', 5000);
      } catch (error) {
        console.error('Error deleting quotation:', error);
        this.errorMessage = 'Failed to delete quotation';
        setTimeout(() => this.errorMessage = '', 5000);
      } finally {
        this.deletingQuotation = false;
      }
    },

    async sendQuotationEmail() {
    this.sendingEmail = true;
    this.emailSuccess = null;
    this.emailError = null;

    try {
      const response = await axios.post(`/api/quotations/${this.viewedQuotation.id}/send-email`, {
        customer_email: this.customer.email,
        quotation_details: this.viewedQuotation
      });

      this.emailSuccess = 'Quotation sent to customer successfully!';
      
      // Close the modal after successful email sending
      this.showViewModal = false;
      
      // Clear success message after 5 seconds
      setTimeout(() => this.emailSuccess = null, 5000);
    } catch (error) {
      console.error('Error sending email:', error);
      this.emailError = error.response?.data?.message || 'Failed to send quotation email';
      setTimeout(() => this.emailError = null, 5000);
    } finally {
      this.sendingEmail = false;
    }
  },

    addItem() {
      this.quotationForm.items.push({
        product_name: '',
        description: '',
        quantity: 1,
        unit_cost: 0
      });
    },

    removeItem(index) {
      this.quotationForm.items.splice(index, 1);
    },

    closeModal() {
      this.showCreateModal = false;
      this.quotationForm = {
        quotation_date: new Date().toISOString().split('T')[0],
        items: [
          {
            product_name: '',
            description: '',
            quantity: 1,
            unit_cost: 0
          }
        ]
      };
    }
  }
}
</script>