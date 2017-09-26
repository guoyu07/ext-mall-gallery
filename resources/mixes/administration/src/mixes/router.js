import ProductPicture from '../pages/ProductPicture';
import ProductPictureLook from '../pages/ProductPictureLook';
import ProductPictureLookAll from '../pages/ProductPictureLookAll';

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
