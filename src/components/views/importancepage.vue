<template>
  <div class='importance'>
    <File />
    <div class="importance__comments">
      <vue-disqus shortname="whydesignwhy-art"
                  :identifier="1"
                  url="http://whydesignwhy.art/importance" />
    </div>
  </div>
</template>

<script>
import File from '@/components/File'

export default {
  name: 'importancepage',
  components: { File }
}
</script>

<style lang='scss'>
@import '../../assets/style/variables.scss';

.importance {
  &__comments {
    width: 66.66%;
    margin: 0 auto;
    padding: 20px;
    border-radius: 20px;
    transition: box-shadow 0.3s ease;

    &:hover {
      box-shadow: $shadow;
    }
  }
}
</style>
