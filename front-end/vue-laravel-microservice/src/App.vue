<script>
import axios from 'axios';

export default {
  data() {
    return {
      apiUrl: 'http://127.0.0.1:8000/api/v1/',
      movies: ''
    }
  },
  mounted() {
    this.updateMovie();
  },
  methods: {
    updateMovie() {
      axios.get(this.apiUrl + 'movie/all')
        .then(res => {
          this.movies = res.data.response
          console.log(this.movies);
        })
        .catch(err => {
          console.error('Error: ' + err);
        })
    },

    deleteMovie(id) {
      axios.get(this.apiUrl + 'movie/delete/' + id)
        .then(res => {

          if (res.data.success) {
            this.updateMovie();
          }
        })
        .catch(err => {
          console.error('Error: ' + err);
        })
    }
  }
}
</script>

<template>
  <div v-for="movie in this.movies" :key="movies.id" :info="movie">
    <h2>{{ movie.name }} ({{ movie.year }})</h2>
    <b>Cash Out: </b> {{ movie.cash_out }}€
    <br>
    <b>Genre: </b>{{ movie.genre.name }}
    <br>
    <b>Tags: </b>
    <span v-for="tag in movie.tags">
      {{ tag.name }};
    </span>
    <br>
    <button @click="deleteMovie(movie.id)">Delete</button>
    <hr>
  </div>
</template>

<style></style>
