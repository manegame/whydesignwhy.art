<template>
  <div class='bookpage'>
    <Book />
  </div>
</template>

<script>
import Book from '@/components/Book'

export default {
  name: 'bookpage',
  components: {
    Book
  }
}
</script>

<style scoped lang='scss'>
@import '../../assets/style/variables.scss';

.bookpage {
  background: $yellow;
  color: black;
  min-height: 100vh;
}
</style>
