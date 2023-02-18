<script>
import axios from 'axios';


export default {
  name: 'App',

  data() {
    return {
      apiUrl: 'http://127.0.0.1:8000/api/v1/',
      movies: '',
      genres: '',
      tags: [],
      movieName: '',
      movieYear: '',
      MovieCashOut: '',
      movieGenreId: '',
      movieTags: [],
      showCreate: false,
      showEdit: false
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
        'tags': this.movieTags
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
        this.movieTags = []
    },
    addTags(id) {
      this.movieTags.push(id)
    },
    OntoggleCreate() {
      this.showCreate = !this.showCreate
    },
    OntoggleEdit() {
      this.showCreate = !this.showCreate
    }
  }
}
</script>

<template>
  <div v-if="showCreate">
    <button @click="OntoggleCreate">Show List</button>
    <br>
    <br>
    <form>
      <label for="name">Name</label>
      <input type="text" name="name" v-model="movieName">
      <br>
      <label for="year">Year</label>
      <input type="number" name="year" v-model="movieYear">
      <br>
      <label for="cash_out">CashOut</label>
      <input type="number" name="cash_out" v-model="MovieCashOut">
      <br>
      <label for="genre_id">Genre</label>
      <select name="genre_id" v-model="movieGenreId">
        <option v-for="genre in genres" :value="genre.id">
          {{ genre.name }}
        </option>
      </select>

      <br>
      <div v-for="tag in tags" :key="tag.id">
        <input type="checkbox" :value="tag.id" @click="addTags(tag.id)" v-model="tag.id">
        <label :for="tag.id">{{ tag.name }}</label>
      </div>

      <input type="submit" value="Create Movie" @click="createMovie">
    </form>
  </div>

  <div v-else-if="showEdit">
    <button @click="OntoggleEdit">Show List</button>
    <br>
    <br>
    <form>
      <label for="name">Name</label>
      <input type="text" name="name" v-model="movieName">
      <br>
      <label for="year">Year</label>
      <input type="number" name="year" v-model="movieYear">
      <br>
      <label for="cash_out">CashOut</label>
      <input type="number" name="cash_out" v-model="MovieCashOut">
      <br>
      <label for="genre_id">Genre</label>
      <select name="genre_id" v-model="movieGenreId">
        <option v-for="genre in genres" :value="genre.id">
          {{ genre.name }}
        </option>
      </select>

      <br>
      <div v-for="tag in tags" :key="tag.id">
        <input type="checkbox" :value="tag.id" @click="addTags(tag.id)" v-model="tag.id">
        <label :for="tag.id">{{ tag.name }}</label>
      </div>

      <input type="submit" value="Create Movie" @click="createMovie">
    </form>
  </div>

  <div v-else>
    <button @click="OntoggleCreate">Create Movies</button>
    <br>
    <div v-for="movie in movies" :key="movies.id" :info="movie">
      <h2>{{ movie.name }} ({{ movie.year }})</h2>
      <b>Cash Out: </b> {{ movie.cash_out }}€
      <br>
      <b>Tags: </b>
      <span v-for="tag in movie.tags">
        {{ tag.name }};
      </span>
      <br>
      <button @click="editMovie(movie.id)">Edit</button>
      <button @click="deleteMovie(movie.id)">Delete</button>
      <hr>
    </div>
  </div>
</template>

<style></style>
