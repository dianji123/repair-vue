<template>
  <div>
    <h2>维修师傅列表</h2>
    <div class="add-button">
      <el-button type="primary" @click="addRepairMan">新增</el-button>
    </div>
    <el-table v-if="tableData.length > 0" :data="tableData" highlight-current-row border stripe style="width: 100%">
      <el-table-column prop="aid" label="序号" width="220" align="center"></el-table-column>
      <el-table-column prop="username" label="用户名" width="220" align="center"></el-table-column>
      <el-table-column prop="realname" label="姓名" width="220" align="center"></el-table-column>
      <el-table-column prop="phone_num" label="手机号" width="250" align="center"></el-table-column>
      <!-- 在操作列中调整按钮的大小和类型 -->
      <el-table-column prop="status" label="操作" align="center">
        <template #default="{ row }">
          <el-button size="small" @click="handleEdit(row)">编辑</el-button>
          <el-button size="small" type="danger" @click="handleDelete(row)">删除</el-button>
        </template>
      </el-table-column>
    </el-table>
    <!-- 使用 Element Plus 的 Alert 组件 -->
    <el-alert v-else title="加载中..." type="info" center></el-alert>
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

    const queryRepairManList = () => {
      const token = sessionStorage.getItem('token');
      if(token != null){
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
        axios.get('http://localhost:5473/api/admin/_listRepairMan.php')
        .then(res => {
          // 请求成功后的数据返回给用户列表用于展示
          tableData.value = res.data;
        })
        .catch(error => {
          console.error('请求用户列表失败:', error); // 给出错误提示
        });
      }else{
        console.log("令牌不能为空");
        ElMessage.warning("请登录！");
        router.push({
            name:'Login'
          })
      }
      
    };

    const addRepairMan = () =>{
      router.push({
        name: 'AddRepairMan',
      });
    };

    const handleEdit = (row) => {
      // 编辑操作
      router.push({
        name: 'UpdateRepairMan',
        query: { aid: row.aid } // 传递aid
      });
    };

    const handleDelete = (row) => {
      // 删除操作
      // 使用MessageBox弹出确认对话框
      ElMessageBox.confirm('您确定要删除此维修师傅吗?', '删除订单', {
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        type: 'warning'
      }).then(() =>{
        axios
        .post('http://localhost:5473/api/admin/_deleteRepairMan.php', {
          aid: row.aid,
        })
        .then(() =>{
          queryRepairManList();
          ElMessage({
            type: 'success',
            message: '删除成功',
      })
        })
        .catch((error) => {
          console.error('删除失败:', error);
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
      queryRepairManList();
    });

    return { tableData, handleEdit, handleDelete, addRepairMan, };
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
.add-button{
  display: flex;
  justify-content: center; 
  margin-bottom: 20px;
}
.el-button {
  margin: 0 5px;
}
</style>