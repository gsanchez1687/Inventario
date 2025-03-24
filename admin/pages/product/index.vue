<template>
  <div>
    <h1>Productos</h1>

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Lista de Productos</h3>
        <button class="btn btn-secondary">Agregar Producto</button>
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
              <th scope="row">{{ index + 1 }}</th>
              <td>{{ product.category?.name || 'N/A' }}</td>
              <td>{{ product.name }}</td>
              <td>{{ product.description }}</td>
              <td>S/ {{ product.price }}</td>
              <td>{{ product.stock }}</td>
              <td>
                <button class="btn btn-sm btn-primary me-2">Editar</button>
                <button class="btn btn-sm btn-primary">Eliminar</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      products: [],
      loading: true
    }
  },
  mounted() {
    this.fetchProducts()
  },
  methods: {
    async fetchProducts() {
      try {
        const response = await fetch('http://127.0.0.1:8000/api/products', {
          headers: {
            'token': '1234567890'
          }
        })
        const data = await response.json()
        this.products = data
      } catch (error) {
        console.error('Error fetching products:', error)
      } finally {
        this.loading = false
      }
    }
  }
}
</script>
