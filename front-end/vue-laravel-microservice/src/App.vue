<script>
import axios from 'axios';

export default {
  name: 'App',

  data() {
    return {
      apiUrl: 'http://127.0.0.1:8000/api/v1/',
      currentId: 0,
      movies: '',
      genres: '',
      tags: [],
      movieName: '',
      movieYear: '',
      movieCashOut: '',
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
        })
        .catch(err => {
          console.error('Error: ' + err);
        })
    },

    loadData() {
      return {
        'name': this.movieName,
        'year': this.movieYear,
        'cash_out': this.movieCashOut,
        'genre_id': this.movieGenreId,
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

    createMovie(e) {
      e.preventDefault();

      const movie = this.loadData();
      this.showCreate = false;

      axios.post(this.apiUrl + 'movie/store/', movie)
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

    editMovie(e) {
      e.preventDefault();

      const movie = this.loadData();
      this.showEdit = false;

      axios.post(this.apiUrl + 'movie/update/' + this.currentId, movie)
        .then(res => {
          if (res.data.success) {
            this.updateMovie();
            this.clearForm();
          }
        })
        .catch(err => {
          console.error(err);
          this.clearForm();
        });


    },

    clearForm() {
      this.movieName = '',
        this.movieYear = '',
        this.movieCashOut = '',
        this.movieGenreId = '',
        this.movieTags = []
    },

    onToggleCreate() {
      if (!this.showCreate) {
        this.showCreate = !this.showCreate

      } else {
        this.showCreate = !this.showCreate
        this.clearForm();
      }
    },

    onToggleEdit(id) {
      if (!this.showEdit) {
        this.currentId = id;
        this.showEdit = !this.showEdit;
        id--;

        this.movieName = this.movies[id].name;
        this.movieYear = this.movies[id].year;
        this.movieCashOut = this.movies[id].cash_out;
        this.movieGenreId = this.movies[id].genre_id;
        this.movies[id].tags.forEach(tag => this.movieTags.push(tag.id));
      } else {
        this.showEdit = !this.showEdit;
        this.clearForm();
      }
    }

  }
}
</script>

<template>
  <div v-if="showCreate">
    <button @click="onToggleCreate">Show List</button>
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
      <input type="number" name="cash_out" v-model="movieCashOut">
      <br>
      <label for="genre_id">Genre</label>
      <select name="genre_id" v-model="movieGenreId">
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

      <input type="submit" value="Create Movie" @click="createMovie">
    </form>
  </div>

  <div v-else-if="showEdit">
    <button @click="onToggleEdit">Show List</button>
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
      <input type="number" name="cash_out" v-model="movieCashOut">
      <br>
      <label for="genre_id">Genre</label>
      <select name="genre_id" v-model="movieGenreId">
        <option v-for="genre in genres" :value="genre.id">
          {{ genre.name }}
        </option>
      </select>

      <br><br>
      <label>Tags:</label>
      <br>

      <div v-for="tag in tags" :key="tag.id">
        <input type="checkbox" :value="tag.id" v-model="movieTags">
        <label :for="tag.id">{{ tag.name }}</label>
      </div>
      <br>

      <input type="submit" value="Edit Movie" @click="editMovie">
    </form>
  </div>

  <div v-else>
    <button @click="onToggleCreate">Create Movies</button>
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
      <button @click="onToggleEdit(movie.id)">Edit</button>
      <button @click="deleteMovie(movie.id)">Delete</button>
      <hr>
    </div>
  </div>
</template>

<style></style>
