<template>
  <div  class='book'>
    <div  class='book__loader'
          v-if="loadedRatio > 0 && loadedRatio < 1"
          :style="{ width: loadedRatio * 100 + '%' }" />
    <div  class='book__pdf oridomi'
          :class='{
            "book__pdf--double" : page !== 1 && page !== numPages,
            "book__pdf--loading" : loading
          }'>
      <pdf  class='book__pdf__inner'
            ref="pdf"
            :src="src"
            :page="page"
            :rotate="rotate"
            @progress="loadedRatio = $event"
            @num-pages="numPages = $event"
            @link-clicked="page = $event" />
    </div>
    <transition name='fade'>
      <div  class='book__navigation'
            v-if='!loading'>
        <button class='book__navigation--button'
                :disabled='page === 1'
                @click='page--' >previous</button>
        <span class='book__navigation--numbers'>
          <span v-html='page' />
          <span v-html='" / " + numPages' />
        </span>
        <button class='book__navigation--button'
                :disabled='page === numPages'
                @click='page++' >next</button>
      </div>
      <div v-else>
        <p>Loading...</p>
      </div>
    </transition>
  </div>
</template>

<script>
import pdf from 'vue-pdf'

export default {
  name: 'Book',
  components: {
    pdf
  },
  data () {
    return {
      src: './static/ITWIW-digital.pdf',
      loadedRatio: 0,
      page: 1,
      numPages: 0,
      rotate: 0
    }
  },
  computed: {
    loading () {
      if (this.numPages === 0 || this.numPages === undefined) return true
      else return false
    }
  }
}
</script>

<style lang="scss" scoped>
@import '../assets/style/variables.scss';
@import '../assets/style/helpers/normalize.css';

.book {
  position: relative;
  overflow: hidden;
  font-size: 24px;
  line-height: 24px;

  &__pdf {
    width: 30vw;
    margin: 5vh auto;
    max-height: 100vh;
    box-shadow: $shadow-inverted;

    &--loading {
      height: calc(30vw * 1.4142);
    }

    &--double {
      width: 60vw;
    }

    &__inner {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }
  }

  &__loader {
    position: absolute;
    top: 0;
    left: 0;
    height: 2px;
    background-color: white;
    color: black;
    text-align: center;
  }

  &__navigation {
    background-color: $yellow;
    font-family: 'LearningCurve-Bold';
    font-size: 24px;
    line-height: 48px;

    &--numbers {
      display: inline-block;
      width: 200px;
    }

    &--button {
      display: inline-block;
      border: none;
      padding: 0.5rem 2rem;
      border-radius: 10px;
      margin: 0;
      text-decoration: none;
      cursor: pointer;
      text-align: center;
      transition: background 250ms ease-in-out,
                  transform 150ms ease;
      -webkit-appearance: none;
      -moz-appearance: none;
      background: white;
      font-family: 'LearningCurve-Bold';
      font-size: 24px;
      line-height: 24px;

      &:active {
        background: $yellow;
        color: white;
      }

      &:focus {
        outline: none;
      }
    }
  }
}
</style>
