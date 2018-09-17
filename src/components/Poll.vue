<template>
  <div  class='poll'>
    <h1 class='poll__title'>Should these white men go to Africa?</h1>
    <img  class='poll__img'
          src='static/whiteboys-2.jpg' />
    <p class='poll__desc'>Jonathan Hielkema invites (from left to right)
      <a href='https://twitter.com/jimmy_p_nelson?lang=en'>@jimmy_nelson</a>,
      <a href='https://www.instagram.com/janhoekjoh/?hl=en'>@jan_hoek</a> and
      <a href='http://renzomartens.com/'>@renzo_martens</a> for a joint trip to his micro-colony in Abéné, Senegal to discuss the ideas outlined in the book “Is This What I Want?” <br>
      <br>
      What do you think? Should they go?
    </p>
    <div class='poll__poll'>
      <div  class='poll__poll__option'
            :style='{ width: yesPercentage + "%"}'
            @click='vote("yes")'>
        <h2  class='poll__poll__option__title'>
          Yes
          <transition name='fade'>
            <span   class='poll__poll__option__title--perc'
                    v-if='hasVoted'
                    v-html='yesPercentage + "%"' />
          </transition>
        </h2>
      </div>
      <div  class='poll__poll__option'
            :style='{ width: noPercentage + "%" }'
            @click='vote("no")'>
        <h2  class='poll__poll__option__title'>
          No
          <transition name='delayed_fade'>
            <span   class='poll__poll__option__title--perc'
                    v-if='hasVoted'
                    v-html='noPercentage + "%"' />
          </transition>
        </h2>
      </div>
    </div>
    <p class='poll__vote_status' v-if='votes.total'>People voted {{votes.total}} times</p>
    <p class='poll__vote_status'>{{voteStatus}}</p>
  </div>
</template>

<script>
import fetch from 'node-fetch'

export default {
  name: 'poll',
  data () {
    return {
      votes: {
        yes: 0,
        no: 0,
        total: 0
      },
      hasVoted: false,
      voteStatus: ''
    }
  },
  computed: {
    yesPercentage () {
      if (this.votes.total === 0) {
        return 50
      } else {
        let num = this.votes.yes / (this.votes.yes + this.votes.no) * 100
        return num.toFixed(2)
      }
    },
    noPercentage () {
      return 100 - this.yesPercentage
    }
  },
  methods: {
    vote (answer) {
      if (!this.hasVoted) {
        if (answer === 'yes') {
          this.submitVote(1)
        } else if (answer === 'no') {
          this.submitVote(0)
        }
        this.hasVoted = true
      }
    },
    submitVote (userAnswer) {
      fetch('https://manusnijhoff.nl/api/hielkema/vote.php', {
        method: 'POST',
        mode: 'cors',
        body: JSON.stringify({ answer: userAnswer })
      })
        .then(res => res.json())
        .then(res => {
          console.log(res)
          if (res.status === 'duplicate_vote') {
            this.voteStatus = res.error
          } else {
            this.voteStatus = 'Thanks for voting!'
          }
          this.votes.yes = Number(res.yes)
          this.votes.no = Number(res.no)
          this.votes.total = res.total
        })
        .catch(err => { console.error(err) })
    }
  }
}
</script>

<style scoped lang='scss'>
@import '@/assets/style/variables.scss';
@import '@/assets/style/helpers/_mixins.scss';

.poll {
  // padding: 40px 80px 80px;
  &__img {
    width: 100%;
    max-height: 60vh;
    object-fit: contain;
    object-position: center;
    margin-bottom: 20px;
  }

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
    background: $yellow;
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
      overflow: hidden;

      &__title {
        white-space: nowrap;

        &--perc {
          font-size: 12px;
          line-height: 12px;
          color: #000;
          vertical-align: super;
        }
      }

      &:nth-child(1) {
        border-right: 2px solid $yellow;
      }

      &:hover {
        background-color: #fff;
      }
    }
  }
}
</style>
