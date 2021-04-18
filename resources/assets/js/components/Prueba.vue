<template>
<div id="app-6">
  <p>{{ message }}</p>
  <input v-model="message">
</div>
</template>


<script>
	export default {
	  data () {
	    return {
	      message: 'Bienvenidos a la aplicacion de comentarios con Vue.js'
	    }
  }
}
</script>