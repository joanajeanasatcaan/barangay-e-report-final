<template>
    <div class="py-12 mx-auto max-w-7xl sm:px-6 lg:px-4">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-4">
        <header class="mb-6">
          <h2 class="text-xl font-bold leading-tight text-gray-800">
            Add Report Page
          </h2>
          <p class="text-gray-500">
            Submit a new incident report to Barangay Ubojan officials
          </p>
        </header>

        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
          <div class="p-12 px-4 py-4 text-gray-900">
            <!-- Error Messages -->
            <div v-if="errors.length" class="mb-4 alert alert-danger">
              <ul>
                <li v-for="(error, index) in errors" :key="index" class="text-red-500">
                  {{ error }}
                </li>
              </ul>
            </div>

            <!-- Success Message -->
            <div v-if="successMessage" class="mb-4 alert alert-success">
              {{ successMessage }}
            </div>

            <!-- Form -->
            <form @submit.prevent="submitForm" enctype="multipart/form-data">
              <h2 class="text-xl font-semibold leading-tight text-gray-800">Report an Incident</h2>
              <p class="mb-4 text-sm text-gray-500">Please provide details about the incident you want to report</p>

              <!-- Incident Title -->
              <div class="mb-4 form-group">
                <label for="title" class="block text-sm font-medium font-semibold text-gray-700">Incident Title</label>
                <input
                  v-model="form.title"
                  placeholder="Brief title of the incident"
                  type="text"
                  id="title"
                  class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                  :class="{ 'border-red-500': formErrors.title }"
                  required
                >
                <p v-if="formErrors.title" class="mt-1 text-xs text-red-500">{{ formErrors.title }}</p>
              </div>

              <!-- Category -->
              <div class="mb-4 form-group">
                <label for="category" class="block text-sm font-medium font-semibold text-gray-700">Category</label>
                <select
                  v-model="form.category"
                  id="category"
                  class="block w-full p-2 mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                  :class="{ 'border-red-500': formErrors.category }"
                  required
                >
                  <option value="" disabled>Select Issue</option>
                  <option value="Vandalism">Vandalism</option>
                  <option value="Illegal Gambling">Illegal Gambling</option>
                  <option value="Littering/Garbage Issue">Littering/Garbage Issue</option>
                  <option value="Noise Complaint">Noise Complaint</option>
                  <option value="Neighborhood Dispute">Neighborhood Dispute</option>
                  <option value="Traffic Issue">Traffic Issue</option>
                  <option value="Other Issue">Other Issue</option>
                </select>
                <p v-if="formErrors.category" class="mt-1 text-xs text-red-500">{{ formErrors.category }}</p>

                <!-- Other Issue Input -->
                <div v-if="form.category === 'Other Issue'" class="mt-4">
                  <label for="other_issue" class="block text-sm font-medium text-red-400">Please Specify Other Issue*</label>
                  <input
                    v-model="form.other_issue"
                    type="text"
                    id="other_issue"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    :class="{ 'border-red-500': formErrors.other_issue }"
                  >
                  <p v-if="formErrors.other_issue" class="mt-1 text-xs text-red-500">{{ formErrors.other_issue }}</p>
                </div>
              </div>

              <!-- Location -->
              <div class="mb-4 form-group">
                <label for="location" class="block text-sm font-medium font-semibold text-gray-700">Location</label>
                <input
                  v-model="form.location"
                  placeholder="Where did this happen?"
                  type="text"
                  id="location"
                  class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                  :class="{ 'border-red-500': formErrors.location }"
                  required
                >
                <p v-if="formErrors.location" class="mt-1 text-xs text-red-500">{{ formErrors.location }}</p>
              </div>

              <!-- Description -->
              <div class="mb-4 form-group">
                <label for="description" class="block text-sm font-medium font-semibold text-gray-700">Description</label>
                <textarea
                  v-model="form.description"
                  placeholder="Provide details about what happened"
                  id="description"
                  rows="5"
                  class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                  :class="{ 'border-red-500': formErrors.description }"
                  required
                ></textarea>
                <p v-if="formErrors.description" class="mt-1 text-xs text-red-500">{{ formErrors.description }}</p>
              </div>

              <!-- Evidence Photo -->
              <div class="mb-4 form-group">
                <label for="photos" class="block text-sm font-medium font-semibold text-gray-700">Evidence Photo</label>
                <input
                  type="file"
                  id="photos"
                  multiple
                  accept="image/*"
                  class="block w-full mt-1 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                  :class="{ 'border-red-500': formErrors.photos }"
                  @change="handleFileUpload"
                >
                <p v-if="formErrors.photos" class="mt-1 text-xs text-red-500">{{ formErrors.photos }}</p>
              </div>

              <!-- Submit Button -->
              <div class="mt-4">
                <button
                  type="submit"
                  class="inline-flex items-center px-4 py-2 font-semibold text-white bg-green-600 border border-transparent rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                >
                  Submit Report
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </template>

  <script>
  export default {
    name: 'AddReport',
    data() {
      return {
        form: {
          title: '',
          category: '',
          other_issue: '',
          location: '',
          description: '',
          photos: []
        },
        formErrors: {
          title: '',
          category: '',
          other_issue: '',
          location: '',
          description: '',
          photos: ''
        },
        errors: [],
        successMessage: ''
      }
    },
    methods: {
      handleFileUpload(event) {
        const files = Array.from(event.target.files)
        if (files.length > 3) {
          this.formErrors.photos = 'You can upload a maximum of 3 photos.'
          this.form.photos = []
        } else {
          this.form.photos = files
          this.formErrors.photos = ''
        }
      },
      async submitForm() {
        // Reset errors
        this.errors = []
        this.formErrors = {
          title: '',
          category: '',
          other_issue: '',
          location: '',
          description: '',
          photos: ''
        }

        // Client-side validation
        let hasError = false
        if (!this.form.title) {
          this.formErrors.title = 'Incident title is required.'
          hasError = true
        }
        if (!this.form.category) {
          this.formErrors.category = 'Category is required.'
          hasError = true
        }
        if (this.form.category === 'Other Issue' && !this.form.other_issue) {
          this.formErrors.other_issue = 'Please specify the other issue.'
          hasError = true
        }
        if (!this.form.location) {
          this.formErrors.location = 'Location is required.'
          hasError = true
        }
        if (!this.form.description) {
          this.formErrors.description = 'Description is required.'
          hasError = true
        }

        if (hasError) return

        // Prepare form data
        const formData = new FormData()
        formData.append('title', this.form.title)
        formData.append('category', this.form.category)
        if (this.form.category === 'Other Issue') {
          formData.append('other_issue', this.form.other_issue)
        }
        formData.append('location', this.form.location)
        formData.append('description', this.form.description)
        this.form.photos.forEach((photo, index) => {
          formData.append(`photos[${index}]`, photo)
        })

        try {
          // Replace with your API endpoint
          const response = await fetch('/api/reports/store', {
            method: 'POST',
            body: formData,
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
          })

          const result = await response.json()
          if (response.ok) {
            this.successMessage = result.message || 'Report submitted successfully!'
            // Reset form
            this.form = {
              title: '',
              category: '',
              other_issue: '',
              location: '',
              description: '',
              photos: []
            }
          } else {
            this.errors = result.errors || ['An error occurred while submitting the report.']
          }
        } catch (error) {
          this.errors = ['Failed to submit the report. Please try again.']
        }
      }
    }
  }
  </script>

  <style scoped>
  .alert-success {
    background-color: #d4edda;
    color: #155724;
    padding: 1rem;
    border-radius: 0.375rem;
    margin-bottom: 1rem;
  }

  .alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    padding: 1rem;
    border-radius: 0.375rem;
    margin-bottom: 1rem;
  }
  </style>
