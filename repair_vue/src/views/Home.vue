<template>
  <div class="home-page">
    <h1>校园报修后台管理页</h1>
    <router-link to="/Login">登录</router-link>
  </div>
</template>

<script>
export default {
  name: 'Home',
  // 组件的数据
  data() {
    return {
      // 在这里定义组件的数据
      }
  },
  // 组件的方法
  methods: {
    // 在这里定义组件的方法
  }
  }
</script>

<style scoped>
.home-page {
  display: flex;
  flex-direction: column;
  align-items: center; 
  height: 100vh;
  margin-top: 100px;
}

h1 {
  color: #333; 
  font-size: 2rem; 
  margin-bottom: 1.5rem; 
}

a {
  text-decoration: none; 
  color: #007bff; 
  font-size: 1.2rem; 
  padding: 10px 20px; 
  background-color: white; 
  border: 1px solid #007bff; 
  border-radius: 5px;
  transition: 0.3s; /* 添加过渡效果让颜色改变更平滑 */
}

a:hover {
  background-color: #007bff; 
  color: white; 
}
</style>