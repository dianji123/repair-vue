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
  align-items: center; /* 水平居中对齐所有内容 */
  height: 100vh; /* 让 div 占满整个视口的高度 */
  margin-top: 100px;
}

h1 {
  color: #333; /* 设置标题颜色 */
  font-size: 2rem; /* 设置标题字体大小 */
  margin-bottom: 1.5rem; /* 在标题和链接之间添加一些空间 */
}

a {
  text-decoration: none; /* 移除链接下划线 */
  color: #007bff; /* 设置链接颜色 */
  font-size: 1.2rem; /* 设置链接字体大小 */
  padding: 10px 20px; /* 增加链接的填充大小 */
  background-color: white; /* 设置链接的背景颜色 */
  border: 1px solid #007bff; /* 给链接添加蓝色边框 */
  border-radius: 5px; /* 轻轻圆化链接的角 */
  transition: 0.3s; /* 添加过渡效果让颜色改变更平滑 */
}

a:hover {
  background-color: #007bff; /* 鼠标悬停时更改背景颜色 */
  color: white; /* 鼠标悬停时更改文本颜色 */
}
</style>