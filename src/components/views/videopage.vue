<template>
  <div  class='videopage'
        id='parent'>
    <div  class='videopage__stage'
          id='video1'>
      <Video :options="{
                provider: 'youtube',
                id: '-v4NwizarDA'
              }"/>
    </div>
    <div  class='videopage__stage'
          id='video2'>
      <Video :options="{
                provider: 'vimeo',
                id: '278386917'
              }"/>
    </div>
    <!-- <a  href='#'
        class='videopage__next'
        v-scroll-to="videoScroll">
      Next
    </a> -->
  </div>
</template>

<script>
import Video from '@/components/Video'

export default {
  name: 'videopage',
  components: {
    Video
  },
  data () {
    return {
      videoScroll: {
        el: '#video2',
        container: '#parent',
        duration: 500,
        easing: 'linear',
        offset: 0,
        x: false,
        y: true
      }
    }
  },
  methods: {
    nextVideo () {
      this.$refs.parent.scrollTo(2000, this.$refs.parent.clientHeight)
      console.log(this.$refs.video2)
    }
  }
}

</script>

<style scoped lang='scss'>
@import '../../assets/style/variables';
@import '../../assets/style/helpers/mixins';
@import '../../assets/style/helpers/responsive.scss';

.videopage {
  width: 100vw;
  height: 100vh;
  overflow-y: scroll;

  &__next {
    position: absolute;
    bottom: 0;
    right: 0;
    z-index: 1;
    opacity: 1;
    transition: opacity 0.3s ease;

    &--hidden {
      opacity: 0;
    }

    @include buttons;
  }

  &__stage {
    width: 100%;
    height: 100%;
    padding-bottom: 20px;
    background: black;
    color: white;
    overflow: hidden;
    display: flex;
    flex-flow: row nowrap;
    justify-content: center;
    align-items: center;
  }
}

@keyframes peek {
  0% {
    transform: initial;
  }
  25% {
    transform: initial;
  }
  30% {
    transform: skew(-3deg, 0) scale(1.04, 1);
  }
  35% {
    transform: initial;
  }
  100% {
    transform: initial;
  }
}
</style>
