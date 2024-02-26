// import Vue from 'vue'
// import Router, { createRouter, createWebHashHistory } from 'vue-router'
import { createRouter, createWebHistory } from 'vue-router'

import SimulacaoEmprestimo from '../views/SimulacaoEmprestimo'
import ListaEmprestimos from '../components/ListaEmprestimos'

const routes = [
    {path: '/', component: SimulacaoEmprestimo},
    {path: '/emprestimos', component: ListaEmprestimos}
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;