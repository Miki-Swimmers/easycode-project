export default [
    {name: 'Стартовая страница', redirect: '/users/1'},
    {name: 'Настройки', path: '/users/:user_id', component: () => import('../views/SettingsComponent.vue'), props: true}
];
