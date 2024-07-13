<div class="p-4 sm:ml-64 dark:bg-gray-900 h-full">

  <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th scope="col" class="w-5/6 px-6 py-3">Task</th>
          <th scope="col" class="w-1/6 px-6 py-3">Deadline</th>
          <th scope="col" class="w-1/6 px-6 py-3">Delete</th>
        </tr>
      </thead>
      <tbody id="task-table">
        <!-- main content -->
      </tbody>
    </table>
  </div>
  <button type="button" data-modal-target="new-task-modal" data-modal-toggle="new-task-modal" class="mt-2 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">New Task</button>
  <?= view('partials/new_task_modal'); ?>

</div>

<script type="module">
  import { renderTasks } from './js/task.js';
  renderTasks();
</script>
