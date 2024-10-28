<template>
    <div>
      <h2>维修师傅列表</h2>
      <div class="add-button">
        <button @click="addRepairMan">新增</button>
      </div>
      <div v-if="tableData.length > 0">
        <div v-for="repairman in tableData" :key="repairman.aid" class="repairman-item">
          <div><strong>序号:</strong> {{ repairman.aid }}</div>
          <div><strong>用户名:</strong> {{ repairman.username }}</div>
          <div><strong>姓名:</strong> {{ repairman.realname }}</div>
          <div><strong>手机号:</strong> {{ repairman.phone_num }}</div>
          <div>
            <button class="edit-button" @click="handleEdit(repairman)">编辑</button>
            <button class="delete-button" @click="handleDelete(repairman)">删除</button>
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
      const tableData = ref([]);
      const router = useRouter();
  
      const queryRepairManList = () => {
        axios.get('http://localhost:5173/api/admin/_listRepairMan.php')
          .then(res => {
            tableData.value = res.data;
          })
          .catch(error => {
            console.error('请求用户列表失败:', error);
          });
      };
  
      const addRepairMan = () =>{
        router.push({
          name: 'AddRepairMan',
        });
      };
  
      const handleEdit = (repairman) => {
        router.push({
          name: 'UpdateRepairMan',
          query: { aid: repairman.aid }
        });
      };
  
      const handleDelete = (repairman) => {
        axios
          .post('http://localhost:5173/api/admin/_deleteRepairMan.php', {
            aid: repairman.aid,
          })
          .then(() =>{
            queryRepairManList();
          })
          .catch((error) => {
            console.error('删除失败:', error);
          });
      };
  
      onMounted(() => {
        queryRepairManList();
      });
  
      return { tableData, handleEdit, handleDelete, addRepairMan };
    },
  };
  </script>
  