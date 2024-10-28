<template>
  <div>
    <h2>编辑报修订单</h2>
    <form v-if="order" @submit.prevent="updateStatus">
      <div v-if="order">
        <div class="form-group">
          <label for="user_name"><strong>姓名：</strong></label>
          <input id="user_name" v-model="order.user_name" type="text" disabled>
        </div>
        <div class="form-group">
          <label for="telphone"><strong>电话号码：</strong></label>
          <input id="telphone" v-model="order.telphone" type="text" disabled>
        </div>
        <div class="form-group">
          <label for="area"><strong>楼栋：</strong></label>
          <input id="area" v-model="order.area" type="text" disabled>
        </div>
        <div class="form-group">
          <label for="room"><strong>房号：</strong></label>
          <input id="room" v-model="order.room" type="text" disabled>
        </div>
        <div class="form-group">
          <label for="information"><strong>故障详情：</strong></label>
          <input id="information" v-model="order.information" type="text" disabled>
        </div>
        <div class="form-group">
          <label for="image_file"><strong>图片：</strong></label>
          <img v-if="order && order.image_file" :src="getImageUrl(order.image_file)" alt="图片" class="image-preview">
        </div>
        <div class="form-group">
          <label for="status"><strong>报修状态：</strong></label>
          <input id="status" v-model="order.status" type="text" disabled>
        </div>
        <div class="form-group">
          <label for="status_select" style="color: red;">更改报修状态：</label>
          <select id="status_select" v-model="status">
            <option value="待处理">待处理</option>
            <option value="已完成">已完成</option>
          </select>
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
  name: 'UpdateOrder',
  setup() {
    const order = ref({});
    const status = ref('');
    const router = useRouter();
    const route = useRoute();

    const updateStatus = () => {
      const orderId = route.query.id;
      axios
        .post('http://localhost:8080/api/admin/_updateOrder.php', {
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
        .get(`http://localhost:5473/api/admin/_getOrder.php?id=${orderId}`)
        .then((res) => {
          order.value = res.data[0];
          status.value = order.value.status;
        })
        .catch((error) => {
          console.error('获取订单信息失败:', error);
        });
    };

    onMounted(() => {
      fetchOrderData(); // 获取订单信息
    });
    const getImageUrl = (image_file) => {
      return 'http://localhost/image/' + image_file;
    };

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
h2 {
  text-align: center;
}

form {
  display: flex;
  flex-direction: column;
  gap: 10px;
  max-width: 300px;
  margin: 0 auto;
  padding: 20px;

}

.form-group {
  display: flex;
  flex-direction: column;
  gap: 5px;
}

input[disabled], input[type="text"], select {
  padding: 10px;
  border-radius: 4px;
  border: 1px solid #dcdfe6;
  background-color: #f0f0f0; 
}

.image-preview {
  max-width: 100px;
  max-height: 100px;
  border: 1px solid #dcdfe6;
  border-radius: 4px;
}

button {
  padding: 10px 20px;
  margin-top: 10px;
  background-color: #409eff;
  color: white;
  border: none;
  cursor: pointer;
}

.button-container {
  display: flex;
  justify-content: center; 
}

button:hover {
  background-color: #66b1ff;
}
</style>