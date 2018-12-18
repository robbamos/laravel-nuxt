import axios from 'axios'

import cookies from 'js-cookie'
import {
    setAuthToken,
    resetAuthToken
} from '~/utils/auth'

axios.defaults.baseURL = 'http://localhost:3001/api';

const token = cookies.get('x-access-token')

if (token) {
    setAuthToken(token)
} else {
    resetAuthToken()
}