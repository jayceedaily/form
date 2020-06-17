import Dashboard from '../view/dashboard/Index'
import Form from '../view/form/Index'
import ShowForm from '../view/form/ShowForm'

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

    {
        path: '/form/:id',
        name: 'ShowForm',
        component: ShowForm,
        meta: {
            title: 'Show Form'
        }
    },
];
