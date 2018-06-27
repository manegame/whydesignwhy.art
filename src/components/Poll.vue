<template>
  <div class='poll'>
    Poll
  <form method="post" action="https://poll.pollcode.com/82315884">
      <div>
          <div style="padding:2px 0px 4px 2px;"><strong>Should these white men go to Africa?</strong></div>
          <input type="radio" name="answer" value="1" id="answer823158841" style="float:left;" />
          <label for="answer823158841" style="float:left;width:150px;">yes</label>
          <div style="clear:both;height:2px;"></div>
          <input type="radio" name="answer" value="2" id="answer823158842" style="float:left;" />
          <label for="answer823158842" style="float:left;width:150px;">no</label>
          <div style="clear:both;height:2px;"></div>
          <div align="center" style="padding:3px;">
              <input type="submit" value=" Vote ">&nbsp;
              <!--<input type="submit" name="view" value=" View ">-->
          </div>
          <!-- <div align="right" style="font-size:10px">pollcode.com <a href="https://pollcode.com/">free polls</a></div> -->
      </div>
  </form>
  </div>
</template>

<script>
export default {
  name: 'Poll'
}
</script>

<style lang="scss" scoped>
.poll {
  text-transform: uppercase;
}
</style>
