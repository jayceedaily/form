import Dashboard from '../view/dashboard/Index'
import Form from '../view/form/Index'

export const routes = [

    {
        path: '/',
        name: 'Dashboard',
        component: Dashboard,
        meta: {
            title: 'Dashboard'
        }
    },

    {
        path: '/form',
        name: 'Form',
        component: Form,
        meta: {
            title: 'Form'
        }
    },
];
