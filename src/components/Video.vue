<template>
  <div class='video'>
    <youtube :video-id="videoId" ref="youtube" :player-vars="playerVars" @playing="playing"></youtube>
  </div>
</template>

<script>
export default {
  name: 'Video',
  data () {
    return {
      videoId: '-v4NwizarDA',
      playerVars: {
        autoplay: 1,
        showinfo: 0
      }
    }
  },
  methods: {
    playing () {
      console.log('we watching!')
    }
  }
}
</script>

<style lang="scss" scoped>
.video {
  width: 100vw;
}
</style>
