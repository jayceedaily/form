import Dashboard from '../view/dashboard/Index'
import Form from '../view/form/Index'
import ShowForm from '../view/form/ShowForm'
import PublicForm from '../view/form/PublicForm'
import CreateForm from '../view/form/CreateForm'

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
        path: '/form/create',
        name: 'CreateForm',
        component: CreateForm,
        meta: {
            title: 'Create Form'
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


    {
        path: '/form/:id/response',
        name: 'ShowFormResponse',
        component: ShowForm,
        meta: {
            title: 'Show Form'
        }
    },

    {
        path: '/:id',
        name: 'PublicForm',
        component: PublicForm,
        meta: {
            title: 'Public Form',
            guess: true
        }
    },
];
