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
          
          <div class="d-flex justify-content-end gap-2">
            <button type="button" class="btn btn-secondary" @click="$router.go(-1)">
              Cancelar
            </button>
            <button type="submit" class="btn btn-primary">
              <span></span>
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
      }
    }
  },
  
  async mounted() {
    await this.loadCategory()
  },
  
  methods: {
    async loadCategory() {
      this.loading = true
      try {
        const response = await fetch(`http://127.0.0.1:8000/api/categories/${this.$route.params.id}`, {
          method: 'GET',
          headers: {
            'token': '1234567890'
          }
        })
        const data = await response.json()
        this.form = data
      } catch (error) {
        console.error('Error cargando categoria:', error)
      }
    },
    
    async submitForm() {
      this.loading = true
      try {
        const response = await fetch(`http://127.0.0.1:8000/api/categories/${this.$route.params.id}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
            'token': '1234567890'
          },
          body: JSON.stringify(this.form)
        })
        if (response.ok) {
          this.$router.push('/category')
        } else {
          alert('Error al actualizar la categoria')
        }
      } catch (error) {
        console.error('Error actualizando categoria:', error)
      } finally {
        this.loading = false
      }
    }
  }
}
</script>
