/**
 * Two variables should already be set.
 * dropboxToken = OAuth access token, specific to the user.
 * file = file object selected in the file widget.
 */

import * as axios from 'axios'
import { DROPBOX_TOKEN } from './auth/dropbox'

function upload (file) {
  console.log('upload', file.name)

  const url = 'https://content.dropboxapi.com/2/files/upload'

  const config = {
    headers: {
      'Authorization': 'Bearer ' + DROPBOX_TOKEN,
      'Content-Type': 'application/octet-stream',
      'Dropbox-API-Arg': JSON.stringify({
        path: '/' + file.name,
        mode: 'add',
        autorename: true,
        mute: false
      })
    }
  }

  return axios.post(url, file, config)
}

export { upload }
