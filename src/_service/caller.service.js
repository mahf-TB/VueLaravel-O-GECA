import axios from "axios";

const Axios = axios.create({
    baseURL: "http://127.0.0.1:8000/api/"
})
Axios.interceptors.request.use(request=>{
    let token = JSON.parse(localStorage.getItem("token"));
    if(token){
        request.headers.Authorization = 'Bearer '+ token
    }
    return request
})
export default Axios
