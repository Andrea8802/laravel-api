<script>
import axios from 'axios';

export default {
  name: 'App',

  data() {
    return {
      apiUrl: 'http://127.0.0.1:8000/api/v1/',
      currentMovie: [],
      movies: '',
      genres: '',
      tags: [],
      movieName: '',
      movieYear: '',
      movieCashOut: '',
      movieGenreId: '',
      movieTags: [],
      showForm: false,
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
        })
        .catch(err => {
          console.error('Error: ' + err);
        })
    },

    loadData() {
      return {
        'name': this.currentMovie.name,
        'year': this.currentMovie.year,
        'cash_out': this.currentMovie.cash_out,
        'genre_id': this.currentMovie.genre_id,
        'tags': this.movieTags
      }
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

    submitMovie(e) {
      e.preventDefault();

      const movie = this.loadData();
      this.showForm = false;
      console.log(this.currentMovie);
      const actualApi = this.apiUrl + (
        this.currentMovie.id
          ? 'movie/update/' + this.currentMovie.id
          : 'movie/store/'
      );

      axios.post(actualApi, movie)
        .then(res => {
          if (res.data.success) {
            this.updateMovie();
            this.clearForm();
          }
        })
        .catch(err => {
          console.error(err);
          this.clearForm();
        })

    },

    clearForm() {
      this.movieName = '',
        this.movieYear = '',
        this.movieCashOut = '',
        this.movieGenreId = '',
        this.movieTags = [],
        this.currentMovie = []
    },

    onToggleForm(movie) {
      if (!this.showForm) {
        this.showForm = !this.showForm;
        if (movie.id) {
          this.currentMovie = movie;
          this.currentMovie.tags.forEach(tag => this.movieTags.push(tag.id));
        }
      } else {
        this.showForm = !this.showForm;
        this.clearForm();
      }
    }

  }
}
</script>

<template>
  <div v-if="showForm">
    <button @click="onToggleForm">Show List</button>
    <br>
    <br>
    <form>
      <label for="name">Name</label>
      <input type="text" name="name" v-model="currentMovie.name">
      <br>
      <label for="year">Year</label>
      <input type="number" name="year" v-model="currentMovie.year">
      <br>
      <label for="cash_out">CashOut</label>
      <input type="number" name="cash_out" v-model="currentMovie.cash_out">
      <br>
      <label for="genre_id">Genre</label>
      <select name="genre_id" v-model="currentMovie.genre_id">
        <option v-for="genre in genres" :value="genre.id">
          {{ genre.name }}
        </option>
      </select>
      <br>
      <br>

      <label>Tags: </label>
      <br>
      <div v-for="tag in tags" :key="tag.id">
        <input type="checkbox" :value="tag.id" v-model="movieTags">
        <label :for="tag.id">{{ tag.name }}</label>
      </div>
      <br>

      <input type="submit" :value="currentMovie === [] ? 'Edit Movie' : 'Create Movie'" @click="submitMovie">
    </form>
  </div>


  <div v-else>
    <button @click="onToggleForm">Create Movies</button>
    <br>
    <div v-for="movie in movies" :key="movies.id" :info="movie">
      <h2>{{ movie.name }} ({{ movie.year }})</h2>
      <b>Cash Out: </b> {{ movie.cash_out }}€
      <br>
      <b>Genre: </b> {{ movie.genre.name }}
      <br>
      <b>Tags: </b>
      <span v-for="tag in movie.tags">
        {{ tag.name }};
      </span>
      <br>
      <button @click="onToggleForm(movie)">Edit</button>
      <button @click="deleteMovie(movie.id)">Delete</button>
      <hr>
    </div>
  </div>
</template>

<style></style>
