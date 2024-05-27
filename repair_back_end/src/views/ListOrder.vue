<template>
  <div>
    <h2>订单列表</h2>
    <el-table 
      v-if="tableData.length > 0" 
      :data="tableData" 
      highlight-current-row 
      border 
      stripe 
      style="width: 100%"
    >
      <el-table-column prop="user_name" label="姓名" width="100" align="center"></el-table-column>
      <el-table-column prop="telphone" label="电话" width="150" align="center"></el-table-column>
      <el-table-column prop="area" label="楼栋" width="130" align="center"></el-table-column>
      <el-table-column prop="room" label="房号" width="100" align="center"></el-table-column>
      <el-table-column prop="information" label="故障详情" width="160" align="center"></el-table-column>
      <el-table-column prop="image_file" label="图片" width="150" align="center">
        <template v-slot="{ row }">
          <img 
            v-if="row && row.image_file" 
            :src="getImageUrl(row.image_file)" 
            alt="图片" 
            style="width: auto; height: 70px; object-fit: contain"
          />
        </template>
      </el-table-column>
      <el-table-column prop="order_date" label="报修时间" width="180" align="center"></el-table-column>
      <el-table-column prop="status" label="报修状态" width="120" align="center"></el-table-column>
      <el-table-column prop="status" label="操作" align="center">
        <template #default="{ row }">
          <el-button size="small" @click="handleEdit(row)">编辑</el-button>
          <el-button size="small" type="danger" @click="handleDelete(row)">删除</el-button>
        </template>
      </el-table-column>
    </el-table>
    <el-alert v-else title="列表为空或加载中..." type="info"></el-alert>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import { ElMessage, ElMessageBox } from 'element-plus'
import axios from "axios";
import { useRouter } from 'vue-router';

export default {
  name: "App",
  setup() {
    const tableData = ref([]); // 初始化表格数据
    const router = useRouter(); // 获取路由实例

    const queryUserList = () => {
      const token = sessionStorage.getItem('token');
      if(token != null){
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
        axios.get('http://localhost:5473/api/admin/_listOrder.php')
        .then(res => {
          // 请求成功后的数据返回给用户列表用于展示
          tableData.value = res.data;
        })
        .catch(error => {
          console.error('请求用户列表失败:', error); // 给出错误提示
        });
        //console.log(token);
      }else{
        console.log("令牌不能为空");
        ElMessage.warning("请登录！");
        router.push({
            name:'Login'
          })
      }
      
    };

    const getImageUrl = (image_file) => {
      // 获取图片路径
      return 'http://localhost/image/' + image_file;
    };

    const handleEdit = (row) => {
      // 编辑操作
      router.push({
        name: 'UpdateOrder',
        query: { id: row.id } // 传递订单id
      });
    };

    const handleDelete = (row) => {
      // 删除操作
      // 使用MessageBox弹出确认对话框
      ElMessageBox.confirm('您确定要删除此订单吗?', '删除订单', {
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        type: 'warning'
      }).then(() =>{
        axios
        .post('http://localhost:5473/api/admin/_deleteOrder.php', {
          id: row.id,
        })
        .then(() =>{
          queryUserList();
          ElMessage({
            type: 'success',
            message: '删除成功',
      })
        })
        .catch((error) => {
          console.error('删除订单失败:', error);
        });
      }).catch((error) =>{
        ElMessage({
            type: 'info',
            message: '取消操作',
      })
      })
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
  h2 {
  text-align: center;
}

.el-table {
  margin: 20px auto;
}

.el-button {
  margin: 0 10px;
}
</style>
