<template>
    <div>
      <h1>Nuev Categoria</h1>
      
      <div class="card">
        <div class="card-body">
          <form @submit.prevent="submitForm">

            <div class="mb-3">
              <label class="form-label">Nombre</label>
              <input v-model="form.name" type="text" class="form-control" required>
            </div>

            <div class="d-flex justify-content-end gap-2">
              <NuxtLink to="/category" class="btn btn-secondary">
                Cancelar
              </NuxtLink>
              <button type="submit" class="btn btn-primary" :disabled="loading">
                <span v-if="loading" class="spinner-border spinner-border-sm"></span>
                Crear Categoria
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
        form: {
          name: ''
        }
      }
    },
    methods: {
      async submitForm() {
        this.loading = true
        try {
          const response = await fetch('http://127.0.0.1:8000/api/categories', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'token': '1234567890'
            },
            body: JSON.stringify(this.form)
          })
          
          if (response.ok) {
            this.$router.push('/category')
          } else {
            alert('Error al crear la categoria')
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