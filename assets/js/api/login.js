import axios from 'axios';
import url from './URL';
import {setStorageUser, setUser} from "../stores/user";

async function loginUser({email, password}) {
    const response = await axios.post(`${url}api/login_check`, {
        username: email,
        password
    }).catch(error => console.log(error));

    if(response) {
        const jwt = response.data.token;
        const username = email;
        const user = {username, jwt};
        setStorageUser(user);
        setUser(user);
    }

    return response;
}

export default loginUser;