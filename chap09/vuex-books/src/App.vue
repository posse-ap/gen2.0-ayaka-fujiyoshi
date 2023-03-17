<template>
  <div>
    <form v-on:submit.prevent="onclick">
      <label for="isbn">ISBN：</label>
      <input type="text" id="isbn" v-model="isbn" /><br />
      <label for="title">書名：</label>
      <input type="text" id="title" v-model="title" /><br />
      <label for="price">価格：</label>
      <input type="number" id="price" v-model="price" /><br />
      <input type="submit" v-if="isEditing" value="更新" />
      <input type="submit" v-else value="登録" />

    </form>
    <hr />
    <p>書籍は全部で{{booksCount}}冊あります。</p>
    <ul v-for="book of getBooksByPrice(2500)" v-bind:key="book.isbn">
      <li>
        {{book.title}}（{{book.price}}円）<br />ISBN：{{book.isbn}} <br />
        <a v-on:click="editBook(book)">[編集]</a>
      </li>
    </ul>
  </div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex';

export default {
  name: 'App',
  computed: mapGetters(['booksCount', 'getBooksByPrice']),

  data() {
    return {
      isbn: '',
      title: '',
      price: 0,
      isEditing: false,
      editedBook: null
    };
  },

  methods: {
    ...mapActions(['addAsync', 'updateAsync']),

    onclick() {
      if (this.isEditing) {
        this.updateAsync({
          book: {
            ...this.editedBook,
            isbn: this.isbn,
            title: this.title,
            price: this.price
          }
        });
         this.isEditing = false;
         this.editedBook.isbn = this.isbn;
         this.editedBook.title = this.title;
         this.editedBook.price = this.price;
         this.editedBook = null;
      } else {
        this.addAsync({
          book: { isbn: this.isbn, title: this.title, price: this.price }
        });
      }
      this.isbn = '';
      this.title = '';
      this.price = 0;
    },

    editBook(book) {
      this.isbn = book.isbn;
      this.title = book.title;
      this.price = book.price;
      this.isEditing = true;
      this.editedBook = book;
    }
  }
};
</script>