<template>
  <div id="app">
    <router-view class='view--one' name='menu'/>
    <router-view class='view--two' name='content'/>
  </div>
</template>

<script>
export default {
  name: 'App'
}
</script>

<style lang='scss'>
@import './assets/fonts/Touchy-Medium.css';
@import './assets/fonts/learning_curve_bold_ot_ps.css';
@import './assets/style/typography.scss';

#app {
  font-family: 'LearningCurve-Bold';
  font-weight: normal;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;

  strong {
    font-weight: normal !important;
  }
}

.view {
  &--one {
    z-index: 10;
  }

  &--two {
    z-index: 0;
  }
}

// .flip-enter-active,
// .flip-leave-active {
//   transition: transform 1s;
// }

// .flip-enter-to,
// .flip-leave {
  //   }

// .flip-leave-to,
// .flip-enter {
//   transform: translate(0) rotate(0deg);
//   transform: translate(-45vw) rotate(45deg);
// }

</style>
