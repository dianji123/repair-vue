<template>
  <div class="login-container">
    <h2 class="login-title">登录</h2>
    <form @submit.prevent="login" class="login-form">
      <div class="form-group">
        <label for="username">用户名：</label>
        <input type="text" id="username" v-model="username" required placeholder="请输入用户名" class="input-field">
      </div>
      <div class="form-group">
        <label for="password">密码：</label>
        <input type="password" id="password" v-model="password" required placeholder="请输入密码" class="input-field">
      </div>
      <button type="submit" class="login-button">登录</button>
    </form>
    <div v-if="errorMessage" class="error-message">{{ errorMessage }}</div>
  </div>
</template>

<script>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

export default {
  setup() {
    const username = ref('');
    const password = ref('');
    const errorMessage = ref('');
    const router = useRouter(); // 获取路由实例

    const login = async () => {
      try {
        // 发送登录请求到后端
        const response = await axios.post('http://localhost:5473/api/admin/_login.php', {
          username: username.value,
          password: password.value
        });

        // 存储Token到sessionStorage
        sessionStorage.setItem('token', response.data.token);

        router.push({
          name: 'ListOrder'
        })
      } catch (error) {
        console.error('登录失败:', error);
        errorMessage.value = '登录失败，请检查用户名和密码。';
      }
    };

    return {
      username,
      password,
      errorMessage,
      login
    };
  }
};
</script>
<style scoped>
.login-container {
  max-width: 300px;
  margin: 50px auto;
  padding: 20px;
  border: 3px solid #ccc;
  border-radius: 4px;
}

.login-title {
  text-align: center;
  margin-bottom: 20px;
}

.login-form {
  display: flex;
  flex-direction: column;
}

.form-group {
  margin-bottom: 10px;
}

.form-group label {
  display: block;
  margin-bottom: 5px;
}

.input-field {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

.login-button {
  background-color: #007bff;
  color: white;
  padding: 10px;
  border: none;
  border-radius: 4px;
  margin-top: 10px;
  cursor: pointer;
}

.login-button:hover {
  background-color: #0056b3;
}

.error-message {
  color: red;
  text-align: center;
  margin-top: 10px;
}
</style>