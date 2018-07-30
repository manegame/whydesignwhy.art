<template>
  <div class='mainpage'>
    <!-- main -->
    <!-- <side :content='"Poll"' /> -->
  </div>
</template>

<script>
import side from '@/components/side'

export default {
  name: 'mainpage',
  components: {
    side
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

.mainpage {
  background: $yellow;
  width: 100%;
  height: 100%;
  overflow: hidden;
}
</style>
