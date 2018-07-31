<template>
  <div class='videopage'>
    <div  class='videopage__curtains'
          @click='openCurtains = !openCurtains'>
      <div  class='videopage__curtains__left'
            :class='{ "videopage__curtains__left--open": openCurtains }'></div>
      <div  class='videopage__curtains__right'
            :class='{ "videopage__curtains__right--open": openCurtains }'></div>
    </div>
    <div class='videopage__video embed-video'>
      <youtube  :video-id="videoId"
                ref="youtube"
                :player-vars="playerVars"
                @playing="playing"
                @ended='ended' />
    </div>
  </div>
</template>

<script>
export default {
  name: 'videopage',
  data () {
    return {
      videoId: 'SqUqVBsbaRk',
      openCurtains: false,
      playerVars: {
        autoplay: 0,
        rel: 0
      }
    }
  },
  computed: {
    player () {
      return this.$refs.youtube.player
    }
  },
  methods: {
    async playVideo () {
      await this.player.playVideo()
      // Do something after the playVideo command
      console.log('playVideo triggered')
    },
    playing () {
      console.log('we watching!')
    },
    ended () {
      console.log('video ended')
    }
  },
  watch: {
    openCurtains (val) {
      if (val) {
        console.log('curtains open!')
        this.player.playVideo()
      } else {
        this.player.pauseVideo()
      }
    }
  }
}
</script>

<style scoped lang='scss'>
@import '../../assets/style/variables';

.videopage {
  width: 100vw;
  height: 100vh;
  background: black;
  color: white;
  overflow: hidden;

  &__curtains {
    z-index: 5;
    position: absolute;
    width: 100%;
    height: 100%;
    overflow: hidden;
    cursor: pointer;

    &__left {
      position: absolute;
      left: 0;
      width: 50%;
      height: 100%;
      background: white;
      background-image: url('../../../static/left.svg');
      background-position: right;
      background-repeat: no-repeat;
      transition: all 0.41s ease-out;
      transform: none;
      animation: peek 10s infinite;

      &--open {
        left: -65vw;
        transform: $skew;
      }
    }

    &__right {
      position: absolute;
      right: 0;
      width: 50%;
      height: 100%;
      background: white;
      background-image: url('../../../static/right.svg');
      background-position: left;
      background-repeat: no-repeat;
      transition: all 0.45s ease-out;

      &--open {
        right: -65vw;
        transform: skew(10deg, 0);
      }
    }
  }

  &__video {
    z-index: 4;
    width: 100%;
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
    transform: skew(-4deg, 0) scale(1.01, 1);
  }
  35% {
    transform: initial;
  }
  100% {
    transform: initial;
  }
}
</style>
