<template>
  <div class='mainpage'>
    <Side />
  </div>
</template>

<script>
import Side from '@/components/side'

export default {
  name: 'mainpage',
  components: {
    Side
  },
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
