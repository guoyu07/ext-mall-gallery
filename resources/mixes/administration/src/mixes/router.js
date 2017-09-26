import Gallery from '../pages/Gallery';

export default function (injection) {
    injection.useExtensionRoute([
        {
            beforeEnter: injection.middleware.requireAuth,
            component: Gallery,
            path: 'mall-gallery',
        },
    ]);
}
