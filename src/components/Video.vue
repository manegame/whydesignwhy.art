<template>
  <div  class='video__single'
        :class='{ "video__single--viewing": openCurtains }'>
    <div  class='video__single__curtains'
          @click='curtainActions'>
      <div  class='video__single__curtains__left'
            :class='[jonathanLeft, curtainLeft]'></div>
      <div  class='video__single__curtains__right'
            :class='[jonathanRight, curtainRight]'></div>
    </div>
    <div  class='video__single__video embed-video'
          v-if='options.provider === "youtube"'>
      <youtube  ref="youtube"
                :video-id="options.id"
                :player-vars="youtubeOptions"
                @ended='ended' />
    </div>
    <div  class='video__single__video embed-video'
          v-else-if='options.provider === "vimeo"'>
      <vimeo-player ref='vimeo'
                    :video-id='options.id'
                    @ended='ended' />
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
      youtubeOptions: {
        autoplay: 0,
        rel: 0,
        showinfo: 0,
        muted: true
      }
    }
  },
  computed: {
    jonathanLeft () {
      return 'video__single__curtains__left--' + this.options.ego + ''
    },
    jonathanRight () {
      return 'video__single__curtains__right--' + this.options.ego + ''
    },
    curtainLeft () {
      return {
        'video__single__curtains__left--open': this.openCurtains
      }
    },
    curtainRight () {
      return {
        'video__single__curtains__right--open': this.openCurtains
      }
    },
    youtubePlayer () {
      return this.$refs.youtube.player
    },
    vimeoPlayer () {
      return this.$refs.vimeo
    }
  },
  methods: {
    ended () {
      this.$emit('ended', this.options.id)
    },
    curtainActions () {
      if (this.options.provider === 'vimeo') {
        this.openCurtains ? this.vimeoPlayer.pause() : this.vimeoPlayer.play()
        this.openCurtains = !this.openCurtains
      } else if (this.options.provider === 'youtube') {
        this.openCurtains ? this.youtubePlayer.pauseVideo() : this.youtubePlayer.playVideo()
        this.openCurtains = !this.openCurtains
      }
    }
  },
  beforeDestroy () {
    console.log('self destruct')
    this.$emit('curtains', false)
  },
  watch: {
    openCurtains (val) {
      if (val) {
        this.$emit('curtains', true)
      } else {
        this.$emit('curtains', false)
      }
    }
  }
}
</script>

<style scoped lang='scss'>
@import '../assets/style/variables';
@import '../assets/style/helpers/responsive.scss';

.video {
  background-color: $yellow;

  &__single {
    width: 800px;
    height: 450px;
    position: relative;
    overflow: hidden;
    transition: all 1.2s ease;
    cursor: pointer;

    @include screen-size('small') {
      width: 400px;
      height: 225px;
    }

    &--viewing {
      width: 80vw;
      height: 45vw;
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

        &--hielkema {
          background-image: url('../../static/left-hielkema.svg');
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

        &--hielkema {
          background-image: url('../../static/right-hielkema.svg');
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
