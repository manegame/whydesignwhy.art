<template>
  <div  class='side'
        :class='{ "side--open": open }'>
    <div  class='side__label'
          @click='open = !open'>
      <h2  class='side__label__title'
          v-html='content === "Poll" ? content : "something here" ' />
    </div>
    <div  class='side__content'
          v-if='content === "Poll"'>
      <h1 class='side__content__title'>Should these white men go to Africa?</h1>
      <p class='side__content__desc'>Jonathan Hielkema invites 
        <a href='https://twitter.com/jimmy_p_nelson?lang=en'>@jimmy_nelson</a>, 
        <a href='http://renzomartens.com/'>@renzo_martens</a> and 
        <a href='https://www.instagram.com/janhoekjoh/?hl=en'>@jan_hoek</a> for a joint trip to his mini post-colony in ..., Senegal to discuss the ideas outlined in the book. <br>
        <br>
        What do you think? Should they go?
      </p>
      <div class='side__content__poll'>
        <div  class='side__content__poll__option'
              :style='{ width: yesPercentage + "%"}'
              @click='vote("yes")'>
          <h2  class='side__content__poll__option__title'>
            Yes
            <transition name='fade'>
              <span   class='side__content__poll__option__title--perc'
                      v-if='hasVoted'
                      v-html='yesPercentage + "%"' />
            </transition>
          </h2>
        </div>
        <div  class='side__content__poll__option'
              :style='{ width: noPercentage + "%" }'
              @click='vote("no")'>
          <h2  class='side__content__poll__option__title'>
            No
            <transition name='delayed_fade'>
              <span   class='side__content__poll__option__title--perc'
                      v-if='hasVoted'
                      v-html='noPercentage + "%"' />
            </transition>
          </h2>
        </div>
      </div>
      <p  class='side__content__vote_status' 
          v-html='voteStatus' />
    </div>
  </div>
</template>

<script>
export default {
  name: 'side',
  props: {
    content: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      open: false,
      votes: {
        yes: 1,
        no: 1
      },
      hasVoted: false,
      voteStatus: ''
    }
  },
  computed: {
    yesPercentage() {
      if (this.votes.yes + this.votes.no === 0) {
        return 50
      } else {
        let num = this.votes.yes / (this.votes.yes + this.votes.no) * 100
        return num.toFixed(2)
      }
    },
    noPercentage() {
      return 100 - this.yesPercentage
    }
  },
  methods: {
    vote(answer) {
      if (!this.hasVoted) {
        if (answer === "yes") this.votes.yes++
        else if (answer === "no") this.votes.no++
        this.hasVoted = true
        this.voteStatus = 'Thanks for your vote!'
      } else {
        this.voteStatus = 'You already voted!'
      }
    }
  }
}
</script>

<style lang='scss'>
@import '../assets/style/variables';
@import '../assets/style/transitions';
@import '../assets/style/helpers/responsive';

.side {
  width: 80vw;
  height: 100%;
  background: #fff;
  position: absolute;
  top: 0;
  right: -80vw;
  z-index: 99;
  transition: all .3s ease;

  &__content {
    padding: 20px 40px 80px;
    text-align: left;

    &__title {
      width: 100%;
      text-align: center;
      margin-bottom: 40px;
    }

    &__desc {
      margin-bottom: 40px;
      max-width: 80ch;
    }

    &__poll {
      width: 80%;
      margin: 0 auto;
      border-radius: 10px;
      overflow: hidden;
      background: rgb(205, 205, 205);
      display: flex;
      flex-flow: row nowrap;
      align-items: center;
      cursor: pointer;
      transition: box-shadow 0.3s ease;
      margin-bottom: 40px;

      &:hover {
        box-shadow: $shadow;
      }

      &__option {
        text-align: center;
        padding: 12px 0;
        transition: width 4s ease, background-color 0.3s ease;

        &__title {
          &--perc {
            font-size: 12px;
            line-height: 12px;
            color: #fff;
            vertical-align: super;
          }
        }

        &:nth-child(1) {
          border-right: 2px solid $yellow;
        }

        &:hover {
          background-color: rgb(207, 207, 207);
        }
      }
    }
  }

  &--open {
    right: 0;
  }

  @include screen-size('small') {
    width: 100vw;
    height: 90%;
    right: auto;
    top: auto;
    bottom: -90%;;

    &--open {
      bottom: 0;
    }
  }

  &__label {
    display: block;
    position: absolute;
    padding: 12px;
    min-width: 120px;
    height: 28px;
    top: 120px;
    left: 0;
    background: #fff;
    border-radius: 10px 10px 0 0;
    transform: rotate(-90deg);
    transform-origin: left bottom 0;
    transition: box-shadow 0.3s ease;
    
    &:hover {
      box-shadow: $shadow-inverted;
    }

    @include screen-size('small') {
      transform: none;
      top: -52px;;
      left: 12px;
    }
  }
}
</style>
