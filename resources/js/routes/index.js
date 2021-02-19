import Homepage from '../pages/Homepage.vue'
export default {
    mode: 'history',
    routes: [
        {
            path: '/laravel_test',
            name: 'home',
            component: Homepage,
        },
       
    ]
}
