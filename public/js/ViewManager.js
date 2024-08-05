const categoryButtons = document.querySelectorAll('a[list-toggle-color]');
export const categoryBtnToggleColor = () => {
  categoryButtons.forEach(button => {
    button.addEventListener('click', () => {
      categoryButtons.forEach(button => {
        button.classList.remove('dark:text-blue-500');
        button.classList.add('dark:text-white');
      });
      button.classList.remove('dark:text-white');
      button.classList.add('dark:text-blue-500');
    });
  });
};

import { taskManager } from './instances/taskManagerInstance.js';
let category = 'all';

export const showAll = () => {
  taskManager.tasks.forEach(task => {
    task.show();
  });
};

export const showUnfinished = () => {
  taskManager.tasks.forEach(task => {
    task.show();
    if (task.isDone === '1') {
      task.hide();
    };
  });
  console.log(taskManager.tasks);
};

export const showDone = () => {
  taskManager.tasks.forEach(task => {
    task.show();
    if (task.isDone === '0') {
      task.hide();
    };
  });
  console.log(taskManager.tasks);
};