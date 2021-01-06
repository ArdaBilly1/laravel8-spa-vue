import VueRouter from 'vue-router';
import Library from './views/Library.vue';


let routes = [
    {
        path: '/',
        component: Home,
        children:[
            {
                path: 'library',
                component: Library,
                name: 'library', 
                // meta: { requiresAuth: true} ,
              },
        ]

    }

];

const router = new VueRouter({
    routes
});

export default router;