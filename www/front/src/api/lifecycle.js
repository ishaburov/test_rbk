import axios from 'axios';

let baseUrl = process.env.VUE_APP_API_URL;


const makeRequest = async ({method, url, data = undefined, opt = undefined}) => {
    url = baseUrl + url;
    try {
        return await axios({
            method,
            url,
            data,
            opt
        });
    } catch (error) {
        console.log(error);
    }
};


export default makeRequest;
