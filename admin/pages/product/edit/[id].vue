<template>
  <div>
    <h1>Editar Producto</h1>
    
    <div class="card">
      <div class="card-body">
        <form @submit.prevent="submitForm">
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
            <button type="button" class="btn btn-secondary" @click="$router.go(-1)">
              Cancelar
            </button>
            <button type="submit" class="btn btn-primary" :disabled="loading">
              <span v-if="loading" class="spinner-border spinner-border-sm"></span>
              Guardar Cambios
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
        name: '',
        description: '',
        price: 0,
        stock: 0
      }
    }
  },
  
  async mounted() {
    await this.loadProduct()
  },
  
  methods: {
    async loadProduct() {
      try {
        const response = await fetch(`http://127.0.0.1:8000/api/products/${this.$route.params.id}`, {
          headers: {
            'token': '1234567890'
          }
        })
        const data = await response.json()
        this.form = data
      } catch (error) {
        console.error('Error cargando producto:', error)
      }
    },
    
    async submitForm() {
      this.loading = true
      try {
        const response = await fetch(`http://127.0.0.1:8000/api/products/${this.$route.params.id}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
            'token': '1234567890'
          },
          body: JSON.stringify(this.form)
        })
        
        if (response.ok) {
          this.$router.push('/product')
        } else {
          alert('Error al actualizar el producto')
        }
      } catch (error) {
        console.error('Error actualizando producto:', error)
      } finally {
        this.loading = false
      }
    }
  }
}
</script>
