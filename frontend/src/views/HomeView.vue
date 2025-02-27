<template>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-white p-20 rounded-2xl min-h-screen">
      <!-- Left Section: Add a Task Form -->
      <div class="py-6 pr-24 pl-6 border-r-4">
        <h2 class="text-2xl font-semibold mb-4">Add a Task</h2>
        <form @submit.prevent="submitForm">
          <div class="mb-4">
            <label class="block mb-1 font-medium" for="title">Title</label>
            <input
              id="title"
              v-model="form.title"
              type="text"
              class="w-full border border-gray-300 rounded-xl px-3 py-2 focus:outline-none
                     focus:ring-2 focus:ring-blue-400 shadow-md"
              placeholder="Enter task title"
            />
            <span v-if="error.title" class="text-red-500">{{error.title}}</span>
          </div>
          <div class="mb-4">
            <label class="block mb-1 font-medium" for="description">Description</label>
            <textarea
              id="description"
              v-model="form.description"
              class="w-full border border-gray-300 rounded-xl px-3 py-2 focus:outline-none
               focus:ring-2 focus:ring-blue-400 shadow-md"
              placeholder="Enter task description"
            ></textarea>
            <span v-if="error.description" class="text-red-500">{{error.description}}</span>
          </div>
          <button
            type="submit"
            class="bg-blue-600 text-white px-10 py-2 rounded-xl hover:bg-blue-700 transition-colors float-end"
          >
            Add
          </button>
        </form>
      </div>

      <!-- Right Section: Task List -->
      <div class="pl-20">
        <div
          v-for="(task, index) in tasks"
          :key="index"
          class="flex items-end justify-between bg-gray-200 p-6 mb-5 rounded-xl shadow"
        >
        {{ title }}
          <div>
            <h3 class="text-lg font-bold mb-3">{{ task.title }}</h3>
            <p class="text-gray-600">{{ task.description }}</p>
          </div>
          <button
            @click="updateStatus(task.id)"
            class="px-6 py-2 rounded transition-colors text-gray-700 cursor-default border border-gray-700 cursor-pointer"
          >
            Done
          </button>
        </div>
      </div>
    </div>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue';
import axios from 'axios';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import Swal from 'sweetalert2';

// Dummy initial tasks
const tasks = ref([])

const form = reactive({
  title: '',
  description: '',
})

const error = reactive({
  title: '',
  description: '',
})

const validatedForm = () =>{
  let isValid = true;
  if (!form.title.trim()){
    error.title = 'Title is required';
    isValid = false;
  }
  if (!form.description.trim()){
    error.description = 'Description is required';
    isValid = false;
  }
  return isValid;
}

// Method to add a new task
const submitForm = async () => {
  if(validatedForm()){
   try {
    const response = await axios.post(
      'http://localhost:8000/api/storeTask', form
    )
   if(response.status === 200){
    toast.success('Successfully insert task');
    form.title = '';
    form.description ='';
   }
   await fetchTask();
   } catch (error) {
    toast.error('Failed insert task');
   }
  }
}

const fetchTask = async () =>{
  try {
    const response = await axios.get(
      'http://localhost:8000/api/allTask'
    )
    tasks.value = response.data;
  } catch (error) {
    toast.error('Server error');
  }
}

const updateStatus = async (id) =>{
  const result = await Swal.fire({
    title: "Are you sure done task?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Yes, Done it!"
  });
  if(result.isConfirmed){
    try {
      const response = await axios.put(
        'http://localhost:8000/api/updateStatus/'+id
      )
      await fetchTask();
      toast.success('Successfuly update task');
    } catch (error) {
      toast.error('Server error');
    }
  }

}

onMounted(
  ()=>{
    fetchTask()
  }
)


// Method to mark a task as done
function markDone(index) {
  tasks.value[index].done = true
}
</script>

<style scoped>
/* You can add additional custom styles here if needed */
</style>