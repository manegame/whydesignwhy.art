<template>
  <div class='file'>
    <form novalidate
          v-if="isInitial || isSaving">
      <div class="dropbox">
        <input  type="file"
                :name="uploadFieldName"
                :disabled="isSaving"
                @change="uploadFile($event.target.files)"
                accept="image/*"
                class="input-file">
          <p v-if="isInitial">
            Drag your contribution here to begin<br> or click to browse
          </p>
          <p v-if="isSaving">
            Uploading file...
          </p>
      </div>
    </form>

    <!--SUCCESS-->
    <div v-if="isSuccess">
      <h2>Uploaded file successfully.</h2>
      <p>
        <a href="javascript:void(0)" @click="reset()">Upload again</a>
      </p>
    </div>
    <!--FAILED-->
    <div v-if="isFailed">
      <h2>Uploaded failed.</h2>
      <p>
        <a href="javascript:void(0)" @click="reset()">Try again</a>
      </p>
    </div>
  </div>
</template>

<script>
import { upload } from '@/service/dropbox'

const STATUS_INITIAL = 0
const STATUS_SAVING = 1
const STATUS_SUCCESS = 2
const STATUS_FAILED = 3

export default {
  name: 'File',
  data () {
    return {
      uploadError: null,
      currentStatus: null,
      uploadFieldName: 'photos'
    }
  },
  computed: {
    isInitial () {
      return this.currentStatus === STATUS_INITIAL
    },
    isSaving () {
      return this.currentStatus === STATUS_SAVING
    },
    isSuccess () {
      return this.currentStatus === STATUS_SUCCESS
    },
    isFailed () {
      return this.currentStatus === STATUS_FAILED
    }
  },
  methods: {
    reset () {
      // reset form to initial state
      this.currentStatus = STATUS_INITIAL
      this.uploadError = null
    },
    uploadFile (file) {
      console.log(file[0])
      upload(file[0])
        .then(x => {
          this.currentStatus = STATUS_SUCCESS
        })
        .catch(err => {
          this.uploadError = err.response
          this.currentStatus = STATUS_FAILED
        })
    }
  },
  mounted () {
    this.reset()
  }
}
</script>

<style scoped lang='scss'>
@import '@/assets/style/variables.scss';

.file {
  margin-bottom: 80px;
}

.dropbox {
  border-radius: 20px;
  outline: 2px dashed grey; /* the dash box */
  outline-offset: -20px;
  background: $yellow-light;
  color: dimgray;
  padding: 10px 10px;
  min-height: 200px; /* minimum height */
  width: 50vw;
  margin-left: 25vw;
  margin-top: 10vh;
  position: relative;
  cursor: pointer;
}

.input-file {
  opacity: 0; /* invisible but it's there! */
  width: 100%;
  height: 200px;
  position: absolute;
  cursor: pointer;
}

.dropbox:hover {
  background: $yellow; /* when mouse over to the drop zone, change color */
}

.dropbox p {
  font-size: 1.2em;
  text-align: center;
  padding: 50px 0;
}
</style>
