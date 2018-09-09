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
  width: 100vw;
  height: 100vh;
  overflow: hidden;

  strong {
    font-weight: normal !important;
  }
}

.view {
  &--one {
    z-index: 10;
    width: 100%;
    min-height: 100vh;
    pointer-events: none;
  }

  &--two {
    z-index: 0;
    width: 100%;
    min-height: 100vh;
  }
}

.embed-video {
  position: relative;
  padding-bottom: 56.25%;
  height: 0;
  overflow: hidden;
  max-width: 100%;

  iframe,
  object,
  embed {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
  }
}
</style>
