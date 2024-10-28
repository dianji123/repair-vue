<template>
  
  <div>
    <h2>订单列表</h2>
    <div v-if="tableData.length > 0">
      <div v-for="item in tableData" :key="item.id" class="order-item">
        <div>姓名: {{ item.user_name }}</div>
        <div>电话: {{ item.telphone }}</div>
        <div>楼栋: {{ item.area }}</div>
        <div>房号: {{ item.room }}</div>
        <div>故障详情: {{ item.information }}</div>
        <div>
          <img v-if="item.image_file" :src="getImageUrl(item.image_file)" alt="图片" style="width: auto;
           height: 70px; object-fit: contain" />
        </div>
        <div>报修时间: {{ item.order_date }}</div>
        <div>报修状态: {{ item.status }}</div>
        <div>
          <button @click="handleEdit(item)">编辑</button>
          <button @click="handleDelete(item)">删除</button>
        </div>
      </div>
    </div>
    <div v-else>
      <p>列表为空或加载中...</p>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from "axios";
import { useRouter } from 'vue-router';

export default {
  name: "App",
  setup() {
    const tableData = ref([]); // 初始化表格数据
    const router = useRouter(); // 获取路由实例

    const queryUserList = () => {
      axios.get('http://localhost:5173/api/admin/_listOrder.php')
      .then(res => {
        // 请求成功后的数据返回给用户列表用于展示
        tableData.value = res.data;
      })
      .catch(error => {
        console.error('请求用户列表失败:', error); // 给出错误提示
      });
    };

    const getImageUrl = (image_file) => {
      // 获取图片路径
      return 'http://localhost/image/' + image_file;
    };

    const handleEdit = (item) => {
      // 编辑操作
      router.push({
        name: 'UpdateOrder',
        query: { id: item.id } // 传递订单id
      });
    };

    const handleDelete = (item) => {
      // 删除操作
      axios
      .post('http://localhost:5173/api/admin/_deleteOrder.php', {
        id: item.id,
      })
      .then(() =>{
        queryUserList();
      })
      .catch((error) => {
        console.error('删除订单失败:', error);
      });
    };

    onMounted(() => {
      // 页面加载就渲染用户列表
      queryUserList();
    });

    return { tableData, getImageUrl, handleEdit, handleDelete };
  },
};
</script>

<style scoped>
.order-item {
  margin-bottom: 20px;
  padding: 10px;
  border: 1px solid #ccc;
}
</style>
