<template>
    <div class="add-repairman-container">
      <h2>新增维修师傅</h2>
      
      <form @submit.prevent="addRepairMan" class="repairman-form">
        <div class="form-group">
          <label for="username">用户名：</label>
          <input id="username" type="text" placeholder="请输入用户名" v-model="username">
        </div>
        <div class="form-group">
          <label for="password">密码：</label>
          <input id="password" type="password" placeholder="请输入密码" v-model="password">
        </div>
        <div class="form-group">
          <label for="realname">姓名：</label>
          <input id="realname" type="text" placeholder="请输入姓名" v-model="realname">
        </div>
        <div class="form-group">
          <label for="phone_num">手机号：</label>
          <input id="phone_num" type="text" placeholder="请输入手机号" v-model="phone_num">
        </div>
        <button type="submit" class="submit-btn">提交</button>
      </form>
    </div>
  </template>
    
<script>
import axios from 'axios';
import { ref } from 'vue';
import { useRouter, useRoute } from 'vue-router';

export default {
    name: 'AddRepairMan',
    setup() {
    const username = ref('');
    const password = ref('');
    const realname = ref('');
    const phone_num = ref('');
    const router = useRouter();

    const addRepairMan = () => {
        axios
        .post('http://localhost:5173/api/admin/_addRepairMan.php', {
            username: username.value,
            password: password.value,
            realname: realname.value,
            phone_num: phone_num.value,
        })
        .then(() => {
            router.push({ name: 'ListRepairMan' });
        })
        .catch((error) => {
            console.error('新增失败:', error);
        });
    };
    return {
        addRepairMan,
        username,
        password,
        realname,
        phone_num,
    };
    },
};
</script>
