<script>
    import injection from '../helpers/injection';
    import image from '../assets/images/adv.jpg';

    export default {
        beforeRouteEnter(to, from, next) {
            next(() => {
                injection.sidebar.active('setting');
            });
        },
        data() {
            return {
                checkAll: false,
                checkAllGroup: [],
                indeterminate: false,
                modalPicture: {
                    img: '',
                },
                page: {
                    current_page: 1,
                    per_page: 0,
                    total: 0,
                },
                pictureList: [
                    {
                        img: image,
                        name: '商品rey的主图1',
                        uploadTime: '上传时间：2017/02/11 12:30:17',
                        single: false,
                        size: '原图尺寸：400*400',
                    },
                    {
                        img: image,
                        name: '商品rey的主图2',
                        uploadTime: '上传时间：2017/02/11 12:30:17',
                        single: false,
                        size: '原图尺寸：400*400',
                    },
                    {
                        img: image,
                        name: '商品rey的主图3',
                        uploadTime: '上传时间：2017/02/11 12:30:17',
                        single: false,
                        size: '原图尺寸：400*400',
                    },
                    {
                        img: image,
                        name: '商品rey的主图4',
                        uploadTime: '上传时间：2017/02/11 12:30:17',
                        single: false,
                        size: '原图尺寸：400*400',
                    },
                    {
                        img: image,
                        name: '商品rey的主图5',
                        uploadTime: '上传时间：2017/02/11 12:30:17',
                        single: false,
                        size: '原图尺寸：400*400',
                    },
                ],
                pictureModal: false,
            };
        },
        methods: {
            changePage() {},
            checkAllGroupChange() {
                const self = this;
                self.indeterminate = false;
                self.checkAll = true;
                const select = [];
                self.pictureList.forEach(item => {
                    if (item.single === false) {
                        self.checkAll = false;
                        self.indeterminate = true;
                    } else {
                        select.push(item);
                    }
                });
                if (select.length === 0) {
                    self.indeterminate = false;
                }
            },
            delete() {},
            goBack() {
                const self = this;
                self.$router.go(-1);
            },
            handleCheckAll() {
                const self = this;
                if (self.checkAll) {
                    self.pictureList.forEach(item => {
                        item.single = true;
                    });
                } else {
                    self.pictureList.forEach(item => {
                        item.single = false;
                    });
                    self.indeterminate = false;
                }
            },
            lookPicture(item) {
                const self = this;
                self.modalPicture.img = item.img;
                self.pictureModal = true;
            },
            removeImage(index) {
                this.pictureList.splice(index, 1);
            },
        },
    };
</script>
<template>
    <div class="setting-wrap">
        <div class="goods-picture-look-all">
            <div class="edit-link-title">
                <i-button type="text" @click.native="goBack">
                    <icon type="chevron-left"></icon>
                </i-button>
                <span>图片管理—全部图片</span>
            </div>
            <card :bordered="false">
                <div class="picture-select">
                    <checkbox
                            :indeterminate="indeterminate"
                            v-model="checkAll"
                            @on-change="handleCheckAll">全选</checkbox>
                    <i-button class="delete-btn" type="ghost"
                              @click.native="delete">删除</i-button>
                </div>
                <div v-for="(item, index) in pictureList" class="picture-check">
                    <img :src="item.img" alt="" @click="lookPicture(item)">
                    <i-button type="text" @click.native="removeImage">
                        <icon type="trash-a"></icon>
                    </i-button>
                    <checkbox v-model="item.single" @on-change="checkAllGroupChange()"></checkbox>
                    <p class="name">{{ item.name}}</p>
                    <p class="tip">{{ item.uploadTime}}</p>
                    <p class="tip">{{ item.size}}</p>
                </div>
                <div class="page">
                    <page :current="page.current_page"
                          @on-change="changePage"
                          :page-size="page.per_page"
                          :total="page.total"
                          v-if="page.total > page.per_page"
                          show-elevator></page>
                </div>
            </card>
        </div>
    </div>
</template>
