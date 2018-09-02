<template>
  <div  class='videopage'
        id='parent'>
    <div class='videopage__filmstrip'>
      <div  class='videopage__filmstrip__item'
            v-for='video in videos'
            :key='"item" + video.id'>
        <h1 class='videopage__filmstrip__item__title'
            :class='{"videopage__filmstrip__item__title--active": video.id === activeVideo}'
            v-html='video.title'
            @click='handleClick(video.id)' />
      </div>
    </div>
    <div class='videopage__videos'>
      <transition name='fade' mode='out-in'>
        <Video  v-for='video in videos'
                :options="video"
                :key='video.id'
                class='videopage__videos__single'
                @ended='videoEnded'
                v-if='activeVideo === video.id' />
      </transition>
    </div>
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
      activeVideo: '278386917',
      videos: [
        {
          provider: 'vimeo',
          id: '278386917',
          ego: 'hielkema',
          title: 'Intro'
        },
        {
          provider: 'youtube',
          id: '-v4NwizarDA',
          ego: 'touchy',
          title: 'Is This What I Want?'
        }
      ],
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
    videoEnded () {
      if (this.activeVideo === '278386917') {
        this.activeVideo = '-v4NwizarDA'
      } else {
        this.activeVideo = '278386917'
      }
    },
    handleClick (id) {
      this.activeVideo = id
    }
  }
}

</script>

<style scoped lang='scss'>
@import '../../assets/style/variables';
@import '../../assets/style/helpers/mixins';
@import '../../assets/style/helpers/responsive.scss';

.videopage {
  background: $yellow;
  width: 100vw;
  height: 100%;

  &__filmstrip {
    position: absolute;
    bottom: 0;
    width: 100%;
    height: auto;
    display: flex;
    flex-flow: row wrap;
    justify-content: space-around;
    align-items: center;

    &__collapse {
      color: #fff;
      width: 100%;
    }

    &__item {
      &__title {
        cursor: pointer;
        color: white;

        &--active {
          color: black;
        }
      }
    }
  }

  &__videos {
    width: 100%;
    height: 100%;
    padding-bottom: 20px;
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
