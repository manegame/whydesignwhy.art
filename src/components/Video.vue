<template>
  <div  class='video__single'
        :class='{ "video__single--viewing": openCurtains }'>
    <div  class='video__single__curtains'
          @click='openCurtains = !openCurtains'>
      <div  class='video__single__curtains__left'
            :class='{ "video__single__curtains__left--open": openCurtains }'></div>
      <div  class='video__single__curtains__right'
            :class='{ "video__single__curtains__right--open": openCurtains }'></div>
    </div>
    <div  class='video__single__video embed-video'
          v-if='options.provider === "youtube"'>
      <youtube  ref="youtube"
                :video-id="options.id"
                :player-vars="playerVars"
                @playing="playing"
                @ended='ended' />
    </div>
    <div  class='video__single__video embed-video'
          v-else-if='options.provider === "vimeo"'>
      <vimeo-player ref='vimeo'
                    :video-id='options.id' />
    </div>
  </div>
</template>

<script>
export default {
  name: 'videopage',
  props: {
    options: {
      type: Object,
      required: true
    }
  },
  data () {
    return {
      vimeo: {
        loaded: false
      },
      openCurtains: false,
      playerVars: {
        autoplay: 0,
        rel: 0,
        showinfo: 0
      }
    }
  },
  computed: {
    youtubePlayer () {
      return this.$refs.youtube.player
    },
    vimeoPlayer () {
      return this.$refs.vimeo.player
    }
  },
  methods: {
    async playVideo () {
      await this.youtubePlayer.playVideo()
      // Do something after the playVideo command
      console.log('playVideo triggered')
    },
    playVimeo () {
      this.vimeoPlayer.play()
    },
    playing () {
      console.log('we watching!')
    },
    ended () {
      console.log('video ended')
    }
  },
  watch: {
    openCurtains (bool) {
      if (this.options.provider === 'youtube') {
        console.log(this.options.provider)
        if (bool) {
          this.youtubePlayer.playVideo()
        } else {
          this.youtubePlayer.pauseVideo()
        }
      } else if (this.options.provider === 'vimeo') {
        if (bool) {
          setTimeout(this.playVimeo, 3000)
        } else {
          console.log('curtains closed')
        }
      }
    }
  }
}
</script>

<style scoped lang='scss'>
@import '../assets/style/variables';
@import '../assets/style/helpers/responsive.scss';

.video {
  &__single {
    width: 800px;
    height: 450px;
    position: relative;
    overflow: hidden;
    transition: all 1.2s ease;

    @include screen-size('small') {
      width: 400px;
      height: 225px;
    }

    &--viewing {
      width: 100vw;
      height: 56.25vw;
    }

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
        background-image: url('../../static/left.svg');
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
        background-image: url('../../static/right.svg');
        background-position: left;
        background-repeat: no-repeat;
        transition: all 0.45s ease-out;

        &--open {
          right: -65vw;
          transform: skew(10deg, 0);
        }
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
