import axios from 'axios';
import url from '../URL';
import {getToken} from "../../stores/user";

async function getAuthors() {
    try {
        const response = await axios.get(`${url}api/authors/list`, {
            headers: {Authorization: `Bearer ${getToken()}`}
        });
        return JSON.parse(response.data);
    } catch (error) {
        console.log(error);
    }
}

export default getAuthors;