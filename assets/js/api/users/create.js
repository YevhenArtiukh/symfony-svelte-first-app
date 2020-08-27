import axios from "axios";
import url from '../URL';

async function createUser({name, surname, email, password}) {
    return await axios.post(`${url}api/users/add`, {
        name,
        surname,
        email,
        password
    }).catch(error => console.log(error));
}

export default createUser;