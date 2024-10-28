<template>
    <div>
        <h2>登录</h2>
        <form @submit.prevent="login">
            <input type="text" v-model="username" placeholder="请输入用户名">
            <input type="password" v-model="password" placeholder="请输入密码">
            <input type="submit">
        </form>
    </div>
</template>

<script>
import {ref} from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

export default {
    setup(){
        const username = ref('');
        const password = ref('');
        const router = useRouter(); // 获取路由实例

        const login = async () => {
        try {
            // 发送登录请求到后端
            const response = await axios.post('http://localhost:5173/api/admin/_login.php', {
            username: username.value,
            password: password.value
        });
            console.log(response.data);// 查看登录接口的响应
            router.push({
                 name: 'ListOrder'
                })
        }catch (error) {
            console.error('登录失败:', error);
            }
        };
        return{username, password, login};
    }
}
</script>

<style scoped></style>
