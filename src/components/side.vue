<template>
  <div  class='side'
        :class='{ "side--open": open }'>
    <div  class='side__label'
          @click='open = !open'>
      <h2 class='side__label__title'
          v-html='"Poll"' />
    </div>
    <Poll class='side__content'/>
  </div>
</template>

<script>
import Poll from '@/components/Poll'

export default {
  name: 'side',
  components: {
    Poll
  },
  data () {
    return {
      open: false
    }
  }
}
</script>

<style lang='scss'>
@import '../assets/style/variables';
@import '../assets/style/transitions';
@import '../assets/style/helpers/responsive';
@import '../assets/style/helpers/mixins';

.side {
  width: 90vw;
  height: 100%;
  background: #fff;
  position: fixed;
  top: 0;
  right: -90vw;
  z-index: 9999999;
  transition: all .3s ease;

  &__content {
    height: 90%;
    padding: 20px 40px 80px;
    text-align: left;
    overflow-y: scroll;

    @include hide-scroll;
  }

  &--open {
    right: 0;
  }

  @include screen-size('small') {
    width: 100vw;
    height: 90%;
    right: auto;
    top: auto;
    bottom: -90%;;

    &--open {
      bottom: 0;
    }
  }

  &__label {
    display: block;
    position: absolute;
    padding: 12px;
    min-width: 120px;
    height: 28px;
    top: 120px;
    left: 0;
    background: #fff;
    border-radius: 10px 10px 0 0;
    transform: rotate(-90deg);
    transform-origin: left bottom 0;
    transition: box-shadow 0.3s ease;

    &:hover {
      box-shadow: $shadow-inverted;
    }

    @include screen-size('small') {
      transform: none;
      top: -52px;;
      left: 12px;
    }
  }
}
</style>
