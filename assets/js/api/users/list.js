import axios from "axios";
import url from '../URL';

async function getUsers() {
    try {
        const response = await axios.get(`${url}api/users/list`);
        return JSON.parse(response.data);
    } catch (error) {
        console.log(error);
    }

    // return await axios.get(`${url}api/users/list`).catch(error => console.log(error));
}

export default getUsers;