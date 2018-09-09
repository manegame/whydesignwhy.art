<template>
  <div class='mainpage'>
    <!-- main -->
    <!-- <side :content='"Poll"' /> -->
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

<style scoped lang='scss'>
@import '../../assets/style/variables.scss';

.mainpage {
  background: $yellow;
}
</style>
