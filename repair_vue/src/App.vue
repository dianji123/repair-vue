<template>
  <nav class="navbar">
      <router-link to="/">首页</router-link>
      <router-link to="/ListOrder">订单列表</router-link>
      <router-link to="/RepairMan">维修师傅</router-link>
      <router-link to="/" @click="clearToken">退出</router-link>
    </nav>
    <router-view />
    
</template>

<script>
import Login from './views/Login.vue';

export default {
  name: 'App',
  components: { Login },
  setup() {
    const clearToken = () => {
      // 移除sessionStorage中的token
      sessionStorage.removeItem('token');
    }
    return { clearToken };
  }
};
</script>

  <style>
  /* Global styles */
.container {
  display: flex;
  flex-direction: column; /* 子元素按列排列 */
  justify-content: center; /* 水平居中 */
  align-items: center; /* 垂直居中 */
  height: 100%;
}
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: url('src/img/bg.jpg') no-repeat center center fixed;
    background-size: cover;
    background-blend-mode: overlay;
    background-color: rgba(255, 255, 255, 0.5); /* White background with transparency */
  }

  a {
    color: #409eff;
    text-decoration: none;
  }

  a:hover {
    color: #66b1ff;
  }

  .navbar {
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #333;
  color: white;
  padding: 10px 0;
}

.navbar a {
  color: white; 
  margin: 0 15px; 
  text-decoration: none; 
  padding: 10px 15px;
  border-radius: 5px;
  transition: background-color 0.3s ease; /* 平滑的背景颜色转换效果 */
}

.navbar a:hover {
  background-color: #555; 
}
.navbar a.active {
  background-color: #409eff;
  color: white;
}

.input, select, button {
    padding: 10px;
    border-radius: 4px;
    border: 1px solid #dcdfe6;
    outline: none;
  }

  button {
    background-color: #409eff;
    color: white;
    cursor: pointer;
    border: none;
  }

  button:hover {
    background-color: #66b1ff;
  }


  </style>