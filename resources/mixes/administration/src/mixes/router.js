import PictureManager from '../pages/PictureManager.vue';
import PictureLook from '../pages/PictureLook.vue';
import PictureLookAll from '../pages/PictureLookAll.vue';

export default function (injection) {
    injection.useExtensionRoute([
        {
            beforeEnter: injection.middleware.requireAuth,
            component: PictureManager,
            path: 'mall-gallery',
        },
        {
            beforeEnter: injection.middleware.requireAuth,
            component: PictureLook,
            path: 'picture/look',
        },
        {
            beforeEnter: injection.middleware.requireAuth,
            component: PictureLookAll,
            path: 'picture/look/all',
        },
    ]);
}
