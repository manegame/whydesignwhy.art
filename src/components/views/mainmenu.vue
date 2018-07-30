<template>
  <div class='mainmenu'>
    <!-- POLL -->
    <Side :content='"Poll"' />
    <!-- LABEL -->
    <router-link  tag='div'
                  class='mainmenu__title'
                  :class='{
                    "mainmenu__title--flipped": $route.name !== "main",
                    "mainmenu__title--active" : activeItem !== ""
                  }'
                  :to='{ name: "main" }'
                  @mouseover.native='activeItem = ""'>
      <h1>
        Is This What I Want?<br><br>
        Provocations from an<br>
        Art Student
      </h1>
    </router-link>
    <!-- MENU ITEMS -->
    <div  class='mainmenu__items'
          :class='{ "mainmenu__items--low" : $route.name !== "main" }'>
      <router-link  tag='h2'
                    class='mainmenu__items--item'
                    :to='{ name: "book" }'
                    :class='{ "mainmenu__items--item--shadow" : activeItem !== "" }'
                    @mouseover.native='mouseOver($event)'>Notebook</router-link>
      <router-link  tag='h2'
                    class='mainmenu__items--item'
                    :to='{ name: "video" }'
                    :class='{ "mainmenu__items--item--shadow" : activeItem !== "" }'
                    @mouseover.native='mouseOver($event)'>Videos</router-link>
    </div>
    <!-- VIDEO BACKGROUND -->
    <transition name='fade'>
      <div  class='mainmenu__background'
            v-if='$route.name === "main"'
            :class='{ "mainmenu__background--active": activeItem !== "" }'>
        <video  class='mainmenu__background--video' autoplay loop muted
                :class='{ "mainmenu__background--video--active": activeItem === "notebook" }'>
          <source src='../../assets/video/pages.mp4'>
        </video>
        <video  class='mainmenu__background--video' autoplay loop muted
                :class='{ "mainmenu__background--video--active": activeItem === "videos" }'>
          <source src='../../assets/video/snip.mp4'>
        </video>
      </div>
    </transition>
  </div>
</template>

<script>
import Side from '@/components/Side'

export default {
  name: 'mainmenu',
  components: {
    Side
  },
  data () {
    return {
      activeItem: ''
    }
  },
  methods: {
    mouseOver (event) {
      this.activeItem = event.currentTarget.innerHTML.toLowerCase()
    }
  }
}
</script>

<style lang='scss'>
@import '../../assets/style/variables.scss';
@import '../../assets/style/transitions.scss';
@import '../../assets/style/helpers/responsive.scss';
@import '../../assets/fonts/learning_curve_bold_ot_ps.css';

.mainmenu {
  background: transparent;
  position: fixed;
  top: 0;
  height: 0;
  overflow: hidden;
  text-align: center;

  &__title {
    z-index: 20;
    position: fixed;
    width: 40vw;
    left: 30vw;
    top: 20vh;
    padding: 24px 12px;
    height: auto;
    border-radius: 10px;
    background: white;
    cursor: pointer;
    transition: box-shadow 0.3s ease-out, transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    box-shadow: none;
    transform: translate(0) rotate(0deg);

    &--flipped {
      transform: translate(-54vw, -15vh) rotate(80deg);
    }

    &--active,
    &:hover {
      box-shadow: $shadow;
    }

    @include screen-size('small') {
      width: 80vw;
      left: calc(10vw - 12px); /* padding included */

      /*
      &--flipped {
        transform: translate(-54vw, -15vh) rotate(80deg);
      }
      */
    }
  }

  &__items {
    z-index: 19;
    position: fixed;
    bottom: 15vh;
    height: auto;
    padding: 24px 0;
    cursor: pointer;
    width: 100vw;
    display: flex;
    flex-flow: row nowrap;
    justify-content: space-around;
    transition: bottom 0.6s ease;

    @include screen-size('small') {
      flex-flow: column nowrap;
      justify-content: center;
      align-items: center;
    }

    &--low {
      bottom: -25vh;
    }

    &--item {
      background: white;
      width: 200px;
      padding: 12px 0;
      border-radius: 10px;
      transition: all 0.3s ease;

      &--shadow {
        box-shadow: $shadow;
      }

      &--active,
      &:hover {
        background-color: $yellow;
      }

      @include screen-size('small') {
        margin-bottom: 12px;
      }
    }
  }

  &__background {
    z-index: 0;
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    display: none;

    &--active {
      display: block;
    }

    &--video {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: none;

      &--active {
        display: block;
      }
    }
  }
}
</style>
