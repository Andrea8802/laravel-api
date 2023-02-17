<script>
import axios from 'axios';


export default {
  name: 'App',

  data() {
    return {
      apiUrl: 'http://127.0.0.1:8000/api/v1/',
      movies: '',
      genres: '',
      tags: '',
      movieName: '',
      movieYear: '',
      MovieCashOut: '',
      movieGenreId: '',
      movieTags: ''
    }
  },
  mounted() {
    this.updateMovie();
  },
  methods: {
    updateMovie() {
      axios.get(this.apiUrl + 'movie/all')
        .then(res => {
          this.movies = res.data.response.movies
          this.genres = res.data.response.genres
          this.tags = res.data.response.tags
          console.log(this.movies);
          console.log(this.genres);
          console.log(this.tags);
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
    },

    createMovie(e) {
      e.preventDefault();

      const movie = {
        'name': this.movieName,
        'year': this.movieYear,
        'cash_out': this.MovieCashOut,
        'genre_id': this.movieGenreId,
        'tags': this.tags
      }

      axios.post(this.apiUrl + 'movie/store/', movie)
        .then(res => {
          console.log(res);
          if (res.data.success) {
            this.updateMovie();
            this.clearForm();
          }
        })
        .catch(err => {
          console.error(err);
        })
    },
    clearForm() {
      this.movieName = '',
        this.movieYear = '',
        this.MovieCashOut = '',
        this.movieGenreId = '',
        this.movieTags = ''
    }
  }
}
</script>

<template>
  <form>
    <label for="name">Name</label>
    <input type="text" name="name" v-model="this.movieName">
    <br>
    <label for="year">Year</label>
    <input type="number" name="year" v-model="this.movieYear">
    <br>
    <label for="cash_out">CashOut</label>
    <input type="number" name="cash_out" v-model="this.MovieCashOut">
    <br>
    <label for="genre_id">Genre</label>
    <select name="genre_id" v-model="this.movieGenreId">
      <option v-for="genre in this.genres" :value="genre.id">
        {{ genre.name }}
      </option>
    </select>

    <div>

    </div>
    <br>
    <div v-for="tag in this.tags">
      <input type="checkbox" name="tags[]" :value="tag.id" v-model="this.movieTags">
      <label for="tags">{{ tag.name }}</label>
    </div>

    <input type="submit" value="Create Movie" @click="createMovie">
  </form>

  <div v-for="movie in this.movies" :key="movies.id" :info="movie">
    <h2>{{ movie.name }} ({{ movie.year }})</h2>
    <b>Cash Out: </b> {{ movie.cash_out }}€
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
