import ProductPicture from '../pages/ProductPicture.vue';
import ProductPictureLook from '../pages/ProductPictureLook.vue';
import ProductPictureLookAll from '../pages/ProductPictureLookAll.vue';

export default function (injection) {
    injection.useExtensionRoute([
        {
            beforeEnter: injection.middleware.requireAuth,
            component: ProductPicture,
            path: 'mall-gallery',
        },
        {
            beforeEnter: injection.middleware.requireAuth,
            component: ProductPictureLook,
            path: 'product/picture/look',
        },
        {
            beforeEnter: injection.middleware.requireAuth,
            component: ProductPictureLookAll,
            path: 'product/picture/look/all',
        },
    ]);
}
