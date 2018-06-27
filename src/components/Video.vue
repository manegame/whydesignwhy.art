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
      videoId: 'YJAGNad7FLI',
      playerVars: {
        autoplay: 1
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
  color: red;
}
</style>
