const tasks = [];

const getTasks = async () => {
  try {
    const response = await fetch('/task');
    const data = await response.json();
    tasks.push(...data);
    console.log(tasks);
  } catch (error) {
    // handle error
  };
};

// === Rendering tasks ===
const taskTable = document.getElementById('task-table');
import taskTemplate from './taskTemplate.js';

export const renderTasks = async () => {
  try {
    await getTasks();
    tasks.forEach(task => {
      taskTable.insertAdjacentHTML('beforeend', taskTemplate(task));
    });
  } catch (error) {
    // handle error
  };
};