<template>
  <div class='mainpage'>
    <!-- main -->
  </div>
</template>

<script>
export default {
  name: 'mainpage',
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

.mainpage {
  background: $yellow;
  min-height: 100vh;
}
</style>
