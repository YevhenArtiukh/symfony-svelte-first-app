import axios from "axios";
import url from '../URL';

async function getUser(id) {
    try {
        const response = await axios.get(`${url}api/user/${id}`);
        return JSON.parse(response.data);
    } catch (error) {
        console.log(error);
    }
}

export default getUser;