export default (task) => {
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