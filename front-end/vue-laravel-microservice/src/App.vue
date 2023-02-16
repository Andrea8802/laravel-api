<script>
import axios from 'axios';

export default {
  data() {
    return {
      movies: ''
    }
  },
  mounted() {
    axios.get('http://127.0.0.1:8000/api/v1/movie/all')
      .then(res => {
        this.movies = res.data.response
        console.log(this.movies);
      })
      .catch(err => {
        console.error('Error: ' + err);
      })
  }
}
</script>

<template>
  <div v-for="movie in this.movies">
    <b>Name: </b> {{ movie.name }} ({{ movie.year }})
    <br>
    <b>Cash Out: </b> {{ movie.cash_out }}
    <br>
    <hr>
</div>
</template>

<style></style>
