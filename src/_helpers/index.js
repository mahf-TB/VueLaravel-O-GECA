import router from "@/router/index";
import Axios from "@/_service/caller.service";

let Connect = (to) => {
    let token = localStorage.getItem('token')
    if (token) {
        return true
    }
    router.push('/login')
}
let Deconnect = (to) => {
    let token = localStorage.getItem('token')

    if (!token) {
        return true
    }
    router.push('/')
}
let User = (to) => {
    const token = JSON.parse(localStorage.getItem("token"));
    if (token) {
        Axios.get('/auth/user').then(response => {
            if (response.data.role == 'ADMIN') {
                return true
            }
            router.push('/')

        }).catch(error => {
            console.log("error dans l'axios: ", error)
        })
    }
}
export const authGuard = {
    Deconnect, Connect, User
}