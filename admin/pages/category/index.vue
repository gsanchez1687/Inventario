<template>
  <div>
    <h1>Productos</h1>

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Lista de Categorias</h3>
        <NuxtLink 
  to="/category/create" 
  class="btn btn-secondary"
>
  Agregar Categoria
</NuxtLink>
      </div>
      <div class="card-body">
        <table class="table table-striped table-hover table-bordered">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nombre</th>
            </tr>
          </thead>
          <tbody>
            <tr v-if="loading">
              <td colspan="7" class="text-center">
                <div class="spinner-border" role="status">
                  <span class="visually-hidden">Cargando...</span>
                </div>
              </td>
            </tr>
            <tr v-for="(category, index) in categories" :key="category.id">
              <th scope="row">{{ category.id }}</th>
              <td>{{ category.name || 'N/A' }}</td>
              <td>
                <NuxtLink 
                  :to="`/category/edit/${category.id}`"
                  class="btn btn-sm btn-primary me-2"
                >
                  Editar
                </NuxtLink>
                <button 
                  class="btn btn-sm btn-primary" 
                  @click="deleteCategory(category.id)"
                >
                  Eliminar
                </button>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="pagination-controls mt-3">
          <button 
            class="btn btn-sm btn-outline-primary me-2"
            @click="previousPage"
            :disabled="currentPage === 0"
          >
            Anterior
          </button>
          
          <span v-if="totalPages > 0">
            Página {{ currentPage + 1 }} de {{ totalPages }}
          </span>
          
          <button 
            class="btn btn-sm btn-outline-primary ms-2"
            @click="nextPage"
          >
            Siguiente
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      products: [],
      loading: true,
      currentPage: 0,
      perPage: 10,
      totalPages: 0,
      categories: []
    }
  },
  mounted() {
    this.fetchCategories()
  },
  methods: {
    async fetchCategories() {
      console.log('Ejecutando fetchCategories');
      try {
        const response = await fetch(`http://127.0.0.1:8000/api/categories?per_page=${this.perPage}&page=${this.currentPage}`, {
          method: 'GET',
          headers: {
            'token': '1234567890'
          }
        })
        const data = await response.json()
        console.log('API Response:', data) // Debug
        this.categories = data
        this.totalPages = Math.ceil(data.length / this.perPage)
      } catch (error) {
        console.error('Error fetching categories:', error)
      } finally {
        this.loading = false
      }
    },
    async deleteCategory(id) {
      try {
        const response = await fetch(`http://127.0.0.1:8000/api/categories/${id}`, {
          method: 'DELETE',
          headers: {
            'token': '1234567890'
          }
        })
        if (response.ok) {
          this.fetchCategories()
        } else {
          alert('Error al eliminar la categoría')
        }
      } catch (error) {
        console.error('Error al eliminar la categoría:', error)
      }
    },
    nextPage() {
        this.currentPage++
        this.fetchCategories()
    },
    previousPage() {
      if (this.currentPage > 0) {
        this.currentPage--
        this.fetchCategories()
      }
    }
  }
}
</script>