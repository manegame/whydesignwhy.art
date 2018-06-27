<template>
  <div class='main'>
    <!-- - Boekje (scrollend automatisch, of handmatig met klik) -->
    <!-- <Book /> -->
    <!-- - Video (met gordijnen; touchy and hielkema) -->
    <!-- <Video /> -->
    <!-- - Submit Page (assignment by the audience) -->
    <!-- <Assignment /> -->
    <!-- - Poll (4 white man to senegal yes/no? -->
    <!-- <Poll /> -->
    <!-- - Sources page. -->
  </div>
</template>

<script>
import Book from '@/components/Book'
import Video from '@/components/Video'
import Assignment from '@/components/Assignment'
import Poll from '@/components/Poll'

export default {
  name: 'main',
  components: {
    Book,
    Video,
    Assignment,
    Poll
  },
  data () {
    return {
      msg: 'main'
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang='scss'>
@import '../../assets/style/variables.scss';

.main {
  background: $yellow;
  min-height: 100vh;
}
</style>
