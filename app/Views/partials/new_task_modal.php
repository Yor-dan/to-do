<!-- New Task modal -->
<div id="new-task-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
  <div class="relative w-full max-w-md max-h-full">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
      <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="new-task-modal">
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
        <span class="sr-only">Close modal</span>
      </button>
      <div class="px-6 py-6 lg:px-8">
        <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">New Task</h3>
        <form id="new-task-form" class="space-y-6">
          <div>
            <label for="task" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">What to do?</label>
            <input type="text" name="task" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
          </div>
          <div>
            <label for="deadline" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deadline</label>
            <div class="relative max-w-sm">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                </svg>
              </div>
              <input datepicker name="deadline" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="deadline">
            </div>
          </div>
          <button type="submit" data-modal-hide="new-task-modal" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add Task</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="module">
  import Task from './js/Task.js';
  import { taskManager } from './js/instances/taskManagerInstance.js';

  const newTaskForm = document.getElementById('new-task-form');
  const textbox = document.querySelector('input[name="task"]');
  const deadline = document.querySelector('input[name="deadline"]');

  newTaskForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const response = await fetch('/task', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        task: textbox.value,
        deadline: deadline.value,
      }),
    });
    const data = await response.json();
    const newTask = new Task({...data, is_done: `${data.is_done}`});
    taskManager.insert(newTask);
    newTask.render();
    newTask.deleteButton.addEventListener('click', () => {
      taskManager.deleteTask(newTask);
    });

    textbox.value = '';
    deadline.value = '';

    const getAllTasks = document.querySelector('a[all]');
    getAllTasks.classList.remove('dark:text-white');
    getAllTasks.classList.add('dark:text-blue-500');

    const getUnfinishedTasks = document.querySelector('a[unfinished]');
    getUnfinishedTasks.classList.remove('dark:text-blue-500');
    getUnfinishedTasks.classList.add('dark:text-white');

    const getDoneTasks = document.querySelector('a[done]');
    getDoneTasks.classList.remove('dark:text-blue-500');
    getDoneTasks.classList.add('dark:text-white');

    taskManager.showAll();
  });
</script>