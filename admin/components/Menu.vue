<template>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Inventario</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
            <NuxtLink to="/" class="nav-link" active-class="active">Inicio</NuxtLink>
        </li>
        <li class="nav-item">
            <NuxtLink to="/product" class="nav-link" active-class="active">Productos</NuxtLink>
        </li>
        <li class="nav-item">
            <NuxtLink to="/category" class="nav-link" active-class="active">Categorias</NuxtLink>
        </li>
      </ul>
    </div>
  </div>
</nav>
</template>

<style scoped>
    .active{
        border-bottom: 2px solid #000;
    }
</style>