<template>
    <div>
      <h1>Nuevo Producto</h1>
      
      <div class="card">
        <div class="card-body">
          <form @submit.prevent="submitForm">

            <div class="mb-3">
            <label class="form-label">Categoría</label>
            <select 
              v-model="form.category_id" 
              class="form-select" 
              required
            >
              <option value="" disabled>Seleccione una categoría</option>
              <option 
                v-for="category in categories" 
                :key="category.id" 
                :value="category.id"
              >
                {{ category.name }}
              </option>
            </select>
          </div>

            <div class="mb-3">
              <label class="form-label">Nombre</label>
              <input v-model="form.name" type="text" class="form-control" required>
            </div>
            
            <div class="mb-3">
              <label class="form-label">Descripción</label>
              <textarea v-model="form.description" class="form-control" rows="3"></textarea>
            </div>
            
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Precio (S/)</label>
                <input v-model="form.price" type="number" step="0.01" class="form-control" required>
              </div>
              
              <div class="col-md-6 mb-3">
                <label class="form-label">Stock</label>
                <input v-model="form.stock" type="number" class="form-control" required>
              </div>
            </div>
  
            <div class="d-flex justify-content-end gap-2">
              <NuxtLink to="/products" class="btn btn-secondary">
                Cancelar
              </NuxtLink>
              <button type="submit" class="btn btn-primary" :disabled="loading">
                <span v-if="loading" class="spinner-border spinner-border-sm"></span>
                Crear Producto
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        loading: false,
        categories: [],
        form: {
          name: '',
          description: '',
          price: 0,
          stock: 0
        }
      }
    },
    async mounted() {
      await this.loadCategories()
    },
    methods: {
      async loadCategories() {
        try {
          const response = await fetch('http://127.0.0.1:8000/api/categories', {
            method: 'GET',
            headers: {
              'token': '1234567890'
            }
          })
          this.categories = await response.json()
        } catch (error) {
          console.error('Error cargando categorías:', error)
        }
      },
      async submitForm() {
        this.loading = true
        try {
          const response = await fetch('http://127.0.0.1:8000/api/products', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'token': '1234567890'
            },
            body: JSON.stringify(this.form)
          })
          
          if (response.ok) {
            this.$router.push('/product')
          } else {
            alert('Error al crear el producto')
          }
        } catch (error) {
          console.error('Error:', error)
          alert('Error de conexión')
        } finally {
          this.loading = false
        }
      }
    }
  }
  </script>