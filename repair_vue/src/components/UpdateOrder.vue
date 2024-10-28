<template>
    <div>
      <h2>编辑报修订单</h2>
      <div v-if="order">
        <div><strong>姓名：</strong> {{ order.user_name }}</div>
        <div><strong>电话号码：</strong> {{ order.telphone }}</div>
        <div><strong>楼栋：</strong> {{ order.area }}</div>
        <div><strong>房号：</strong> {{ order.room }}</div>
        <div><strong>故障详情：</strong> {{ order.information }}</div>
        <div v-if="order && order.image_file">
          <strong>图片：</strong>
          <img :src="getImageUrl(order.image_file)" alt="图片" class="image-preview">
        </div>
        <div><strong>报修状态：</strong> {{ order.status }}</div>
        <div style="color: red;"><strong>更改报修状态：</strong>
          <select v-model="status">
            <option value="待处理">待处理</option>
            <option value="已完成">已完成</option>
          </select>
        </div>
      </div>
      <div>
        <button @click="updateStatus">提交</button>
      </div>
    </div>
  </template>
  
  <script>
    import axios from 'axios';
    import { ref, onMounted } from 'vue';
    import { useRouter, useRoute } from 'vue-router';
  
  export default {
    name: 'UpdateOrder',
  setup() {
    const order = ref({});
    const status = ref('');
    const router = useRouter();
    const route = useRoute();

    const updateStatus = () => {
      const orderId = route.query.id;
      axios
        .post('http://localhost:5173/api/admin/_updateOrder.php', {
          id: orderId,
          status: status.value,
        })
        .then(() => {
          router.push({ name: 'ListOrder' });
        })
        .catch((error) => {
          console.error('报修状态更新失败:', error);
        });
    };

    const fetchOrderData = () => {
      const orderId = route.query.id;
      axios
        .get(`http://localhost:5173/api/admin/_getOrder.php?id=${orderId}`)
        .then((res) => {
          order.value = res.data[0];
          status.value = order.value.status;
        })
        .catch((error) => {
          console.error('获取订单信息失败:', error);
        });
    };
    const getImageUrl = (image_file) => {
      return 'http://localhost/image/' + image_file;
    };

    onMounted(() => {
      fetchOrderData(); // 获取订单信息
    });

    return {
      order,
      status,
      updateStatus,
      getImageUrl,
    };
  },
};
  </script>
  
  <style scoped>
  .image-preview {
    width: auto;
    height: 70px;
    object-fit: contain;
  }
  </style>
  