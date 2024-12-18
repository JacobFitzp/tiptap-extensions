const Ziggy = {
    url: 'http:\/\/localhost',
    port: null,
    defaults: {},
    routes: {
        'sanctum.csrf-cookie': {
            uri: 'sanctum\/csrf-cookie',
            methods: ['GET', 'HEAD'],
        },
        home: { uri: '\/', methods: ['GET', 'HEAD'] },
        login: {
            uri: 'login',
            methods: [
                'GET',
                'HEAD',
                'POST',
                'PUT',
                'PATCH',
                'DELETE',
                'OPTIONS',
            ],
        },
        'auth.redirect': { uri: 'auth\/redirect', methods: ['GET', 'HEAD'] },
        'auth.callback': { uri: 'auth\/callback', methods: ['GET', 'HEAD'] },
        'auth.logout': { uri: 'auth\/logout', methods: ['GET', 'HEAD'] },
        'profile.show': { uri: 'profile', methods: ['GET', 'HEAD'] },
        'extensions.submit': {
            uri: 'extensions\/submit',
            methods: ['GET', 'HEAD'],
        },
        'extensions.store': { uri: 'extensions\/submit', methods: ['POST'] },
        'extensions.manage': {
            uri: 'extensions\/{extension}\/manage',
            methods: ['GET', 'HEAD'],
            parameters: ['extension'],
            bindings: { extension: 'slug' },
        },
        'extensions.update': {
            uri: 'extensions\/{extension}\/manage',
            methods: ['PATCH'],
            parameters: ['extension'],
            bindings: { extension: 'slug' },
        },
        'storage.local': {
            uri: 'storage\/{path}',
            methods: ['GET', 'HEAD'],
            wheres: { path: '.*' },
            parameters: ['path'],
        },
    },
};
if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };
