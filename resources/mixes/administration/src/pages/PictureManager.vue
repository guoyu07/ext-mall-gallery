<script>
    import image1 from '../assets/images/img_logo.png';

    export default {
        beforeRouteEnter(to, from, next) {
            next(() => {
            });
        },
        data() {
            const self = this;
            return {
                filterWord: '',
                searchList: [
                    {
                        label: '相册名称',
                        value: '1',
                    },
                    {
                        label: '相册ID',
                        value: '2',
                    },
                    {
                        label: '店铺名称',
                        value: '3',
                    },
                    {
                        label: '店铺ID',
                        value: '4',
                    },
                ],
                searchValue: '1',
                columns: [
                    {
                        key: 'albumId',
                        title: '相册ID',
                        width: 100,
                    },
                    {
                        align: 'center',
                        key: 'albumName',
                        title: '相册名称',
                    },
                    {
                        align: 'center',
                        key: 'shopId',
                        title: '店铺ID',
                    },
                    {
                        align: 'center',
                        key: 'shopName',
                        title: '店铺名称',
                    },
                    {
                        align: 'center',
                        key: 'coverImg',
                        render(h, data) {
                            return h('tooltip', {
                                props: {
                                    placement: 'right-end',
                                },
                                scopedSlots: {
                                    content() {
                                        return h('img', {
                                            domProps: {
                                                src: data.row.coverImg,
                                            },
                                        });
                                    },
                                    default() {
                                        return h('icon', {
                                            props: {
                                                type: 'image',
                                            },
                                        });
                                    },
                                },
                            });
                        },
                        title: '封面图片',
                    },
                    {
                        align: 'center',
                        key: 'albumNum',
                        title: '图片数量',
                    },
                    {
                        align: 'center',
                        key: 'action',
                        title: '操作',
                        width: 180,
                        render(h, data) {
                            return h('div', [
                                h('i-button', {
                                    on: {
                                        click() {
                                            self.$router.push({
                                                path: 'picture/look',
                                            });
                                        },
                                    },
                                    props: {
                                        size: 'small',
                                        type: 'ghost',
                                    },
                                }, '查看'),
                                h('i-button', {
                                    on: {
                                        click() {
                                            self.remove(data.index);
                                        },
                                    },
                                    props: {
                                        size: 'small',
                                        type: 'ghost',
                                    },
                                    style: {
                                        marginLeft: '10px',
                                    },
                                }, '删除'),
                            ]);
                        },
                    },
                ],
                list: [
                    {
                        albumId: '01',
                        albumName: '默认相册',
                        albumNum: 50,
                        coverImg: image1,
                        shopId: '336',
                        shopName: 'Rey吕官方旗舰店',
                    },
                    {
                        albumId: '01',
                        albumName: '默认相册',
                        albumNum: 50,
                        coverImg: image1,
                        shopId: '336',
                        shopName: 'Rey吕官方旗舰店',
                    },
                    {
                        albumId: '01',
                        albumName: '默认相册',
                        albumNum: 50,
                        coverImg: image1,
                        shopId: '336',
                        shopName: 'Rey吕官方旗舰店',
                    },
                ],
                page: {
                    current_page: 1,
                    per_page: 0,
                    total: 0,
                },
            };
        },
        methods: {
            changePage() {},
            refreshData() {
                const self = this;
                self.filterWord = '';
            },
            remove(index) {
                this.list.splice(index, 1);
            },
        },
    };
</script>
<template>
    <div class="setting-wrap">
        <div class="goods-picture">
            <tabs value="name1">
                <tab-pane label="图片空间" name="name1">
                    <card :bordered="false">
                        <div class="prompt-box">
                            <p>提示</p>
                            <p>相册删除后，相册内全部图片都会删除，不能恢复，请谨慎操作</p>
                        </div>
                        <div class="album-action">
                            <router-link class="add-data" type="ghost"
                                         to="/picture/look/all">全部图片</router-link>
                            <i-button size="small" type="text" icon="android-sync"
                                      class="refresh" @click.native="refreshData">刷新</i-button>
                            <div class="goods-body-header-right">
                                <i-input v-model="filterWord" placeholder="请输入关键词进行搜索">
                                    <i-select v-model="searchValue" slot="prepend" style="width: 100px;">
                                        <i-option v-for="item in searchList"
                                                  :value="item.value">{{ item.label }}</i-option>
                                    </i-select>
                                    <i-button slot="append" type="primary">搜索</i-button>
                                </i-input>
                            </div>
                        </div>
                        <i-table highlight-row
                                 :columns="columns"
                                 :context="self"
                                 :data="list"></i-table>
                        <div class="page">
                            <page :current="page.current_page"
                                  @on-change="changePage"
                                  :page-size="page.per_page"
                                  :total="page.total"
                                  v-if="page.total > page.per_page"
                                  show-elevator></page>
                        </div>
                    </card>
                </tab-pane>
            </tabs>
        </div>
    </div>
</template>
