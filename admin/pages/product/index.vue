<template>
  <div>
    <h1>Productos</h1>

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Lista de Productos</h3>
        <NuxtLink 
  to="/product/create" 
  class="btn btn-secondary"
>
  Agregar Producto
</NuxtLink>
      </div>
      <div class="card-body">
        <table class="table table-striped table-hover table-bordered">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Categoria</th>
              <th scope="col">Nombre</th>
              <th scope="col">Descripcion</th>
              <th scope="col">Precio</th>
              <th scope="col">Stock</th>
              <th scope="col">Acciones</th>
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
            <tr v-for="(product, index) in products" :key="product.id">
              <th scope="row">{{ product.id }}</th>
              <td>{{ product.category?.name || 'N/A' }}</td>
              <td>{{ product.name }}</td>
              <td>{{ product.description }}</td>
              <td>{{ product.price }}</td>
              <td>{{ product.stock }}</td>
              <td>
                <NuxtLink 
                  :to="`/product/edit/${product.id}`"
                  class="btn btn-sm btn-primary me-2"
                >
                  Editar
                </NuxtLink>
                <button 
                  class="btn btn-sm btn-primary" 
                  @click="deleteProduct(product.id)"
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
import DataTable from 'primevue/datatable'
import Column from 'primevue/column'
import Button from 'primevue/button'

export default {
  components: {
    DataTable,
    Column,
    Button
  },
  data() {
    return {
      products: [],
      loading: true,
      currentPage: 0,
      perPage: 10,
      totalPages: 0
    }
  },
  mounted() {
    this.fetchProducts()
  },
  methods: {
    async fetchProducts() {
      try {
        const response = await fetch(`http://127.0.0.1:8000/api/products?per_page=${this.perPage}&page=${this.currentPage}`, {
          method: 'GET',
          headers: {
            'token': '1234567890'
          }
        })
        const data = await response.json()
        console.log('API Response:', data) // Debug
        this.products = data
        this.totalPages = Math.ceil(data.length / this.perPage)
      } catch (error) {
        console.error('Error fetching products:', error)
      } finally {
        this.loading = false
      }
    },
    async deleteProduct(id) {
      try {
        const response = await fetch(`http://127.0.0.1:8000/api/products/${id}`, {
          method: 'DELETE',
          headers: {
            'token': '1234567890'
          }
        })
        if (response.ok) {
          this.fetchProducts()
        } else {
          alert('Error al eliminar el producto')
        }
      } catch (error) {
        console.error('Error al eliminar el producto:', error)
      }
    },
    nextPage() {
        this.currentPage++
        this.fetchProducts()
    },
    previousPage() {
      if (this.currentPage > 0) {
        this.currentPage--
        this.fetchProducts()
      }
    }
  }
}
</script>
