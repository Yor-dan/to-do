localStorage.setItem('state', 'all');

const doneTask = (taskId) => {
  const checkbox = document.querySelector(
    `[data-task-checkbox-id="${taskId}"]`
  );

  checkbox.addEventListener('change', () => {
    const taskInput = document.querySelector(
      `[data-task-input-id="${taskId}"]`
    );

    taskInput.classList.add('line-through');
    if (!checkbox.checked) {
      taskInput.classList.remove('line-through');
    }

    fetch(`/task/done/${taskId}`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        taskId: taskId,
        isDone: checkbox.checked,
      }),
    });

    // remove task from view when user is in unfinished or done page
    if (['unfinished', 'done'].includes(localStorage.getItem('state'))){
      document.querySelector(`tr[data-task-tr-id="${taskId}"]`).remove();
    }
  });
};

const updateTask = (taskId) => {
  const task = document.querySelector(`[data-task-input-id="${taskId}"]`);
  task.addEventListener('focusout', () => {
    fetch(`/task/${taskId}`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        task: task.value,
      }),
    });
  });
};

const deleteTask = (taskId) => {
  const deleteTaskBtn = document.querySelector(
    `[data-delete-task="${taskId}"]`
  );

  deleteTaskBtn.addEventListener('click', () => {
    fetch(`/task/${taskId}`, {
      method: 'DELETE',
    }).then(document.querySelector(`[data-task-tr-id="${taskId}"]`).remove());
  });
};

const taskItemTemplate = (task) => {
  return `
  <tr data-task-tr-id="${
    task['id']
  }" class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
    <th scope="row" class="px-3 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
      <div class="flex items-center gap-3">
        <input data-task-checkbox-id="${task['id']}" ${
    task['is_done'] == 1 ? 'checked' : ''
  } type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
        <input data-task-input-id="${task['id']}" type="text" value="${
    task['task']
  }" class="${
    task['is_done'] == 1 ? 'line-through' : ''
  } bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-900 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
      </div>
    </th>
      <td class="px-6 py-4">
        ${task['deadline']}
      </td>
      <td class="px-6 py-4">
        <img data-delete-task="${
          task['id']
        }" src="/assets/delete.svg" class="cursor-pointer" alt="delete">
      </td>
  </tr>
  `;
};

const renderTasks = (isDone = '') => {
  const taskTable = document.getElementById('task-table');

  fetch(`/task/${isDone}`)
    .then((response) => response.json())
    .then((tasks) => {
      taskTable.innerHTML = '';
      tasks.forEach((task) => {
        taskTable.insertAdjacentHTML('beforeend', taskItemTemplate(task));
        doneTask(task['id'], () => {renderTasks(isDone)});
        updateTask(task['id']);
        deleteTask(task['id']);
      });
    });
};
