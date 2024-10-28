<template>
    <div class="container">
        <h2>编辑维修师傅信息</h2>
        <form v-if="repairMan" @submit.prevent="updateRepairMan" class="form-style">
            <div class="form-group" v-if="repairMan">

                <div class="input-group">
                    <label for="username"><strong>用户名：</strong></label>
                    <input id="username" type="text" placeholder="请输入用户名" v-model="username">
                </div>
                <div class="input-group">
                    <label for="realname"><strong>姓名：</strong></label>
                    <input id="realname" type="text" placeholder="请输入姓名" v-model="realname">
                </div>
                <div class="input-group">
                    <label for="phone_num"><strong>手机号：</strong></label>
                    <input id="phone_num" type="text" placeholder="请输入手机号" v-model="phone_num">
                </div>

                <div class="form-group button-container">
                    <button type="submit">提交</button>
                </div>
            </div>
        </form>
    </div>
</template>


<script>
import axios from 'axios';
import { ref, onMounted } from 'vue';
import { useRouter, useRoute } from 'vue-router';

export default {
    name: 'UpdateRepairMan',
    setup() {
        const repairMan = ref({});
        const username = ref('');
        const realname = ref('');
        const phone_num = ref('');
        const router = useRouter();
        const route = useRoute();

        const updateRepairMan = () => {
            const repairManId = route.query.aid;
            axios
                .post('http://localhost:5173/api/admin/_updateRepairMan.php', {
                    aid: repairManId,
                    username: username.value,
                    realname: realname.value,
                    phone_num: phone_num.value,
                })
                .then(() => {
                    router.push({ name: 'ListRepairMan' });
                })
                .catch((error) => {
                    console.error('更新失败:', error);
                });
        };

        const fetchRepairManData = () => {
            const repairManId = route.query.aid;
            axios
                .get(`http://localhost:5173/api/admin/_getRepairMan.php?aid=${repairManId}`)
                .then((res) => {
                    repairMan.value = res.data[0];
                    username.value = res.data[0].username;
                    realname.value = res.data[0].realname;
                    phone_num.value = res.data[0].phone_num;
                })
                .catch((error) => {
                    console.error('获取信息失败:', error);
                });
        };

        onMounted(() => {
            fetchRepairManData(); // 获取信息
        });
        return {
            repairMan,
            updateRepairMan,
            fetchRepairManData,
            username,
            realname,
            phone_num,
        };
    },
};
</script>
